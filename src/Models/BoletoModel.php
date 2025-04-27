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

  //public function obtenerEstadoBoletos()
  //{
  //  $sql = "SELECT * FROM boletos";
  //  return $this->db->consultar($sql, []);
  //}

  public function verificarDisponibilidad($numero)
  {
    $sql = "SELECT estado FROM boletos WHERE numero_boleto = :numero";
    $result = $this->db->consultar($sql, [':numero' => $numero]);

    if (empty($result)) {
      return false; // El boleto no existe
    }

    return $result[0]['estado'] === 'disponible';
  }

  //public function actualizarEstadoBoleto($numero, $estado, $userId = null)
  //{
  //  $params = [
  //    ':numero' => $numero,
  //    ':estado' => $estado
  //  ];
  //
  //  $sql = "UPDATE boletos SET estado = :estado";
  //
  //  if ($userId !== null) {
  //    $sql .= ", user_id = :user_id";
  //    $params[':user_id'] = $userId;
  //  }
  //
  //  $sql .= " WHERE numero_boleto = :numero";
//
  //  return $this->db->ejecutar($sql, $params);
  //}

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

      // Modificamos la consulta para obtener solo boletos disponibles
      $sql = "SELECT b.numero_boleto, b.estado
              FROM boletos b
              WHERE b.numero_boleto IN (" . implode(',', $placeholders) . ")
              AND b.estado = 'disponible'";

      $result = $this->db->consultar($sql, $params);

      // Verificamos cada boleto solicitado
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

      // Si hay boletos no disponibles, lanzamos una excepción
      if (!empty($boletosNoDisponibles)) {
        throw new Exception("Los siguientes boletos no están disponibles: " . implode(', ', $boletosNoDisponibles));
      }

      return $resultados;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function procesarCompra($boletos, $nombre, $cedula, $telefono, $ubicacion, $total, $titular, $referencia, $metodoPago)
  {
    try {
      $this->db->getConexion()->beginTransaction();

      // 1. Insertar datos del comprador en la tabla usuarios (si no existe)
      $sqlUsuario = "INSERT INTO usuarios (nombre, cedula, telefono, ubicacion) 
                     VALUES (:nombre, :cedula, :telefono, :ubicacion)
                     ON DUPLICATE KEY UPDATE 
                     nombre = VALUES(nombre),
                     telefono = VALUES(telefono),
                     ubicacion = VALUES(ubicacion)";

      $paramsUsuario = [
        ':nombre' => $nombre,
        ':cedula' => $cedula,
        ':telefono' => $telefono,
        ':ubicacion' => $ubicacion
      ];

      $this->db->ejecutar($sqlUsuario, $paramsUsuario);

      // Obtener el ID del usuario
      $sqlGetUsuario = "SELECT id_usuario FROM usuarios WHERE cedula = :cedula";
      $resultUsuario = $this->db->consultar($sqlGetUsuario, [':cedula' => $cedula]);

      if (empty($resultUsuario)) {
        throw new Exception("Error al obtener el ID del usuario");
      }

      $idUsuario = $resultUsuario[0]['id_usuario'];

      // 2. Insertar la compra
      $sqlCompra = "INSERT INTO compras_boletos (id_usuario, id_rifa, total, estado, fecha_compra) 
                    VALUES (:id_usuario, 1, :total, 'pendiente', NOW())";

      $paramsCompra = [
        ':id_usuario' => $idUsuario,
        ':total' => $total
      ];

      $idCompra = $this->db->ejecutar($sqlCompra, $paramsCompra);

      if (!$idCompra) {
        throw new Exception("Error al crear la compra");
      }

      // 3. Insertar el detalle de la compra y actualizar boletos
      $precioUnitario = $total / count($boletos);

      foreach ($boletos as $numeroBoleto) {
        // Verificar y obtener el ID del boleto
        $sqlBoleto = "SELECT id_boleto FROM boletos WHERE numero_boleto = :numero AND estado = 'disponible'";
        $resultBoleto = $this->db->consultar($sqlBoleto, [':numero' => $numeroBoleto]);

        if (empty($resultBoleto)) {
          throw new Exception("El boleto {$numeroBoleto} no está disponible");
        }

        $idBoleto = $resultBoleto[0]['id_boleto'];

        // Actualizar estado del boleto
        $sqlUpdateBoleto = "UPDATE boletos 
                           SET estado = 'reservado', 
                               id_usuario = :id_usuario 
                           WHERE id_boleto = :id_boleto 
                           AND estado = 'disponible'";

        $resultUpdate = $this->db->ejecutar($sqlUpdateBoleto, [
          ':id_usuario' => $idUsuario,
          ':id_boleto' => $idBoleto
        ]);

        if (!$resultUpdate) {
          throw new Exception("Error al actualizar el estado del boleto {$numeroBoleto}");
        }

        // Insertar detalle de compra
        $sqlDetalle = "INSERT INTO detalle_compras (id_compra, id_boleto, precio_unitario) 
                       VALUES (:id_compra, :id_boleto, :precio_unitario)";

        $resultDetalle = $this->db->ejecutar($sqlDetalle, [
          ':id_compra' => $idCompra,
          ':id_boleto' => $idBoleto,
          ':precio_unitario' => $precioUnitario
        ]);

        if (!$resultDetalle) {
          throw new Exception("Error al registrar el detalle de la compra");
        }
      }

      // 4. Registrar el pago
      $sqlPago = "INSERT INTO pagos (id_compra, titular, referencia, metodo, monto, fecha, estado) 
                  VALUES (:id_compra, :titular, :referencia, :metodo, :monto, NOW(), 'pendiente')";

      $resultPago = $this->db->ejecutar($sqlPago, [
        ':id_compra' => $idCompra,
        ':titular' => $titular,
        ':referencia' => $referencia,
        ':metodo' => $metodoPago,
        ':monto' => $total
      ]);

      if (!$resultPago) {
        throw new Exception("Error al registrar el pago");
      }

      $this->db->getConexion()->commit();
      return true;
    } catch (Exception $e) {
      $this->db->getConexion()->rollBack();
      throw $e;
    }
  }

  public function procesarCompraConJoin($boletos, $nombre, $cedula, $telefono, $ubicacion, $total, $titular, $referencia, $metodoPago)
  {
    try {
      $this->db->getConexion()->beginTransaction();

      // 1. Insertar usuario
      $sqlUsuario = "INSERT INTO usuarios (nombre, cedula, telefono, ubicacion) 
                     VALUES (:nombre, :cedula, :telefono, :ubicacion)
                     ON DUPLICATE KEY UPDATE 
                     nombre = VALUES(nombre),
                     telefono = VALUES(telefono),
                     ubicacion = VALUES(ubicacion)";

      $this->db->ejecutar($sqlUsuario, [
        ':nombre' => $nombre,
        ':cedula' => $cedula,
        ':telefono' => $telefono,
        ':ubicacion' => $ubicacion
      ]);

      // 2. Obtener id_usuario
      $sqlGetUsuario = "SELECT id_usuario FROM usuarios WHERE cedula = :cedula";
      $resultUsuario = $this->db->consultar($sqlGetUsuario, [':cedula' => $cedula]);
      $idUsuario = $resultUsuario[0]['id_usuario'];

      // 3. Crear la compra
      $sqlCompra = "INSERT INTO compras_boletos (id_usuario, id_rifa, total, estado, fecha_compra) 
                    VALUES (:id_usuario, 1, :total, 'pendiente', NOW())";

      $idCompra = $this->db->ejecutar($sqlCompra, [
        ':id_usuario' => $idUsuario,
        ':total' => $total
      ]);

      // 4. Procesar cada boleto
      $precioUnitario = $total / count($boletos);
      $boletosInsertados = [];

      foreach ($boletos as $numeroBoleto) {
        // Obtener el id del boleto
        $sqlBoleto = "SELECT id_boleto FROM boletos WHERE numero_boleto = :numero AND estado = 'disponible'";
        $resultBoleto = $this->db->consultar($sqlBoleto, [':numero' => $numeroBoleto]);

        if (empty($resultBoleto)) {
          throw new Exception("El boleto {$numeroBoleto} no está disponible");
        }

        $idBoleto = $resultBoleto[0]['id_boleto'];

        // Actualizar estado del boleto
        $sqlUpdateBoleto = "UPDATE boletos 
                           SET estado = 'reservado', 
                               id_usuario = :id_usuario 
                           WHERE id_boleto = :id_boleto 
                           AND estado = 'disponible'";

        $this->db->ejecutar($sqlUpdateBoleto, [
          ':id_usuario' => $idUsuario,
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

      // 5. Registrar el pago
      $sqlPago = "INSERT INTO pagos (id_compra, titular, referencia, metodo, monto, fecha, estado) 
                  VALUES (:id_compra, :titular, :referencia, :metodo, :monto, NOW(), 'pendiente')";

      $this->db->ejecutar($sqlPago, [
        ':id_compra' => $idCompra,
        ':titular' => $titular,
        ':referencia' => $referencia,
        ':metodo' => $metodoPago,
        ':monto' => $total
      ]);

      // 6. Notificar al administrador
      $this->notificarAdministrador([
        'id_compra' => $idCompra,
        'boletos' => $boletosInsertados,
        'comprador' => [
          'nombre' => $nombre,
          'cedula' => $cedula,
          'telefono' => $telefono,
          'ubicacion' => $ubicacion
        ],
        'pago' => [
          'titular' => $titular,
          'referencia' => $referencia,
          'metodo' => $metodoPago,
          'monto' => $total
        ]
      ]);

      $this->db->getConexion()->commit();
      return [
        'success' => true,
        'id_compra' => $idCompra,
        'boletos' => $boletosInsertados,
        'mensaje' => 'Compra procesada correctamente'
      ];
    } catch (Exception $e) {
      $this->db->getConexion()->rollBack();
      throw $e;
    }
  }

  private function notificarAdministrador($datos)
  {
    // Aquí implementarías la lógica de notificación al administrador
    // Por ejemplo, enviar un email, guardar en una tabla de notificaciones, etc.
    $mensaje = "Nueva compra registrada:\n";
    $mensaje .= "ID Compra: " . $datos['id_compra'] . "\n";
    $mensaje .= "Boletos: " . implode(', ', $datos['boletos']) . "\n";
    $mensaje .= "Comprador: " . $datos['comprador']['nombre'] . "\n";
    $mensaje .= "Cédula: " . $datos['comprador']['cedula'] . "\n";
    $mensaje .= "Teléfono: " . $datos['comprador']['telefono'] . "\n";
    $mensaje .= "Ubicación: " . $datos['comprador']['ubicacion'] . "\n";
    $mensaje .= "Pago:\n";
    $mensaje .= "- Titular: " . $datos['pago']['titular'] . "\n";
    $mensaje .= "- Referencia: " . $datos['pago']['referencia'] . "\n";
    $mensaje .= "- Método: " . $datos['pago']['metodo'] . "\n";
    $mensaje .= "- Monto: " . $datos['pago']['monto'] . "\n";

    // Por ahora solo lo guardamos en un log
    error_log($mensaje);
  }

  public function guardarComprador($datos)
  {
    try {
      $sql = "INSERT INTO compradores (nombre, telefono, email, direccion, fecha_registro) 
              VALUES (:nombre, :telefono, :email, :direccion, NOW())";

      $params = [
        ':nombre' => $datos['nombre'],
        ':telefono' => $datos['telefono'],
        ':email' => $datos['email'],
        ':direccion' => $datos['direccion']
      ];

      return $this->db->ejecutar($sql, $params);
    } catch (Exception $e) {
      throw $e;
    }
  }
}
