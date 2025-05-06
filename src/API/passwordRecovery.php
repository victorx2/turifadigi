<?php 
header('Content-Type: application/json');

use App\Controllers\AuthController;

$ctrl = new AuthController();

$ctrl->recuperarPassword(['correo' => $_REQUEST['correo']]);
