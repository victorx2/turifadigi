<?php

namespace App\Controllers;

require_once __DIR__ . '/../Models/Sorteo.php';

use App\Models\SorteoModel;
use Exception;

class SorteoController
{
  private $model;

  public function __construct()
  {
    $this->model = new SorteoModel();
  }


  public function obtenerSorteo($id_sorteo = null, $id_usuario = null)
  {
    try {
      if ($id_usuario !== null) {
        $data = $this->model->obtenerSorteosByUser($id_usuario);
        return ([
          "success" => true,
          "data" => $data
        ]);
      }
      if ($id_sorteo !== null) {
        $data = $this->model->obtenerSorteosByID($id_sorteo);
        return ([
          "success" => true,
          "data" => $data
        ]);
      }
      $data = $this->model->obtenerSorteos();
      return ([
        "success" => true,
        "data" => $data
      ]);
    } catch (Exception $e) {
      
      echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
      exit;
    }
  }
}
