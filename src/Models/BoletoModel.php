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

      $sql = "SELECT b.numero_boleto, b.estado
              FROM boletos b
              WHERE b.numero_boleto IN (" . implode(',', $placeholders) . ")
              AND b.estado = 'disponible'";

      $result = $this->db->consultar($sql, $params);

      $resultados = [];
      $boletosNoDisponibles = [];

      foreach ($boletos as $numero) {
        $disponible = false;
        foreach ($result as $row) {
          if ($row['numero_boleto'] === $numero) {
            $disponible = true;
            break;
          }
        }

        if (!$disponible) {
          $boletosNoDisponibles[] = $numero;
        }

        $resultados[] = [
          'numero' => $numero,
          'disponible' => $disponible
        ];
      }

      if (!empty($boletosNoDisponibles)) {
        throw new Exception("Los siguientes boletos no están disponibles: " . implode(', ', $boletosNoDisponibles));
      }

      return $resultados;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function procesarCompraConJoin($boletos, $nombre, $cedula, $telefono, $ubicacion, $total, $titular, $referencia, $metodoPago)
  {
    try {
      // 1. Crear la compra primero
      $sqlCompra = "INSERT INTO compras_boletos (id_rifa, total, estado, fecha_compra) 
                    VALUES (1, :total, 'pendiente', NOW())";

      $idCompra = $this->db->ejecutar($sqlCompra, [
        ':total' => $total
      ]);

      if (!$idCompra) {
        throw new Exception("Error al crear la compra");
      }

      // 2. Insertar datos personales
      $sqlDatosPersonales = "INSERT INTO datos_personales (id_compra, nombre, cedula, telefono, ubicacion) 
                            VALUES (:id_compra, :nombre, :cedula, :telefono, :ubicacion)";

      $this->db->ejecutar($sqlDatosPersonales, [
        ':id_compra' => $idCompra,
        ':nombre' => $nombre,
        ':cedula' => $cedula,
        ':telefono' => $telefono,
        ':ubicacion' => $ubicacion
      ]);

      // 3. Procesar cada boleto
      $precioUnitario = $total / count($boletos);
      $boletosInsertados = [];

      foreach ($boletos as $numeroBoleto) {
        $sqlBoleto = "SELECT id_boleto FROM boletos WHERE numero_boleto = :numero AND estado = 'disponible'";
        $resultBoleto = $this->db->consultar($sqlBoleto, [':numero' => $numeroBoleto]);

        if (empty($resultBoleto)) {
          throw new Exception("El boleto {$numeroBoleto} no está disponible");
        }

        $idBoleto = $resultBoleto[0]['id_boleto'];

        // Actualizar estado del boleto
        $sqlUpdateBoleto = "UPDATE boletos 
                           SET estado = 'reservado' 
                           WHERE id_boleto = :id_boleto 
                           AND estado = 'disponible'";

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

        $boletosInsertados[] = $numeroBoleto;
      }

      // 4. Registrar el pago
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
        'mensaje' => 'Compra procesada correctamente'
      ];
    } catch (Exception $e) {
      throw $e;
    }
  }
}
