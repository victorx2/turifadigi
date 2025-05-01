<?php

namespace App\Models;

use App\config\Conexion;
use Exception;

class RaffleConfig
{
  // Constantes para los estados
  const UPDATE_SUCCESS = 1;
  const ERROR_INVALID_DATA = 2;
  const ERROR_DATABASE = 3;

  // Mensajes de respuesta
  const MESSAGE_UPDATE_SUCCESS = 'Configuración actualizada exitosamente';
  const MESSAGE_INVALID_DATA = 'Datos inválidos o incompletos';
  const MESSAGE_DATABASE_ERROR = 'Error al procesar la solicitud en la base de datos';

  private $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function getConfig()
  {
    // Obtener configuración básica
    $sql = "SELECT cr.*, cp.precio_boleto, cp.boletos_minimos 
            FROM configuracion_rifas cr 
            INNER JOIN configuracion_precios cp ON cr.id_configuracion = cp.id 
            WHERE cr.id_configuracion = 1";

    $config = $this->db->consultar($sql, []);

    // Obtener premios
    $sql = "SELECT p.*, tp.nombre as tipo_premio 
            FROM premios p 
            INNER JOIN tipos_premios tp ON p.id_tipo_premio = tp.id_tipo_premio";

    $config['premios'] = $this->db->consultar($sql, []);

    return $config;
  }

  public function updateConfig(array $data): int
  {
    try {
      // Validar datos requeridos
      if (empty($data['titulo']) || empty($data['precio_boleto']) || empty($data['boletos_minimos'])) {
        return self::ERROR_INVALID_DATA;
      }

      // Actualizar configuración de precios
      $sqlPrecios = "UPDATE configuracion_precios SET 
                    precio_boleto = :precio_boleto,
                    boletos_minimos = :boletos_minimos
                    WHERE id = :config_precio_id";

      $this->db->ejecutar($sqlPrecios, [
        ':precio_boleto' => $data['precio_boleto'],
        ':boletos_minimos' => $data['boletos_minimos'],
        ':config_precio_id' => 1
      ]);

      // Actualizar configuración principal
      $sqlConfig = "UPDATE configuracion_rifas SET 
                    titulo = :titulo,
                    numero_contacto = :numero_contacto,
                    url_rifa = :url_rifa,
                    texto_ejemplo = :texto_ejemplo
                    WHERE id = 1";

      $this->db->ejecutar($sqlConfig, [
        ':titulo' => $data['titulo'],
        ':numero_contacto' => $data['numero_contacto'],
        ':url_rifa' => $data['url_rifa'],
        ':texto_ejemplo' => $data['texto_ejemplo']
      ]);

      // Actualizar premios
      if (isset($data['premios']) && is_array($data['premios'])) {
        foreach ($data['premios'] as $premio) {
          $sqlPremio = "UPDATE premios SET 
                        descripcion = :descripcion,
                        boletos_minimos = :boletos_minimos
                        WHERE id = :id AND tipo_premio_id = :tipo_premio_id";

          $this->db->ejecutar($sqlPremio, [
            ':descripcion' => $premio['descripcion'],
            ':boletos_minimos' => $premio['boletos_minimos'],
            ':id' => $premio['id'],
            ':tipo_premio_id' => $premio['tipo_premio_id']
          ]);
        }
      }

      return self::UPDATE_SUCCESS;
    } catch (Exception $e) {
      error_log("Error en RaffleConfig::updateConfig: " . $e->getMessage());
      return self::ERROR_DATABASE;
    }
  }

  public function getTiposPremios()
  {
    $sql = "SELECT * FROM tipos_premios";
    return $this->db->consultar($sql, []);
  }

  public function getStatusMessage(int $status): array
  {
    switch ($status) {
      case self::UPDATE_SUCCESS:
        return [
          'success' => true,
          'message' => self::MESSAGE_UPDATE_SUCCESS,
          'type' => 'success'
        ];
      case self::ERROR_INVALID_DATA:
        return [
          'success' => false,
          'message' => self::MESSAGE_INVALID_DATA,
          'type' => 'error'
        ];
      default:
        return [
          'success' => false,
          'message' => self::MESSAGE_DATABASE_ERROR,
          'type' => 'error'
        ];
    }
  }
}
