<?php 

use App\Controllers\AuthController;

$ctrl = new AuthController();

$ctrl->recuperarPassword(['correo' => $_REQUEST['correo']]);
