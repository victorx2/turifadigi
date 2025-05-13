<?php

header('Content-Type: application/json');

use App\Controllers\BoletoController;

try {
	$controller = new BoletoController();
	$controller->obtenerBoletos();
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
