<?php

namespace App\Controllers;

require_once __DIR__ . '/../Models/BoletoModel.php';

use App\Models\BoletoModel;
use Exception;

class BoletoController
{
  private $model;

  public function __construct()
  {
    $this->model = new BoletoModel();
    // Asegurarnos de que existan los boletos en la base de datos
    $this->model->inicializarBoletos();
  }
  public function procesarCompra()
  {
    header('Content-Type: application/json');

    try {
      $data = json_decode(file_get_contents('php://input'), true);

      if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Error en el formato JSON de entrada');
      }

      // Validar datos requeridos
      $camposRequeridos = [
        'boletos' => 'Boletos seleccionados',
        'nombre' => 'Nombre completo',
        'cedula' => 'Cédula',
        'telefono' => 'Teléfono',
        'ubicacion' => 'Ubicación',
        'total' => 'Total a pagar',
        'titular' => 'Titular de la cuenta',
        'referencia' => 'Referencia de pago',
        'metodo_pago' => 'Método de pago'
      ];

      foreach ($camposRequeridos as $campo => $nombre) {
        if (empty($data[$campo])) {
          throw new Exception("El campo {$nombre} es requerido");
        }
      }

      // Procesar la compra usando una única transacción con INNER JOIN
      $result = $this->model->procesarCompraConJoin(
        $data['boletos'],
        $data['nombre'],
        $data['cedula'],
        $data['telefono'],
        $data['ubicacion'],
        $data['total'],
        $data['titular'],
        $data['referencia'],
        $data['metodo_pago']
      );

      echo json_encode([
        'success' => true,
        'message' => 'Compra procesada correctamente'
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
      ]);
    }
  }


  public function verificarDisponibilidad()
  {
    // Limpiar cualquier salida anterior
    ob_clean();

    // Establecer headers
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');

    try {
      // Obtener y decodificar datos de entrada
      $jsonInput = file_get_contents('php://input');
      $data = json_decode($jsonInput, true);

      if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Error en el formato JSON de entrada');
      }

      $boletos = $data['boletos'] ?? [];

      if (empty($boletos)) {
        throw new Exception('No se proporcionaron números de boleto');
      }

      // Verificar disponibilidad usando INNER JOIN
      $resultados = $this->model->verificarDisponibilidadConJoin($boletos);

      // Verificar si hay boletos no disponibles
      $noDisponibles = array_filter($resultados, function ($boleto) {
        return !$boleto['disponible'];
      });

      if (!empty($noDisponibles)) {
        $numerosNoDisponibles = array_map(function ($boleto) {
          return $boleto['numero'];
        }, $noDisponibles);

        http_response_code(409); // Conflict
        echo json_encode([
          'error' => true,
          'mensaje' => 'Algunos boletos no están disponibles',
          'boletosNoDisponibles' => $numerosNoDisponibles
        ]);
        exit;
      }

      echo json_encode([
        'success' => true,
        'disponibles' => $resultados
      ]);
      exit;
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode([
        'error' => true,
        'mensaje' => $e->getMessage()
      ]);
      exit;
    }
  }
}
