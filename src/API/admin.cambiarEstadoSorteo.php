<?php

header('Content-Type: application/json');

use App\Controllers\ConfigMainController;

$get = $_GET['est'];
$id = $_GET['id'];

if ($get == 'disabled') {
    $rut = new ConfigMainController();

    $ext = $rut->actualizarSorteo($id, 0);
    echo json_encode($ext);
    exit;
}

if ($get == 'enabled') {
    $rut = new ConfigMainController();

    $ext = $rut->actualizarSorteo($id, 1);
    echo json_encode($ext);
    exit;
}
