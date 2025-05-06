<?php
header('Content-Type: application/json');

@session_start();

use App\Models\Usuario;

$sesion = $_SESSION['usuario'] ?? '';

print_r($sesion);
try {
    if ($sesion === '') {
        header("Location: /TuRifadigi/login");
        json_encode(["session" => false]);
        exit;
    } else {
        $usuario = new Usuario();
        $username = $_SESSION['usuario'];

        $result = $usuario->getByUsername($username);

        if ($result !== null) {
            json_encode([$result]);
        } else {
            json_encode(["session" => false]);
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
