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

  public function obtenerRifaActiva()
  {
    $sql = "SELECT * FROM rifas WHERE estado = 'activa' LIMIT 1";
    $result = $this->db->consultar($sql, []);
    return $result ? $result[0] : null;
  }

  public function actualizarBanner($id_rifa, $imagen)
  {
    try {
      // Validar el tipo de archivo
      $allowed = ['image/jpeg', 'image/jpg', 'image/png'];
      if (!in_array($imagen['type'], $allowed)) {
        throw new \Exception('Solo se permiten archivos JPG y PNG');
      }

      // Validar tamaño (5MB máximo)
      if ($imagen['size'] > 5 * 1024 * 1024) {
        throw new \Exception('El archivo no debe superar los 5MB');
      }

      // Obtener la imagen actual antes de actualizarla
      $sql = "SELECT imagen FROM rifas WHERE id_rifa = :id_rifa";
      $result = $this->db->consultar($sql, [':id_rifa' => $id_rifa]);
      $imagenActual = $result[0]['imagen'] ?? null;

      // Procesar y guardar la nueva imagen
      $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
      $nombreArchivo = 'banner_' . time() . '.' . $extension;
      $rutaDestino = 'assets/img/backgrounds/' . $nombreArchivo;

      if (move_uploaded_file($imagen['tmp_name'], $rutaDestino)) {
        // Actualizar la base de datos con la nueva ruta
        $sql = "UPDATE rifas SET imagen = :imagen WHERE id_rifa = :id_rifa";
        $resultado = $this->db->ejecutar($sql, [
          ':imagen' => $rutaDestino,
          ':id_rifa' => $id_rifa
        ]);

        // Si la actualización fue exitosa y existe una imagen anterior que no sea la predeterminada
        if ($resultado && $imagenActual && $imagenActual !== 'assets/img/backgrounds/sorteo.jpg') {
          // Intentar eliminar la imagen anterior
          if (file_exists($imagenActual)) {
            unlink($imagenActual);
          }
        }

        return true;
      }

      throw new \Exception('Error al subir el archivo');
    } catch (\Exception $e) {
      // Si algo sale mal, asegurarse de eliminar la nueva imagen si se subió
      if (isset($rutaDestino) && file_exists($rutaDestino)) {
        unlink($rutaDestino);
      }
      throw $e;
    }
  }




































  /* public function getAllCuentas() */
  /* { */
  /*   $sql = "SELECT * FROM cuentas_pago"; */
  /*   return $this->db->consultar($sql, []); */
  /* } */

  /* public function getCuenta($id) */
  /* { */
  /*   $sql = "SELECT * FROM cuentas_pago WHERE id = ?"; */
  /*   $result = $this->db->consultar($sql, [$id]); */
  /*   return $result ? $result[0] : null; */
  /* } */

  /* public function addCuenta($data) */
  /* { */
  /*   $sql = "INSERT INTO cuentas_pago (nombre, tipo, correo, usuario, telefono, cedula, imagen)  */
  /*           VALUES (:nombre, :tipo, :correo, :usuario, :telefono, :cedula, :imagen)"; */
  /*   return $this->db->ejecutar($sql, [ */
  /*     ':nombre' => $data['nombre'], */
  /*     ':tipo' => $data['tipo'], */
  /*     ':correo' => $data['correo'], */
  /*     ':usuario' => $data['usuario'], */
  /*     ':telefono' => $data['telefono'], */
  /*     ':cedula' => $data['cedula'], */
  /*     ':imagen' => $data['imagen'] */
  /*   ]); */
  /* } */

  /* public function updateCuenta($id, $data) */
  /* { */
  /*   $sql = "UPDATE cuentas_pago  */
  /*           SET nombre = :nombre,  */
  /*               tipo = :tipo, */
  /*               correo = :correo,  */
  /*               usuario = :usuario,  */
  /*               telefono = :telefono,  */
  /*               cedula = :cedula,  */
  /*               imagen = :imagen  */
  /*           WHERE id = :id"; */

  /*   return $this->db->ejecutar($sql, [ */
  /*     ':nombre' => $data['nombre'], */
  /*     ':tipo' => $data['tipo'], */
  /*     ':correo' => $data['correo'], */
  /*     ':usuario' => $data['usuario'], */
  /*     ':telefono' => $data['telefono'], */
  /*     ':cedula' => $data['cedula'], */
  /*     ':imagen' => $data['imagen'], */
  /*     ':id' => $id */
  /*   ]); */
  /* } */

  /* public function deleteCuenta($id) */
  /* { */
  /*   $sql = "DELETE FROM cuentas_pago WHERE id=:id"; */
  /*   $this->db->ejecutar($sql, [':id' => $id]); */
  /* } */
}
