<?php

header('Content-Type: application/json');

use App\Controllers\BoletoController;

$get = $_GET['est'];
$id = $_GET['id'];

if ($get == 'disabled') {
    $rut = new BoletoController();

    $ext = $rut->confirmarPago($id);
    echo json_encode($ext);
    exit;
}

if ($get == 'enabled') {
    $rut = new BoletoController();

    $ext = $rut->rechazarPago($id);
    echo json_encode($ext);
    exit;
}
