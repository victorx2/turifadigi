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

  public function crearSorteo($id_usuario, $titulo, $fecha_inicio, $fecha_final, $precio_boleto, $boletos_minimos, $boletos_maximos, $numero_contacto, $url_rifa, $texto_ejemplo, $premios, $rutaImagen, $crear_rifa = false)
  {
    try {
      // 1. Insertar en configuracion
      $sqlConfig = "INSERT INTO configuracion (id_usuario, titulo, fecha_inicio, fecha_final, precio_boleto, boletos_minimos, boletos_maximos, numero_contacto, url_rifa, texto_ejemplo) 
                    VALUES (:id_usuario, :titulo, :fecha_inicio, :fecha_final, :precio_boleto, :boletos_minimos, :boletos_maximos, :numero_contacto, :url_rifa, :texto_ejemplo)";
      $paramsConfig = [
        ':id_usuario' => $id_usuario,
        ':titulo' => $titulo,
        ':fecha_inicio' => $fecha_inicio,
        ':fecha_final' => $fecha_final,
        ':precio_boleto' => $precio_boleto,
        ':boletos_minimos' => $boletos_minimos,
        ':boletos_maximos' => $boletos_maximos,
        ':numero_contacto' => $numero_contacto,
        ':url_rifa' => $url_rifa,
        ':texto_ejemplo' => $texto_ejemplo
      ];
      $id_configuracion = $this->db->ejecutar($sqlConfig, $paramsConfig);

      // 2. Insertar en rifas
      $sqlRifa = "INSERT INTO rifas (id_configuracion, titulo, descripcion, imagen) VALUES (:id_configuracion, :titulo, :descripcion, :imagen)";
      $paramsRifa = [
        ':id_configuracion' => $id_configuracion,
        ':titulo' => $titulo,
        ':descripcion' => $texto_ejemplo,
        ':imagen' => $rutaImagen
      ];
      $id_rifa = $this->db->ejecutar($sqlRifa, $paramsRifa);

      // 3. Insertar premios
      foreach ($premios as $premio) {
        $sqlPremio = "INSERT INTO premios (id_rifa, nombre, descripcion) VALUES (:id_rifa, :nombre, :descripcion)";
        $paramsPremio = [
          ':id_rifa' => $id_rifa,
          ':nombre' => $premio['nombre'],
          ':descripcion' => $premio['descripcion']
        ];
        $this->db->ejecutar($sqlPremio, $paramsPremio);
      }

      // 4. Insertar boletos
      for ($i = 1; $i <= $boletos_maximos; $i++) {
        $numero_boleto = str_pad($i, 4, '0', STR_PAD_LEFT);
        $sqlBoleto = "INSERT INTO boletos (id_rifa, numero_boleto, estado) VALUES (:id_rifa, :numero_boleto, 'disponible')";
        $paramsBoleto = [
          ':id_rifa' => $id_rifa,
          ':numero_boleto' => $numero_boleto
        ];
        $this->db->ejecutar($sqlBoleto, $paramsBoleto);
      }

      return $id_rifa;
    } catch (\Exception $e) {
      throw new \Exception("Error al guardar el sorteo: " . $e->getMessage());
    }
  }

  public function obtenerRifaActiva()
  {
    $sql = "SELECT * FROM rifas r INNER JOIN configuracion c ON c.id_configuracion = r.id_configuracion LIMIT 1";
    $result = $this->db->consultar($sql, []);
    return $result ? $result[0] : null;
  }

  public function actualizarRifa($id_rifa, $estado)
  {
    try {
      $sql = "UPDATE `configuracion` c INNER JOIN rifas r on r.id_configuracion = c.id_configuracion SET `estado` = :estado WHERE r.id_rifa = :id_rifa";
      $result = $this->db->consultar($sql, [
        ':id_rifa' => $id_rifa,
        ':estado' => $estado,
      ]);
      return true;
    } catch (\Exception $th) {
      throw new \Exception("Error al actualizar el sorteo: " . $th->getMessage());
    }
  }

  public function desactivarRifas()
  {

    try {
      $sql = "UPDATE `configuracion` SET `estado` = 0";
      $result = $this->db->consultar($sql, []);

      return true;
    } catch (\Exception $th) {
      throw new \Exception("Error al desactivar sorteos: " . $th->getMessage());
    }
  }

  public function eliminarRifasPorCantidad($min, $max)
  {
    $sql = "DELETE FROM rifas WHERE total_boletos < :min OR total_boletos > :max";
    return $this->db->ejecutar($sql, [':min' => $min, ':max' => $max]);
  }

  public function obtenerRifasActivas()
  {
    $sql = "SELECT * FROM rifas WHERE estado = 1";
    return $this->db->consultar($sql, []);
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
}
