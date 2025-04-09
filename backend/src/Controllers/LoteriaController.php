<?php
require_once 'BaseController.php';

class LoteriaController extends BaseController
{
  public function index()
  {
    // Obtener datos del modelo
    $sorteos = $this->model->getSorteos();

    // Renderizar vista
    $this->render('loteria/index', [
      'sorteos' => $sorteos
    ]);
  }

  public function crear()
  {
    // Mostrar formulario de creación
    $this->render('loteria/crear');
  }

  public function crearPost()
  {
    // Procesar datos del formulario
    $data = $_POST;

    if ($this->model->crearSorteo($data)) {
      $this->redirect('/loteria');
    } else {
      $this->render('loteria/crear', [
        'error' => 'Error al crear el sorteo'
      ]);
    }
  }

  public function editar($id)
  {
    $sorteo = $this->model->getSorteo($id);

    if ($sorteo) {
      $this->render('loteria/editar', [
        'sorteo' => $sorteo
      ]);
    } else {
      $this->redirect('/loteria');
    }
  }

  public function editarPost($id)
  {
    $data = $_POST;

    if ($this->model->actualizarSorteo($id, $data)) {
      $this->redirect('/loteria');
    } else {
      $this->render('loteria/editar', [
        'sorteo' => $data,
        'error' => 'Error al actualizar el sorteo'
      ]);
    }
  }

  public function eliminar($id)
  {
    if ($this->model->eliminarSorteo($id)) {
      $this->jsonResponse(['success' => true]);
    } else {
      $this->jsonResponse(['error' => 'Error al eliminar el sorteo'], 500);
    }
  }
}
