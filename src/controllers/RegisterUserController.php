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

  public function insert(array $data): void
  {
    header('Content-Type: application/json');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');

    try {
      // Preparar datos del usuario
      $datosUsuario = [
        'usuario' => $data['usuario'] ?? '',
        'password' => $data['password'] ?? '',
        'correo' => $data['correo'] ?? ''
      ];

      $datosPersonales = [
        'nombre' => $data['nombre'] ?? '',
        'apellido' => $data['apellido'] ?? '',
        'cedula' => $data['cedula'] ?? '',
        'telefono' => $data['telefono'] ?? '',
        'ubicacion' => $data['ubicacion'] ?? ''
      ];

      // Verificar si el usuario existe antes de intentar insertar
      if ($this->usuario->existeUsuario($datosUsuario['usuario'])) {

        http_response_code(409);
        echo json_encode([
          'success' => false,
          'message' => 'El nombre de usuario ya existe',
          'type' => 'error'
        ]);
        return;
      }

      // Intentar registrar el usuario
      $idUsuario = $this->usuario->insert($datosUsuario);

      if ($idUsuario === false) {
        http_response_code(500);
        echo json_encode([
          'success' => false,
          'message' => 'Error al registrar el usuario',
          'type' => 'error'
        ]);
        return;
      }

      // Registrar datos personales
      if ($this->usuario->registrarDatosPersonales($idUsuario, $datosPersonales)) {

        http_response_code(201);
        echo json_encode([
          'success' => true,
          'message' => 'Registro exitoso',
          'type' => 'success',
          'redirect' => '/login'
        ]);
        return;
      } else {
        http_response_code(500);
        echo json_encode([
          'success' => false,
          'message' => 'Error al registrar los datos personales',
          'type' => 'error'
        ]);
        return;
      }
    } catch (\Exception $e) {
      http_response_code(500);
      error_log("Error en RegistroController::insert: " . $e->getMessage());
      echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor',
        'type' => 'error'
      ]);
      return;
    }
  }
}
