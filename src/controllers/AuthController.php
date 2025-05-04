<?php

namespace App\Controllers;

use App\Models\LoginUser;

class AuthController
{
    private $login;

    public function __construct()
    {
        $this->login = new LoginUser();
    }

    public function login(array $request): void
    {
        header('Content-Type: application/json');
        try {
            // Validación básica de datos
            if (empty($request['usuario']) || empty($request['password'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Todos los campos son requeridos',
                    'type' => 'error'
                ]);
                exit;
            }

            $result = $this->login->login($request);
            $response = $this->login->getStatusMessage($result);

            // Debug temporal
            error_log('Login attempt - Identificador: ' . $request['usuario']);
            error_log('Login result: ' . json_encode($response));

            echo json_encode($response);
        } catch (\Exception $e) {
            error_log("Error en AuthController::login: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error al procesar la solicitud en la base de datos',
                'type' => 'error'
            ]);
        }
        exit();
    }
}
