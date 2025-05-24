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
    $lang = $_SERVER['HTTP_X_LANGUAGE'] ?? 'es';
    if (!in_array($lang, ['es', 'en'])) $lang = 'es';
    $translations = $this->loadTranslations($lang);
    header('Content-Type: application/json');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');

    try {
      // Preparar datos del usuario
      $datosUsuario = [
        'usuario' => $data['usuario'] ?? '',
        'password' => $data['password'] ?? '',
      ];

      $datosPersonales = [
        'nombre' => $data['nombre'] ?? '',
        'apellido' => $data['apellido'] ?? '',
        'telefono' => $data['telefono'] ?? '',
        'ubicacion' => $data['ubicacion'] ?? ''
      ];
      // Verificar si el usuario existe antes de intentar insertar
      if ($this->usuario->existeUsuario($datosUsuario['usuario'])) {
        http_response_code(409);
        echo json_encode([
          'success' => false,
          'message' => $translations['username_already_exists'],
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
          'message' => $translations['user_registration_error'],
          'type' => 'error'
        ]);
        return;
      }

      // Registrar datos personales
      try {
        if ($this->usuario->registrarDatosPersonales($idUsuario, $datosPersonales)) {
          http_response_code(201);
          echo json_encode([
            'success' => true,
            'message' => $translations['user_registration_success'],
            'type' => 'success',
            'id_usuario' => $idUsuario,
            'redirect' => '/login'
          ]);
          return;
        }
      } catch (\Exception $e) {
        http_response_code(500);
        error_log("Error al registrar datos personales: " . $e->getMessage());
        echo json_encode([
          'success' => false,
          'message' => $translations['user_registration_error'],
          'type' => 'error'
        ]);
        return;
      }
    } catch (\Exception $e) {
      http_response_code(500);
      error_log("Error en RegistroController::insert: " . $e->getMessage());
      echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor: ' . $e->getMessage(),
        'type' => 'error'
      ]);
      return;
    }
  }

  public function loadTranslations($lang = 'es')
  {
    $file = __DIR__ . "/../../assets/language/{$lang}.json";
    if (file_exists($file)) {
      $json = file_get_contents($file);
      return json_decode($json, true);
    }
    $json = file_get_contents(__DIR__ . "/../../assets/language/es.json");
    return json_decode($json, true);
  }
}
