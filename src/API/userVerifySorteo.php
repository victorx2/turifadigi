<?php
header('Content-Type: application/json');

use App\Models\Usuario;
use App\Models\DatosPersonales;


// 1. Obtener el cuerpo de la solicitud JSON crudo
//    php://input es un stream de solo lectura que permite acceder
//    a los datos crudos del cuerpo de la solicitud.
$json_data = file_get_contents('php://input');

// 2. Decodificar el JSON a un array asociativo de PHP
//    El segundo parámetro 'true' hace que json_decode devuelva un array asociativo.
//    Si lo dejas en 'false' (o lo omites), devolverá un objeto stdClass.
$data = json_decode($json_data, true);

// 3. Verificar si la decodificación fue exitosa y si los datos existen
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Hubo un error al decodificar el JSON
    header('Content-Type: application/json');
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid JSON received', 'json_error' => json_last_error_msg()]);
    exit();
}

$sesion = $data['id_usuario'] ?? '';
$t = $_GET['t'] ?? '';

try {
    if ($sesion == '') {
        echo json_encode(["session" => false, "msj" => "No data"]);
        exit;
    } else {

        $usuario = new Usuario();

        $result = $usuario->getById($sesion);

        if ($result !== null) {
            // VERIFICA SI SE REQUIEREN DATOS PERSONALES
            if ($t) {
                $personal = new DatosPersonales();

                $result = $personal->getByUsuarioId($sesion);
                echo json_encode([
                    "session" => true,
                    "user" => [
                        "id_usuario" => $result['id_usuario'],
                        "nombre" => $result['nombre'],
                        "apellido" => $result['apellido'],
                        "telefono" => $result['telefono'],
                        "ubicacion" => $result['ubicacion']
                    ],
                ]);
                exit;
            }
            echo json_encode([
                "session" => true
            ]);
        } else {
            echo json_encode(["session" => false]);
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
