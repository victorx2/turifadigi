<?php

namespace App\Models;
use Exception;

use App\config\Conexion;

class Auditoria
{
  // Constantes para la tabla y columnas
  const TABLE_NAME = 'auditorias';
  const COLUMN_USER_ID = 'id_usuario';
  const COLUMN_ACTIONS = 'acciones';
  const COLUMN_DATE = 'fecha';
  const COLUMN_TIME = 'hora';

  private $conn;

  public function __construct()
  {
    $this->conn = new Conexion();
  }

  public function store(array $data): bool
  {
    try {
      $sql = "INSERT INTO " . self::TABLE_NAME . " 
                   (" . self::COLUMN_USER_ID . ", " . self::COLUMN_ACTIONS . ", " . self::COLUMN_DATE . ", " . self::COLUMN_TIME . ") 
                   VALUES (:id_usuario, :acciones, :fecha, :hora)";

      $parametros = [
        ':id_usuario' => $data['ID'],
        ':acciones' => $data['acciones'],
        ':fecha' => $data['fecha'],
        ':hora' => $data['hora']
      ];

      $this->conn->ejecutar($sql, $parametros);
      return true;
    } catch (\Exception $e) {
      error_log("Error en Auditoria::store: " . $e->getMessage());
      return false;
    }
  }
}
