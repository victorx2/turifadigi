<?php

header('Content-Type: application/json');

use App\Controllers\AuthController;

$Request = [
    "usuario" => $_REQUEST['usuario'],
    "password" => $_REQUEST['password']
];

$logg = new AuthController();

$logg->login($Request);
