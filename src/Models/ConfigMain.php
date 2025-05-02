<?php

namespace App\Models;

use App\Config\Conexion;

class ConfigMain
{
  private $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function getAllCuentas()
  {
    $sql = "SELECT * FROM cuentas_pago";
    return $this->db->consultar($sql, []);
  }

  public function getCuenta($id)
  {
    $sql = "SELECT * FROM cuentas_pago WHERE id = ?";
    $result = $this->db->consultar($sql, [$id]);
    return $result ? $result[0] : null;
  }

  public function addCuenta($data)
  {
    $sql = "INSERT INTO cuentas_pago (nombre, tipo, correo, usuario, telefono, cedula, imagen) 
            VALUES (:nombre, :tipo, :correo, :usuario, :telefono, :cedula, :imagen)";
    return $this->db->ejecutar($sql, [
      ':nombre' => $data['nombre'],
      ':tipo' => $data['tipo'],
      ':correo' => $data['correo'],
      ':usuario' => $data['usuario'],
      ':telefono' => $data['telefono'],
      ':cedula' => $data['cedula'],
      ':imagen' => $data['imagen']
    ]);
  }

  public function updateCuenta($id, $data)
  {
    $sql = "UPDATE cuentas_pago 
            SET nombre = :nombre, 
                tipo = :tipo,
                correo = :correo, 
                usuario = :usuario, 
                telefono = :telefono, 
                cedula = :cedula, 
                imagen = :imagen 
            WHERE id = :id";

    return $this->db->ejecutar($sql, [
      ':nombre' => $data['nombre'],
      ':tipo' => $data['tipo'],
      ':correo' => $data['correo'],
      ':usuario' => $data['usuario'],
      ':telefono' => $data['telefono'],
      ':cedula' => $data['cedula'],
      ':imagen' => $data['imagen'],
      ':id' => $id
    ]);
  }

  public function deleteCuenta($id)
  {
    $sql = "DELETE FROM cuentas_pago WHERE id=:id";
    $this->db->ejecutar($sql, [':id' => $id]);
  }
}
