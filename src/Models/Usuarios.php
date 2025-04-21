<?php

namespace App\Models;

use App\config\Conexion; 
 

class Usuarios
{
  private $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function getUsuarioByUsername($username)
  {
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :username";
    $result = $this->db->consultar($sql, [':username' => $username]);

    return $result ? $result[0] : null;
  }

  public function getUsuarioByTelefono($telefono)
  {
    $sql = "SELECT * FROM usuarios WHERE telefono_usuario = :telefono";
    $result = $this->db->consultar($sql, [':telefono' => $telefono]);

    return $result ? $result[0] : null;
  }

  public function actualizarIntentosFallidos($id_usuario, $intentos)
  {
    $sql = "UPDATE usuarios SET intentos_fallidos = :intentos WHERE id_usuario = :id";
    return $this->db->ejecutar($sql, [
      ':intentos' => $intentos,
      ':id' => $id_usuario
    ]);
  }

  public function actualizarUltimoAcceso($id_usuario)
  {
    $sql = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id_usuario = :id";
    return $this->db->ejecutar($sql, [':id' => $id_usuario]);
  }
}
