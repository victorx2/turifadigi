<?php

namespace App\Controllers;

use App\Models\RegisterUser;


class RegisterUserController
{
  private $registro;

  public function __construct()
  {
    $this->registro = new RegisterUser();
  }

  public function insert(array $request): void
  {
    header('Content-Type: application/json');
    try {
      $result = $this->registro->insert($request);
      $response = $this->registro->getStatusMessage($result);
      echo json_encode($response);
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
