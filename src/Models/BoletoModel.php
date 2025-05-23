<?php

namespace App\Models;

use App\config\Conexion;
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

  // public function inicializarBoletos()
  // {
  //   try {
  //     // Verificar si existe una rifa con su configuración asociada
  //     $sqlRifa = "SELECT *
  //                FROM rifas r
  //                INNER JOIN configuracion c ON r.id_configuracion = c.id_configuracion
  //                WHERE c.estado = 1";
  //     $resultRifa = $this->db->consultar($sqlRifa, []);

  //     // CREAR RIFA DEBERIA SER OTRA FUNCION BB
  //     // if (empty($resultRifa)) {
  //     //   try {
  //     //       // Primero insertar la configuración necesaria con las columnas correctas
  //     //       $sqlInsertConfig = "INSERT INTO configuracion (id_configuracion, fecha_inicio, fecha_fin) 
  //     //                         VALUES (1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY))";
  //     //       $this->db->ejecutar($sqlInsertConfig, []);

  //     //       // Luego insertar la rifa con la configuración asociada
  //     //       $sqlInsertRifa = "INSERT INTO rifas (id_rifa, titulo, descripcion, estado, fecha_creacion, id_configuracion) 
  //     //                       VALUES (1, '🎉 ¡POR EL SUPERGANA! 🎉', 'Rifa principal', 'activa', CURDATE(), 1)";
  //     //       $this->db->ejecutar($sqlInsertRifa, []);
  //     //   } catch (Exception $e) {
  //     //       throw new Exception("Error al inicializar la rifa: " . $e->getMessage());
  //     //   }
  //     // }

  //     // Verificar si ya existen boletos y cuántos hay
  //     if (!$resultRifa) {
  //       throw new Exception("No se encontró una rifa activa");
  //     }
  //   } catch (Exception $e) {
  //     throw new Exception("Error al inicializar boletos: " . $e->getMessage());
  //   }
  // }

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
        $sqlBoleto = "SELECT b.id_boleto FROM boletos b INNER JOIN rifas r ON b.id_rifa = r.id_rifa INNER JOIN configuracion c ON c.id_configuracion = r.id_configuracion WHERE b.numero_boleto = :numero AND b.estado ='disponible' AND c.estado= 1";
        $resultBoleto = $this->db->consultar($sqlBoleto, [':numero' => $numeroBoleto]);

        if (empty($resultBoleto)) {
          throw new Exception("El boleto {$numeroBoleto} no está disponible");
        }
        $boletosVerificar[] = $resultBoleto[0]['id_boleto'];
      }

      // 2. Si llegamos aquí, todos los boletos están disponibles. Creamos la compra
      $rifa = $this->db->consultar("SELECT r.id_rifa, c.precio_boleto FROM rifas r INNER JOIN configuracion c ON c.id_configuracion = r.id_configuracion WHERE c.estado= 1", []);

      $sqlCompra = "INSERT INTO compras_boletos (id_rifa, fecha_compra, estado, total_compra) 
                    VALUES (:id_rifa, NOW(), 'pendiente', :total)";

      if (empty($rifa)) {
        throw new Exception("No se encontró una rifa activa");
      }

      $id_rifa_activa = $rifa[0]['id_rifa'];
      $precioUnitario = $rifa[0]['precio_boleto'];
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
      // $this->inicializarBoletos();

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
      // $this->inicializarBoletos();

      // Optimizamos la consulta para mejor rendimiento
      $sql = "SELECT b.id_boleto, b.id_rifa, b.numero_boleto, b.estado AS estado, c.estado AS rifa_estado, r.id_rifa FROM boletos b INNER JOIN rifas r ON r.id_rifa = b.id_rifa INNER JOIN configuracion c ON c.id_configuracion = r.id_configuracion WHERE c.estado = 1 ORDER BY b.id_boleto ASC";

      $boletos = $this->db->consultar($sql, []);

      if (count($boletos) == 0) {
        return [
          'success' => false,
          'data' => ["rifa_estado" => "0"],
          'total' => count($boletos)
        ];
      }
      return [
        'success' => true,
        'data' => $boletos,
        'total' => count($boletos)
      ];
    } catch (Exception $e) {
      throw new Exception("Error al obtener boletos: " . $e->getMessage());
    }
  }









  public function obtenerBoletosGandores($rifaId, $numeroBoleto = null)
  {
    try {
      $sql = "SELECT
                  b.id_boleto,
                  b.id_rifa,
                  b.numero_boleto,
                  c.precio_boleto,
                  b.estado AS estado_boleto,
                  c.estado AS rifa_estado,
                  r.id_rifa,
                  u.id_usuario,
                  dp.nombre,
                  dp.apellido,
                  dp.telefono,
                  cb.id_compra,
                  cb.fecha_compra
              FROM
                  boletos b
              INNER JOIN
                  rifas r ON r.id_rifa = b.id_rifa
              INNER JOIN
                  configuracion c ON c.id_configuracion = r.id_configuracion
              LEFT JOIN
                  detalle_compras dc ON b.id_boleto = dc.id_boleto
              LEFT JOIN
                  compras_boletos cb ON cb.id_compra = dc.id_compra
              LEFT JOIN
                  usuarios u ON b.id_usuario = u.id_usuario
              LEFT JOIN
                  datos_personales dp ON dp.id_usuario = u.id_usuario
              WHERE b.id_rifa = ? AND b.id_boleto = ?";
      $params = [$rifaId, $numeroBoleto];

      $result = $this->db->consultar($sql, $params);

      if (empty($result)) {
        return [
          'success' => false,
          'message' => 'Falta boleto',
          'data' => [],
          'total' => 0
        ];
      }

      return [
        'success' => true,
        'data' => $result,
        'total' => count($result)
      ];
    } catch (Exception $e) {
      throw new Exception("Error al obtener boletos por filtros: " . $e->getMessage());
    }
  }














  















  public function obtenerCompras()
  {
    try {
      $sql = "SELECT
              cb.id_compra,
              b.id_rifa,
              b.numero_boleto,
              dp.nombre AS cliente,
              dp.apellido AS a_cliente,
              p.metodo AS metodo_pago,
              cb.total_compra,
              cb.estado,
              cb.fecha_compra,
              TIMESTAMPADD(HOUR, 24, cb.fecha_compra) AS fecha_limite,
              p.validacion AS estado_pago,
              p.titular,
              p.referencia, 
              p.monto_pagado
              FROM compras_boletos cb
              INNER JOIN detalle_compras dc ON cb.id_compra = dc.id_compra
              INNER JOIN boletos b ON dc.id_boleto = b.id_boleto
              INNER JOIN datos_personales dp ON b.id_usuario = dp.id_usuario  
              INNER JOIN pagos p ON cb.id_compra = p.id_compra
              ORDER BY
                cb.fecha_compra DESC";

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
            'cliente' => ucwords(strtolower($row['cliente'] . " " . $row['a_cliente'])),
            'metodo_pago' => $row['metodo_pago'],
            'total' => $row['total_compra'],
            'monto_pagado' => $row['monto_pagado'],
            'estado' => $row['estado'],
            'fecha_compra' => $row['fecha_compra'],
            'estado_pago' => $row['estado_pago'],
            'titular' => $row['titular'],
            'id_rifa' => $row['id_rifa'],
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

  public function obtenerComprasByID($id_entrada)
  {
    try {
      $sql = "SELECT
              cb.id_compra,
              b.id_rifa,
              b.numero_boleto,
              dp.nombre AS cliente,
              dp.apellido AS a_cliente,
              p.metodo AS metodo_pago,
              cb.total_compra,
              cb.estado,
              cb.fecha_compra,
              TIMESTAMPADD(HOUR, 24, cb.fecha_compra) AS fecha_limite,
              p.validacion AS estado_pago,
              p.titular,
              p.referencia, 
              p.monto_pagado
              FROM compras_boletos cb
              INNER JOIN detalle_compras dc ON cb.id_compra = dc.id_compra
              INNER JOIN boletos b ON dc.id_boleto = b.id_boleto
              INNER JOIN datos_personales dp ON b.id_usuario = dp.id_usuario  
              INNER JOIN pagos p ON cb.id_compra = p.id_compra
              WHERE
                cb.id_compra = :id_entrada
              ORDER BY
                cb.fecha_compra DESC";

      $result = $this->db->consultar(
        $sql,
        [':id_entrada' => $id_entrada]
      );

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
            'cliente' => ucwords(strtolower($row['cliente'] . " " . $row['a_cliente'])),
            'metodo_pago' => $row['metodo_pago'],
            'total' => $row['total_compra'],
            'monto_pagado' => $row['monto_pagado'],
            'estado' => $row['estado'],
            'fecha_compra' => $row['fecha_compra'],
            'estado_pago' => $row['estado_pago'],
            'titular' => $row['titular'],
            'referencia' => $row['referencia'],
            'id_rifa' => $row['id_rifa'],
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

  public function obtenerComprasByUser($id_entrada)
  {
    try {
      $sql = "SELECT
              cb.id_compra,
              b.id_rifa,
              b.numero_boleto,
              dp.nombre AS cliente,
              dp.apellido AS a_cliente,
              p.metodo AS metodo_pago,
              cb.total_compra,
              cb.estado,
              cb.fecha_compra,
              TIMESTAMPADD(HOUR, 24, cb.fecha_compra) AS fecha_limite,
              p.validacion AS estado_pago,
              p.titular,
              p.referencia, 
              p.monto_pagado
              FROM compras_boletos cb
              INNER JOIN detalle_compras dc ON cb.id_compra = dc.id_compra
              INNER JOIN boletos b ON dc.id_boleto = b.id_boleto
              INNER JOIN datos_personales dp ON b.id_usuario = dp.id_usuario  
              INNER JOIN pagos p ON cb.id_compra = p.id_compra
              WHERE
                b.id_usuario = :id_entrada
              ORDER BY
                cb.fecha_compra DESC";

      $result = $this->db->consultar(
        $sql,
        [':id_entrada' => $id_entrada]
      );

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
            'cliente' => ucwords(strtolower($row['cliente'] . " " . $row['a_cliente'])),
            'metodo_pago' => $row['metodo_pago'],
            'total' => $row['total_compra'],
            'monto_pagado' => $row['monto_pagado'],
            'estado' => $row['estado'],
            'fecha_compra' => $row['fecha_compra'],
            'estado_pago' => $row['estado_pago'],
            'titular' => $row['titular'],
            'referencia' => $row['referencia'],
            'id_rifa' => $row['id_rifa'],
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
      // Depuración: Verifica el valor recibido
      error_log("Intentando actualizar compra: " . $id_compra);

      $sql = "UPDATE compras_boletos SET estado = 'pagado' WHERE id_compra = :id_compra";
      $this->db->consultar($sql, [':id_compra' => $id_compra]);

      $result = $this->db->ejecutar($sql, [':id_compra' => $id_compra]);

      // Depuración: Verifica el resultado de la consulta
      error_log("Resultado de ejecutar SQL: " . print_r($result, true));

      // Si tu método ejecutar() retorna el número de filas afectadas, puedes comprobarlo:
      if ($result === 0) {
        error_log("No se actualizó ninguna fila. ¿El id_compra existe?");
        throw new Exception("No se actualizó ninguna fila. ¿El id_compra existe?");
      }

      return true;
    } catch (Exception $e) {
      throw new Exception("Error al actualizar el estado: " . $e->getMessage());
    }
  }

  public function marcarCompraComoRechazada($id_compra)
  {
    try {
      $sql = "UPDATE compras_boletos SET estado = 'rechazado' WHERE id_compra = :id_compra";
      $this->db->ejecutar($sql, [':id_compra' => $id_compra]);

      return true;
    } catch (Exception $e) {
      throw new Exception("Error al actualizar el estado: " . $e->getMessage());
    }
  }
}
