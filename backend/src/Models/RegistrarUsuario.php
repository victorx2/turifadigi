<?php

namespace App\Models;

use App\config\Conexion;

class RegisterUser
{
  // Constantes para la tabla de usuarios
  const TABLE_NAME = 'usuarios';
  const COLUMN_NAME = 'nombre_usuario';
  const COLUMN_PASSWORD = 'password';
  const COLUMN_PHONE = 'phone';
  // Constantes para los errores
  const ERROR_USER_ALREADY_EXISTS = 1;
  // Constantes para los mensajes
  const MESSAGE_USER_ALREADY_EXISTS = 'El nombre de usuario ya existe';

  private $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function insert(array $request)
  {
    if ($this->consult($request) === self::ERROR_USER_ALREADY_EXISTS) {
      return;
    }

    $params = [
      ':nombre_usuario' => $request['name'],
      ':password' => $request['password'],
      ':phone' => $request['phone']
    ];
    $this->db->ejecutar("INSERT INTO " . self::TABLE_NAME . " (" . self::COLUMN_NAME . ", " . self::COLUMN_PASSWORD . ", " . self::COLUMN_PHONE . ") VALUES (:nombre_usuario, :password, :phone)", $params);
    return $this->alert(self::ERROR_USER_ALREADY_EXISTS);
  }

  public function consult(array $request)
  {
    if ($this->db->consultar("SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_NAME . " = :nombre_usuario", [':nombre_usuario' => $request['name']])) {
      $this->alert(self::ERROR_USER_ALREADY_EXISTS);
      return self::ERROR_USER_ALREADY_EXISTS;
    }
  }


  public function alert(int $error)
  {
    if ($error == self::ERROR_USER_ALREADY_EXISTS) {
      echo json_encode(['success' => false, 'message' => self::MESSAGE_USER_ALREADY_EXISTS]);
    } else {
      echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
    }
  }
}
