<?php

header('Content-Type: application/json');

use App\Controllers\RegisterUserController;

$Request = [
    "usuario" => $_REQUEST['usuario'],
    "password" => $_REQUEST['password'],
    "correo" => $_REQUEST['correo'],
    "nombre" => $_REQUEST['nombre'],
    "apellido" => $_REQUEST['apellido'],
    "telefono" => $_REQUEST['telefono'],
    "ubicacion" => $_REQUEST['ubicacion']

];

$register = new RegisterUserController();

$register->insert($Request);
