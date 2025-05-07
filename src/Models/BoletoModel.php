<?php

namespace App\Models;

use App\Config\Conexion;
use Exception;
use PDO;
use PhpOption\None;

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
      // Verificar si existe una rifa con su configuración asociada
      $sqlRifa = "SELECT *
                 FROM rifas r
                 INNER JOIN configuracion c ON r.id_configuracion = c.id_configuracion
                 WHERE c.estado = 1";
      $resultRifa = $this->db->consultar($sqlRifa, []);

      // CREAR RIFA DEBERIA SER OTRA FUNCION BB
      // if (empty($resultRifa)) {
      //   try {
      //       // Primero insertar la configuración necesaria con las columnas correctas
      //       $sqlInsertConfig = "INSERT INTO configuracion (id_configuracion, fecha_inicio, fecha_fin) 
      //                         VALUES (1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY))";
      //       $this->db->ejecutar($sqlInsertConfig, []);

      //       // Luego insertar la rifa con la configuración asociada
      //       $sqlInsertRifa = "INSERT INTO rifas (id_rifa, titulo, descripcion, estado, fecha_creacion, id_configuracion) 
      //                       VALUES (1, '🎉 ¡POR EL SUPERGANA! 🎉', 'Rifa principal', 'activa', CURDATE(), 1)";
      //       $this->db->ejecutar($sqlInsertRifa, []);
      //   } catch (Exception $e) {
      //       throw new Exception("Error al inicializar la rifa: " . $e->getMessage());
      //   }
      // }

      // Verificar si ya existen boletos y cuántos hay
      if (!$resultRifa) {
        throw new Exception("No se encontró una rifa activa");
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

  public function procesarCompraConJoin($id_usuario, $boletos, $montoPagado, $titular, $referencia, $metodoPago)
  {
    try {
      // 1. Primero verificamos la disponibilidad de todos los boletos
      $boletosVerificar = [];
      foreach ($boletos as $numeroBoleto) {
        $sqlBoleto = "SELECT b.id_boleto FROM boletos b INNER JOIN rifas r INNER JOIN configuracion c WHERE b.numero_boleto = :numero AND b.estado = 'disponible' AND c.estado= 1";
        $resultBoleto = $this->db->consultar($sqlBoleto, [':numero' => $numeroBoleto]);

        if (empty($resultBoleto)) {
          throw new Exception("El boleto {$numeroBoleto} no está disponible");
        }
        $boletosVerificar[] = $resultBoleto[0]['id_boleto'];
      }

      // 2. Si llegamos aquí, todos los boletos están disponibles. Creamos la compra
      $rifa = $this->db->consultar("SELECT r.id_rifa, c.precio FROM rifas r INNER JOIN configuracion c WHERE c.estado= 1", []);

      $sqlCompra = "INSERT INTO compras_boletos (id_rifa, fecha_compra, estado, total_compra) 
                    VALUES (:id_rifa, NOW(), 'pendiente', :total)";

      if (empty($rifa)) {
        throw new Exception("No se encontró una rifa activa");
      }

      $id_rifa_activa = $rifa[0]['id_rifa'];
      $precioUnitario = $rifa[0]['precio'];
      $totalCompra = count($boletosVerificar) * $precioUnitario;

      $idCompra = $this->db->ejecutar($sqlCompra, [
        ':id_rifa' => $id_rifa_activa,
        ':total' => $totalCompra
      ]);

      if (!$idCompra) {
        throw new Exception("Error al crear la compra");
      }

      // 4. Marcamos los boletos como reservados y creamos el detalle
      $boletosInsertados = [];

      foreach ($boletosVerificar as $index => $idBoleto) {
        // Actualizar estado del boleto a reservado
        $sqlUpdateBoleto = "UPDATE boletos 
                           SET estado = 'reservado', id_usuario = :id_usuario 
                           WHERE id_boleto = :id_boleto";

        $this->db->ejecutar($sqlUpdateBoleto, [
          ':id_boleto' => $idBoleto,
          ':id_usuario' => $id_usuario
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
      $sqlPago = "INSERT INTO pagos (id_compra, titular, referencia, metodo, monto_pagado) 
                  VALUES (:id_compra, :titular, :referencia, :metodo, :monto)";

      $this->db->ejecutar($sqlPago, [
        ':id_compra' => $idCompra,
        ':titular' => $titular,
        ':referencia' => $referencia,
        ':metodo' => $metodoPago,
        ':monto' => $montoPagado
      ]);

      return [
        'success' => true,
        'id_compra' => $idCompra,
        'boletos' => $boletosInsertados,
        'mensaje' => 'Compra procesada correctamente.'
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

  // Método para obtener boletos paginados con mejor rendimiento
  public function obtenerBoletos()
  {
    try {
      // Asegurarse de que los boletos estén inicializados
      $this->inicializarBoletos();

      // Optimizamos la consulta para mejor rendimiento
      $sql = "SELECT b.id_boleto, b.id_rifa, b.numero_boleto, b.estado AS estado, c.estado AS rifa_estado, r.id_rifa FROM boletos b INNER JOIN rifas r INNER JOIN configuracion c WHERE c.estado = 1 ORDER BY b.id_boleto ASC;";

      $boletos = $this->db->consultar($sql, []);

      return [
        'success' => true,
        'data' => $boletos,
        'total' => count($boletos)
      ];
    } catch (Exception $e) {
      throw new Exception("Error al obtener boletos: " . $e->getMessage());
    }
  }

  public function show()
  {
    try {
      $sql = "SELECT 
                cb.id_compra,
                b.numero_boleto,
                dp.nombre as cliente,
                p.metodo as metodo_pago,
                cb.total,
                cb.estado,
                cb.fecha_compra,
                TIMESTAMPADD(HOUR, 24, cb.fecha_compra) as fecha_limite,
                p.estado as estado_pago,
                p.titular,
                p.referencia
              FROM compras_boletos cb
              INNER JOIN detalle_compras dc ON cb.id_compra = dc.id_compra
              INNER JOIN boletos b ON dc.id_boleto = b.id_boleto
              INNER JOIN datos_personales dp ON cb.id_compra = dp.id_compra
              INNER JOIN pagos p ON cb.id_compra = p.id_compra
              WHERE cb.estado = 'pendiente'
              ORDER BY cb.fecha_compra DESC";

      $result = $this->db->consultar($sql, []);

      // Procesar los resultados para agrupar boletos por compra
      $compras = [];
      foreach ($result as $row) {
        $id_compra = $row['id_compra'];

        if (!isset($compras[$id_compra])) {
          // Primera vez que vemos esta compra
          $fecha_limite = new \DateTime($row['fecha_limite']);
          $ahora = new \DateTime();
          $tiempo_restante = $fecha_limite->diff($ahora);

          $compras[$id_compra] = [
            'id_compra' => $id_compra,
            'cliente' => $row['cliente'],
            'metodo_pago' => $row['metodo_pago'],
            'total' => $row['total'],
            'estado' => $row['estado'],
            'fecha_compra' => $row['fecha_compra'],
            'tiempo_restante' => [
              'horas' => $tiempo_restante->h + ($tiempo_restante->days * 24),
              'minutos' => $tiempo_restante->i,
              'expirado' => $ahora > $fecha_limite
            ],
            'estado_pago' => $row['estado_pago'],
            'titular' => $row['titular'],
            'referencia' => $row['referencia'],
            'boletos' => []
          ];
        }

        // Agregar el número de boleto a la compra
        $compras[$id_compra]['boletos'][] = $row['numero_boleto'];
      }

      return array_values($compras);
    } catch (Exception $e) {
      throw new Exception("Error al obtener los datos de compras: " . $e->getMessage());
    }
  }

  public function marcarCompraComoPagada($id_compra)
  {
    try {
      $sql = "UPDATE compras_boletos SET estado = 'pagado' WHERE id_compra = :id_compra";
      $this->db->ejecutar($sql, [':id_compra' => $id_compra]);
      return true;
    } catch (Exception $e) {
      throw new Exception("Error al actualizar el estado: " . $e->getMessage());
    }
  }
}
