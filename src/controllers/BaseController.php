<?php

namespace App\controllers;

class BaseController
{
  protected $model;
  protected $view;

  public function __construct()
  {
    // Inicializar el modelo correspondiente si existe
    $model_name = str_replace('Controller', '', get_class($this));
    $model_class = "App\\models\\" . $model_name . 'Model';

    if (class_exists($model_class)) {
      $this->model = new $model_class();
    }
  }

  // Método para cargar vistas
  protected function render($view, $data = [])
  {
    extract($data);
    ob_start();
    include_once "views/{$view}.php";
    $content = ob_get_clean();
    include_once 'views/layouts/main.php';
  }

  // Método para respuestas JSON
  protected function jsonResponse($data, $status = 200)
  {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
  }

  // Método para redireccionar
  protected function redirect($url)
  {
    header("Location: {$url}");
    exit;
  }
}
