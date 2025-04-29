<?php

namespace App\Models;

use App\Config\Conexion;
use Exception;
use PDO;

class BoletoModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function inicializarBoletos()
  {
    try {
      // Verificar si existe una rifa
      $sqlRifa = "SELECT id_rifa FROM rifas WHERE id_rifa = 1";
      $resultRifa = $this->db->consultar($sqlRifa, []);

      if (empty($resultRifa)) {
        $sqlInsertRifa = "INSERT INTO rifas (id_rifa, titulo, descripcion, fecha_inicio, fecha_fin, estado) 
                         VALUES (1, '🎉 ¡POR EL SUPERGANA! 🎉', 'Rifa principal', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'activa')";
        $this->db->ejecutar($sqlInsertRifa, []);
      }

      // Verificar si ya existen boletos
      $sql = "SELECT COUNT(*) as total FROM boletos";
      $result = $this->db->consultar($sql, []);

      if ($result[0]['total'] == 0) {
        // Crear índices para optimizar
        $sqlIndices = [
          "CREATE INDEX IF NOT EXISTS idx_numero_boleto ON boletos(numero_boleto)",
          "CREATE INDEX IF NOT EXISTS idx_estado ON boletos(estado)",
          "CREATE INDEX IF NOT EXISTS idx_id_rifa ON boletos(id_rifa)"
        ];

        foreach ($sqlIndices as $sqlIndex) {
          try {
            $this->db->ejecutar($sqlIndex, []);
          } catch (Exception $e) {
            // Ignorar si el índice ya existe
          }
        }

        // Insertar boletos en lotes de 1000 para mejor rendimiento
        $totalLotes = 10; // 10 lotes de 1000 para llegar a 10,000
        for ($batch = 0; $batch < $totalLotes; $batch++) {
          $sqlInsert = "INSERT INTO boletos (id_rifa, numero_boleto, estado) VALUES ";
          $values = [];

          $start = ($batch * 1000) + 1;
          $end = $start + 999;

          for ($i = $start; $i <= $end; $i++) {
            $numero = str_pad($i, 4, '0', STR_PAD_LEFT);
            $values[] = "(1, '$numero', 'disponible')";
          }

          $sqlInsert .= implode(',', $values);
          $this->db->ejecutar($sqlInsert, []);

          // Pequeña pausa entre lotes para no sobrecargar la BD
          usleep(100000); // 100ms de pausa
        }
      }
    } catch (Exception $e) {
      throw new Exception("Error al inicializar boletos: " . $e->getMessage());
    }
  }

  public function verificarDisponibilidad($numero)
  {
    $sql = "SELECT estado FROM boletos WHERE numero_boleto = :numero";
    $result = $this->db->consultar($sql, [':numero' => $numero]);

    if (empty($result)) {
      return false;
    }

    return $result[0]['estado'] === 'disponible';
  }

  public function verificarDisponibilidadConJoin($boletos)
  {
    try {
      $params = [];
      $placeholders = [];
      foreach ($boletos as $index => $numero) {
        $paramName = ":boleto" . ($index + 1);
        $params[$paramName] = $numero;
        $placeholders[] = $paramName;
      }

      // Modificamos la consulta para obtener todos los boletos, incluso si no existen
      $sql = "SELECT b.numero_boleto, 
                     CASE 
                       WHEN b.id_boleto IS NULL THEN false
                       WHEN b.estado = 'disponible' THEN true
                       ELSE false
                     END as disponible,
                     COALESCE(b.estado, 'no_existe') as estado
              FROM (SELECT " . implode(" UNION ALL SELECT ", array_fill(0, count($boletos), "?")) . ") AS nums(numero)
              LEFT JOIN boletos b ON b.numero_boleto = nums.numero";

      // Reemplazamos los placeholders con los números de boleto
      $result = $this->db->consultar($sql, $boletos);

      if (empty($result)) {
        // Si no hay resultados, significa que ningún boleto existe
        throw new Exception("Error al consultar los boletos");
      }

      $resultados = [];
      $mensajesError = [];

      foreach ($result as $row) {
        $estado = $row['estado'];
        $mensaje = "";

        switch ($estado) {
          case 'no_existe':
            $mensaje = "El boleto {$row['numero_boleto']} no existe en el sistema";
            break;
          case 'reservado':
            $mensaje = "El boleto {$row['numero_boleto']} está reservado";
            break;
          case 'vendido':
            $mensaje = "El boleto {$row['numero_boleto']} ya está vendido";
            break;
        }

        if ($mensaje) {
          $mensajesError[] = $mensaje;
        }

        $resultados[] = [
          'numero' => $row['numero_boleto'],
          'disponible' => $row['disponible'],
          'estado' => $estado
        ];
      }

      if (!empty($mensajesError)) {
        throw new Exception(implode("\n", $mensajesError));
      }

      return $resultados;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function procesarCompraConJoin($boletos, $nombre, $cedula, $telefono, $ubicacion, $total, $titular, $referencia, $metodoPago)
  {
    try {
      // 1. Primero verificamos la disponibilidad de todos los boletos
      $boletosVerificar = [];
      foreach ($boletos as $numeroBoleto) {
        $sqlBoleto = "SELECT id_boleto FROM boletos WHERE numero_boleto = :numero AND estado = 'disponible'";
        $resultBoleto = $this->db->consultar($sqlBoleto, [':numero' => $numeroBoleto]);

        if (empty($resultBoleto)) {
          throw new Exception("El boleto {$numeroBoleto} no está disponible");
        }
        $boletosVerificar[] = $resultBoleto[0]['id_boleto'];
      }

      // 2. Si llegamos aquí, todos los boletos están disponibles. Creamos la compra
      $sqlCompra = "INSERT INTO compras_boletos (id_rifa, total, estado, fecha_compra) 
                    VALUES (1, :total, 'pendiente', NOW())";

      $idCompra = $this->db->ejecutar($sqlCompra, [
        ':total' => $total
      ]);

      if (!$idCompra) {
        throw new Exception("Error al crear la compra");
      }

      // 3. Insertamos datos personales
      $sqlDatosPersonales = "INSERT INTO datos_personales (id_compra, nombre, cedula, telefono, ubicacion) 
                            VALUES (:id_compra, :nombre, :cedula, :telefono, :ubicacion)";

      $this->db->ejecutar($sqlDatosPersonales, [
        ':id_compra' => $idCompra,
        ':nombre' => $nombre,
        ':cedula' => $cedula,
        ':telefono' => $telefono,
        ':ubicacion' => $ubicacion
      ]);

      // 4. Marcamos los boletos como reservados y creamos el detalle
      $precioUnitario = $total / count($boletos);
      $boletosInsertados = [];

      foreach ($boletosVerificar as $index => $idBoleto) {
        // Actualizar estado del boleto a reservado
        $sqlUpdateBoleto = "UPDATE boletos 
                           SET estado = 'reservado' 
                           WHERE id_boleto = :id_boleto";

        $this->db->ejecutar($sqlUpdateBoleto, [
          ':id_boleto' => $idBoleto
        ]);

        // Insertar detalle de compra
        $sqlDetalle = "INSERT INTO detalle_compras (id_compra, id_boleto, precio_unitario) 
                       VALUES (:id_compra, :id_boleto, :precio_unitario)";

        $this->db->ejecutar($sqlDetalle, [
          ':id_compra' => $idCompra,
          ':id_boleto' => $idBoleto,
          ':precio_unitario' => $precioUnitario
        ]);

        $boletosInsertados[] = $boletos[$index];
      }

      // 5. Registrar el pago como pendiente
      $sqlPago = "INSERT INTO pagos (id_compra, titular, referencia, metodo, monto, fecha, estado) 
                  VALUES (:id_compra, :titular, :referencia, :metodo, :monto, NOW(), 'pendiente')";

      $this->db->ejecutar($sqlPago, [
        ':id_compra' => $idCompra,
        ':titular' => $titular,
        ':referencia' => $referencia,
        ':metodo' => $metodoPago,
        ':monto' => $total
      ]);

      return [
        'success' => true,
        'id_compra' => $idCompra,
        'boletos' => $boletosInsertados,
        'mensaje' => 'Compra procesada correctamente. Los boletos quedarán reservados hasta que se confirme el pago.'
      ];
    } catch (Exception $e) {
      throw $e;
    }
  }

  // Método para obtener boletos paginados con mejor rendimiento
  public function obtenerBoletosPaginados($pagina = 1, $porPagina = 100)
  {
    try {
      // Asegurarse de que los boletos estén inicializados
      $this->inicializarBoletos();

      $offset = ($pagina - 1) * $porPagina;

      // Optimizamos la consulta para mejor rendimiento
      $sql = "SELECT 
              b.numero_boleto,
              b.estado,
              CASE 
                  WHEN b.estado = 'disponible' THEN 'disponible'
                  ELSE b.estado
              END as estado_real
              FROM boletos b
              WHERE b.id_rifa = 1 
              ORDER BY CAST(b.numero_boleto AS UNSIGNED)
              LIMIT :limit OFFSET :offset";

      $boletos = $this->db->consultar($sql, [
        ':limit' => $porPagina,
        ':offset' => $offset
      ]);

      return [
        'success' => true,
        'data' => $boletos,
        'pagina' => $pagina,
        'por_pagina' => $porPagina,
        'total' => count($boletos)
      ];
    } catch (Exception $e) {
      throw new Exception("Error al obtener boletos: " . $e->getMessage());
    }
  }
}
