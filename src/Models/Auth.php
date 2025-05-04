<?php

namespace App\Models;

use App\config\Conexion;
use Exception;

class LoginUser
{
  // Constantes para las tablas y columnas
  const TABLE_NAME = 'usuarios';
  const COLUMN_ID = 'id_usuario';
  const COLUMN_NAME = 'usuario';
  const COLUMN_PASSWORD = 'password';
  const COLUMN_PHONE = 'telefono_usuario';

  // Códigos de estado de login
  const LOGIN_SUCCESS = 1;
  const ERROR_INVALID_CREDENTIALS = 2;
  const ERROR_DATABASE = 3;
  const ERROR_INVALID_DATA = 4;

  // Mensajes de respuesta
  const MESSAGE_LOGIN_SUCCESS = 'Inicio de sesión exitoso';
  const MESSAGE_INVALID_CREDENTIALS = 'Credenciales inválidas';
  const MESSAGE_DATABASE_ERROR = 'Error al procesar la solicitud en la base de datos';
  const MESSAGE_INVALID_DATA = 'Datos inválidos o incompletos';

  private $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function login(array $request): int
  {
    try {
      // Debug para ver los datos recibidos
      error_log('Datos recibidos: ' . json_encode($request));

      // Validar datos requeridos
      if (empty($request['usuario']) || empty($request['password'])) {
        return self::ERROR_INVALID_DATA;
      }

      // Consulta SQL para validar solo por usuario
      $sql = "SELECT * FROM usuarios WHERE 
             usuario = :usuario 
             AND password = :password 
             LIMIT 1";

      $params = [
        ':usuario' => trim($request['usuario']),
        ':password' => trim($request['password'])
      ];

      // Debug de la consulta
      error_log('SQL Query: ' . $sql);
      error_log('Params: ' . json_encode($params));

      $result = $this->db->consultar($sql, $params);

      // Debug del resultado
      error_log('Query result: ' . json_encode($result));

      if ($result && count($result) > 0) {
        // Guardar datos en sesión
        $_SESSION['id_usuario'] = $result[0]['id_usuario'];
        $_SESSION['usuario'] = $result[0]['usuario'];
        $_SESSION['logged_in'] = true;

        return self::LOGIN_SUCCESS;
      }

      return self::ERROR_INVALID_CREDENTIALS;
    } catch (Exception $e) {
      error_log("Error en LoginUser::login: " . $e->getMessage());
      return self::ERROR_DATABASE;
    }
  }

  public function getStatusMessage(int $status): array
  {
    switch ($status) {
      case self::LOGIN_SUCCESS:
        return [
          'success' => true,
          'message' => 'Inicio de sesión exitoso',
          'type' => 'success'
        ];
      case self::ERROR_INVALID_CREDENTIALS:
        return [
          'success' => false,
          'message' => 'Usuario o contraseña incorrectos',
          'type' => 'error'
        ];
      case self::ERROR_INVALID_DATA:
        return [
          'success' => false,
          'message' => 'Datos inválidos o incompletos',
          'type' => 'error'
        ];
      default:
        return [
          'success' => false,
          'message' => 'Error al procesar la solicitud en la base de datos',
          'type' => 'error'
        ];
    }
  }
}
