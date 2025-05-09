<?php

namespace App\Controllers;

use App\Models\ConfigMain;
use Exception;

class ConfigMainController
{
  private $model;

  // Constructor: Inicializa el modelo ConfigMain
  public function __construct()
  {
    $this->model = new ConfigMain();
  }

  // Método index: Carga la vista para crear un sorteo
  public function index()
  {
    require_once 'views/admin/crear_sorteo.php';
  }

  // Método crearSorteo: Maneja la creación de un nuevo sorteo
  public function crearSorteo()
  {
    try {
      // Obtener datos del formulario
      $idUsuario = $_SESSION['id_usuario'] ?? 0;
      $titulo = $_POST['titulo'] ?? '';
      $precioBoleto = $_POST['precio_boleto'] ?? 0;
      $boletosMinimos = $_POST['boletos_minimos'] ?? 0;
      $boletosMaximos = $_POST['boletos_maximos'] ?? 0;
      $fechaInicio = $_POST['fecha_inicio'] ?? '';
      $fechaFin = $_POST['fecha_final'] ?? '';
      $numeroContacto = $_POST['numero_contacto'] ?? '';
      $urlRifa = $_POST['url_rifa'] ?? '';
      $textoEjemplo = $_POST['texto_ejemplo'] ?? '';
      $premios = $_POST['premios'] ?? [];

      // Validaciones básicas
      if (empty($titulo) || empty($fechaInicio) || empty($fechaFin)) {
        throw new Exception('Todos los campos son requeridos');
      }

      if (strtotime($fechaInicio) > strtotime($fechaFin)) {
        throw new Exception('La fecha de inicio no puede ser mayor a la fecha final');
      }

      if ($precioBoleto <= 0) {
        throw new Exception('El precio del boleto debe ser mayor a 0');
      }

      if ($boletosMinimos <= 0 || $boletosMaximos <= 0) {
        throw new Exception('Las cantidades de boletos deben ser mayores a 0');
      }

      if ($boletosMinimos > $boletosMaximos) {
        throw new Exception('La cantidad mínima no puede ser mayor a la máxima');
      }

      // Crear el sorteo usando el modelo
      $idSorteo = $this->model->crearSorteo(
        $idUsuario,
        $titulo,
        $fechaInicio,
        $fechaFin,
        $precioBoleto,
        $boletosMinimos,
        $boletosMaximos,
        $numeroContacto,
        $urlRifa,
        $textoEjemplo,
        $premios
      );

      if ($idSorteo) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Sorteo creado exitosamente']);
        exit();
      } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Error al crear el sorteo']);
        exit();
      }
    } catch (Exception $e) {
      header('Content-Type: application/json');
      echo json_encode(['success' => false, 'error' => $e->getMessage()]);
      exit();
    }
  }
}
