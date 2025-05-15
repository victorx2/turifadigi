<?php

namespace App\Controllers;

use App\Models\Auth;

class AuthController
{
    private $login;

    public function __construct()
    {
        $this->login = new Auth();
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

    public function recuperarPassword(array $request): void
    {
        header('Content-Type: application/json');
        try {
            // Validación básica de datos
            if (empty($request['correo'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'El correo electrónico es requerido',
                    'type' => 'error'
                ]);
                exit;
            }

            $result = $this->login->recuperarPassword($request);
            $response = $this->login->getStatusMessage($result);

            echo json_encode($response);
        } catch (\Exception $e) {
            error_log("Error en AuthController::recuperarPassword: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error al procesar la solicitud en la base de datos',
                'type' => 'error'
            ]);
        }
        exit();
    }

    public function resetPassword(array $request): void
    {
        header('Content-Type: application/json');
        try {
            // Validación básica de datos
            if (empty($request['token']) || empty($request['password'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Todos los campos son requeridos',
                    'type' => 'error'
                ]);
                exit;
            }

            $result = $this->login->resetPassword($request['token'], $request['password']);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Contraseña actualizada exitosamente',
                    'type' => 'success'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'El enlace de recuperación no es válido o ha expirado',
                    'type' => 'error'
                ]);
            }
        } catch (\Exception $e) {
            error_log("Error en AuthController::resetPassword: " . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Error al procesar la solicitud',
                'type' => 'error'
            ]);
        }
        exit();
    }
}
