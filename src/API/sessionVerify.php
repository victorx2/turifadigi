<?php
use App\Models\Usuario;

$sesion = $_SESSION['usuario'] ?? '';

if ($sesion === '') {
    header("Location: /TuRifadigi/login");
    json_encode(["session" => false]);
    exit;
} else {
    $usuario = $_SESSION['usuario'];


    
}
