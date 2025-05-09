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
    $rifaActiva = $this->model->obtenerRifaActiva();
    $imagenFondo = $rifaActiva ? $rifaActiva['imagen'] : 'assets/img/backgrounds/sorteo.jpg';
    extract(compact('imagenFondo'));
    require_once 'views/admin/main.config.php';
  }

  public function actualizarConfig()
  {
    $titulo = $_POST['titulo'] ?? '';
    $precioBoleto = $_POST['precio_boleto'] ?? 0;
    $boletosMinimos = $_POST['boletos_minimos'] ?? 0;
    $boletosMaximos = $_POST['boletos_maximos'] ?? 0;
    $fechaInicio = $_POST['fecha_inicio'] ?? '';
    $fechaFin = $_POST['fecha_fin'] ?? '';

    $this->model->actualizarConfig($titulo, $precioBoleto, $boletosMinimos, $boletosMaximos, $fechaInicio, $fechaFin);
    $this->model->eliminarRifasPorCantidad($boletosMinimos, $boletosMaximos);

    $_SESSION['success'] = 'Configuración actualizada correctamente';
    header('Location: /TuRifadigi/main_config');
    exit();
  }





























































































  
  public function actualizarBanner()
  {
    try {
      if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        throw new \Exception('No se ha seleccionado ningún archivo o hubo un error en la subida');
      }

      $rifaActiva = $this->model->obtenerRifaActiva();
      if (!$rifaActiva) {
        throw new \Exception('No hay una rifa activa');
      }

      $this->model->actualizarBanner($rifaActiva['id_rifa'], $_FILES['imagen']);
      $_SESSION['success'] = 'Banner actualizado correctamente';
    } catch (\Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }

    header('Location: /TuRifadigi/main_config');
    exit();
  }

  /* public function listar() */
  /* { */
  /*   $cuentas = $this->model->getAllCuentas(); */
  /*   header('Content-Type: application/json'); */
  /*   echo json_encode($cuentas); */
  /* } */

  /* public function guardar() */
  /* { */
  /*   try { */
  /*     $data = [ */
  /*       'nombre' => $_POST['nombre'] ?? '', */
  /*       'tipo' => $_POST['tipo'] ?? '', */
  /*       'correo' => $_POST['correo'] ?? null, */
  /*       'usuario' => $_POST['usuario'] ?? null, */
  /*       'telefono' => $_POST['telefono'] ?? null, */
  /*       'cedula' => $_POST['cedula'] ?? null, */
  /*       'imagen' => null */
  /*     ]; */

  /*     // Manejo de imagen */
  /*     if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) { */
  /*       $nombreImg = uniqid() . '_' . $_FILES['imagen']['name']; */
  /*       $rutaDestino = 'assets/img/backgrounds/' . $nombreImg; */

  /*       if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) { */
  /*         $data['imagen'] = $rutaDestino; */
  /*       } */
  /*     } */

  /*     if (!empty($_POST['id'])) { */
  /*       $this->model->updateCuenta($_POST['id'], $data); */
  /*       $mensaje = 'Cuenta actualizada exitosamente'; */
  /*     } else { */
  /*       $this->model->addCuenta($data); */
  /*       $mensaje = 'Cuenta agregada exitosamente'; */
  /*     } */

  /*     echo json_encode([ */
  /*       'success' => true, */
  /*       'mensaje' => $mensaje */
  /*     ]); */
  /*   } catch (Exception $e) { */
  /*     echo json_encode([ */
  /*       'success' => false, */
  /*       'mensaje' => 'Error al procesar la solicitud: ' . $e->getMessage() */
  /*     ]); */
  /*   } */
  /* } */

  /* public function eliminar() */
  /* { */
  /*   $id = $_POST['id'] ?? 0; */
  /*   $this->model->deleteCuenta($id); */
  /*   echo json_encode(['success' => true]); */
  /* } */
}
