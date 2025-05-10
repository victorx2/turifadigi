<?php

header('Content-Type: application/json');

use App\Controllers\MonedaController;

$mn = new MonedaController();

$mn->mostrarPrecioActual();