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
        'usuario' => $_POST['usuario'] ?? '',
        'password' => $_POST['password'] ?? '',
        'correo' => $_POST['correo'] ?? ''
      ];

      $datosPersonales = [
        'nombre' => $_POST['nombre'] ?? '',
        'apellido' => $_POST['apellido'] ?? '',
        'cedula' => $_POST['cedula'] ?? '',
        'telefono' => $_POST['telefono'] ?? '',
        'ubicacion' => $_POST['ubicacion'] ?? ''
      ];

      // Validación básica de usuario y contraseña
      if (empty($datosUsuario['usuario']) || empty($datosUsuario['password'])) {
        echo json_encode([
          'success' => false,
          'message' => 'El nombre de usuario y la contraseña son requeridos',
          'type' => 'error'
        ]);
        exit();
      }

      // Validación de datos personales
      if (
        empty($datosPersonales['nombre']) || empty($datosPersonales['apellido']) ||
        empty($datosPersonales['cedula']) || empty($datosPersonales['telefono']) ||
        empty($datosPersonales['ubicacion'])
      ) {
        echo json_encode([
          'success' => false,
          'message' => 'Todos los campos de datos personales son requeridos',
          'type' => 'error'
        ]);
        exit();
      }

      // Registrar usuario
      $idUsuario = $this->usuario->insert($datosUsuario);

      if (!$idUsuario) {
        echo json_encode([
          'success' => false,
          'message' => 'Error al registrar el usuario. El nombre de usuario ya existe.',
          'type' => 'error'
        ]);
        exit();
      }

      // Registrar datos personales
      if ($this->usuario->registrarDatosPersonales($idUsuario, $datosPersonales)) {
        echo json_encode([
          'success' => true,
          'message' => 'Usuario y datos personales registrados correctamente',
          'type' => 'success'
        ]);
      } else {
        echo json_encode([
          'success' => false,
          'message' => 'Error al registrar los datos personales',
          'type' => 'error'
        ]);
      }
    } catch (\Exception $e) {
      error_log("Error en RegistroController::insert: " . $e->getMessage());
      echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor: ' . $e->getMessage(),
        'type' => 'error'
      ]);
    }
    exit();
  }
}
