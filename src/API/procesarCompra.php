<?php
header('Content-Type: application/json');

use App\Controllers\BoletoController;

$bc = new BoletoController();

$bc->procesarCompra();
