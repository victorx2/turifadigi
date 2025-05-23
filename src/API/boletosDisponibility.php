<?php

header('Content-Type: application/json');

use App\Controllers\BoletoController;

try {
	$controller = new BoletoController();
	$id_rifa = $_GET['id_rifa'] ?? null;
	$id_boleto = $_GET['id_boleto'] ?? null;
	$controller->obtenerBoletos([$id_rifa, $id_boleto]);
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
