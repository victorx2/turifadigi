<?php

namespace App\controllers;

class LoteriaController extends BaseController
{
  public function index()
  {
    $sorteos = $this->model->getSorteos();
    $this->render('loteria/index', [
      'title' => 'Lotería',
      'sorteos' => $sorteos
    ]);
  }

  public function crear()
  {
    $this->render('loteria/crear', [
      'title' => 'Crear Sorteo'
    ]);
  }

  public function crearPost()
  {
    $data = $_POST;
    if ($this->model->crearSorteo($data)) {
      $this->redirect('/loteria');
    } else {
      $this->render('loteria/crear', [
        'title' => 'Crear Sorteo',
        'error' => 'Error al crear el sorteo'
      ]);
    }
  }

  public function editar($id)
  {
    $sorteo = $this->model->getSorteo($id);
    if ($sorteo) {
      $this->render('loteria/editar', [
        'title' => 'Editar Sorteo',
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
        'title' => 'Editar Sorteo',
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
