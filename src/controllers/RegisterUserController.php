<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\DatosPersonales;

class RegisterUserController
{
  private $usuario;
  private $datosPersonales;

  public function __construct()
  {
    $this->usuario = new Usuario();
    $this->datosPersonales = new DatosPersonales();
  }

  public function insert(): void
  {
    header('Content-Type: application/json');
    try {
      // Obtener y validar los datos del formulario
      $datosUsuario = [
        'nombre_usuario' => $_POST['nombre_usuario'] ?? '',
        'clave_usuario' => $_POST['clave_usuario'] ?? '',
        'telefono_usuario' => $_POST['telefono_usuario'] ?? '',
        'correo_usuario' => $_POST['correo_usuario'] ?? ''
      ];

      $datosPersonales = [
        'nombre' => $_POST['nombre'] ?? '',
        'apellido' => $_POST['apellido'] ?? '',
        'cedula' => $_POST['cedula'] ?? '',
        'telefono' => $_POST['telefono_usuario'] ?? '',
        'ubicacion' => $_POST['ubicacion'] ?? ''
      ];

      // Validación básica
      foreach ($datosUsuario as $valor) {
        if (empty($valor)) {
          echo json_encode([
            'success' => false,
            'message' => 'Todos los campos de usuario son requeridos',
            'type' => 'error'
          ]);
          exit();
        }
      }

      foreach ($datosPersonales as $valor) {
        if (empty($valor)) {
          echo json_encode([
            'success' => false,
            'message' => 'Todos los campos de datos personales son requeridos',
            'type' => 'error'
          ]);
          exit();
        }
      }

      // Registrar usuario
      $idUsuario = $this->usuario->insert($datosUsuario);

      if (!$idUsuario) {
        echo json_encode([
          'success' => false,
          'message' => 'Error al registrar el usuario. El nombre de usuario o teléfono ya existe.',
          'type' => 'error'
        ]);
        exit();
      }

      // Registrar datos personales
      $datosRegistrados = $this->datosPersonales->insert($idUsuario, $datosPersonales);

      if (!$datosRegistrados) {
        echo json_encode([
          'success' => false,
          'message' => 'El usuario se registró correctamente, pero hubo un error al guardar los datos personales.',
          'type' => 'warning'
        ]);
        exit();
      }

      echo json_encode([
        'success' => true,
        'message' => 'Usuario registrado correctamente',
        'type' => 'success'
      ]);
    } catch (\Exception $e) {
      error_log("Error en RegisterUserController::insert: " . $e->getMessage());
      echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor',
        'type' => 'error'
      ]);
    }
    exit();
  }
}
