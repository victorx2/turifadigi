<?php

header('Content-Type: application/json');

use App\Controllers\BoletoController;

try {
	$controller = new BoletoController();
	$param = (isset($_GET['wn']) && $_GET['wn'] === '1') ? "simone" : null;
	$controller->obtenerBoletos($param);
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
