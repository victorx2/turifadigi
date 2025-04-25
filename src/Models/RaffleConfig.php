<?php

namespace App\Models;

class RaffleConfig
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function getConfig()
  {
    // Obtener configuración básica
    $sql = "SELECT cr.*, cp.precio_boleto, cp.boletos_minimos 
            FROM configuracion_rifa cr 
            JOIN configuracion_precios cp ON cr.configuracion_precios_id = cp.id 
            WHERE cr.id = 1";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $config = $stmt->fetch(\PDO::FETCH_ASSOC);

    // Obtener premios
    $sql = "SELECT p.*, tp.nombre as tipo_premio 
            FROM premios p 
            JOIN tipos_premios tp ON p.tipo_premio_id = tp.id";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $config['premios'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $config;
  }

  public function updateConfig($data)
  {
    try {
      $this->db->beginTransaction();

      // Actualizar configuración de precios
      $sqlPrecios = "UPDATE configuracion_precios SET 
                    precio_boleto = :precio_boleto,
                    boletos_minimos = :boletos_minimos
                    WHERE id = :config_precio_id";

      $stmtPrecios = $this->db->prepare($sqlPrecios);
      $stmtPrecios->execute([
        ':precio_boleto' => $data['precio_boleto'],
        ':boletos_minimos' => $data['boletos_minimos'],
        ':config_precio_id' => 1
      ]);

      // Actualizar configuración principal
      $sqlConfig = "UPDATE configuracion_rifa SET 
                    titulo = :titulo,
                    numero_contacto = :numero_contacto,
                    url_loteria = :url_loteria,
                    texto_ejemplo = :texto_ejemplo
                    WHERE id = 1";

      $stmtConfig = $this->db->prepare($sqlConfig);
      $stmtConfig->execute([
        ':titulo' => $data['titulo'],
        ':numero_contacto' => $data['numero_contacto'],
        ':url_loteria' => $data['url_loteria'],
        ':texto_ejemplo' => $data['texto_ejemplo']
      ]);

      // Actualizar premios
      foreach ($data['premios'] as $premio) {
        $sqlPremio = "UPDATE premios SET 
                      descripcion = :descripcion,
                      boletos_minimos = :boletos_minimos
                      WHERE id = :id AND tipo_premio_id = :tipo_premio_id";

        $stmtPremio = $this->db->prepare($sqlPremio);
        $stmtPremio->execute([
          ':descripcion' => $premio['descripcion'],
          ':boletos_minimos' => $premio['boletos_minimos'],
          ':id' => $premio['id'],
          ':tipo_premio_id' => $premio['tipo_premio_id']
        ]);
      }

      $this->db->commit();
      return true;
    } catch (\Exception $e) {
      $this->db->rollBack();
      return false;
    }
  }

  public function getTiposPremios()
  {
    $sql = "SELECT * FROM tipos_premios";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
