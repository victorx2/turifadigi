<?php

header('Content-Type: application/json');

use App\Controllers\SorteoController;

try {
  $controller = new SorteoController(); 
  $ede  = $controller->obtenerSorteo();

  $data = $ede['data'];

  echo json_encode([
    'success' => true,
    'message' => 'Compras obtenidas correctamente',
    'data' => $data,
  ]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
