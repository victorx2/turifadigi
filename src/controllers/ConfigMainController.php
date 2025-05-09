<?php

namespace App\Controllers;

use App\Models\ConfigMain;
use Exception;

class ConfigMainController
{
  private $model;

  public function __construct()
  {
    $this->model = new ConfigMain();
  }

  public function index()
  {
    require_once 'views/admin/crear_sorteo.php';
  }

  public function crearSorteo()
  {
    try {
      // Debug: Mostrar datos recibidos
      echo '<pre>Datos POST recibidos: ';
      print_r($_POST);
      echo '</pre>';

      echo '<pre>Datos SESSION: ';
      print_r($_SESSION);
      echo '</pre>';

      echo '<pre>Var dump POST: ';
      var_dump($_POST);
      echo '</pre>';

      echo '<pre>Var dump SESSION: ';
      var_dump($_SESSION);
      echo '</pre>';

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

      // Validar datos requeridos
      if (empty($titulo) || empty($fechaInicio) || empty($fechaFin)) {
        throw new Exception('Todos los campos son requeridos');
      }

      // Validar fechas
      if (strtotime($fechaInicio) > strtotime($fechaFin)) {
        throw new Exception('La fecha de inicio no puede ser mayor a la fecha final');
      }

      // Validar precios y cantidades
      if ($precioBoleto <= 0) {
        throw new Exception('El precio del boleto debe ser mayor a 0');
      }

      if ($boletosMinimos <= 0 || $boletosMaximos <= 0) {
        throw new Exception('Las cantidades de boletos deben ser mayores a 0');
      }

      if ($boletosMinimos > $boletosMaximos) {
        throw new Exception('La cantidad mínima no puede ser mayor a la máxima');
      }

      // Crear el sorteo en la base de datos
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
        // Si la petición es AJAX/fetch, responde JSON
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
          header('Content-Type: application/json');
          echo json_encode(['success' => true]);
          exit();
        }
        $_SESSION['success'] = 'Sorteo creado exitosamente';
        header('Location: /TuRifadigi/crear_sorteo');
        exit();
      } else {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
          header('Content-Type: application/json');
          echo json_encode(['success' => false, 'error' => 'Error al crear el sorteo']);
          exit();
        }
        throw new Exception('Error al crear el sorteo');
      }
    } catch (Exception $e) {
      $_SESSION['error'] = $e->getMessage();
      header('Location: /TuRifadigi/main_config');
      exit();
    }
  }
}
