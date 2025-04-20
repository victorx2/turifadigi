<?php
class BaseController
{
  protected $model;
  protected $view;

  public function __construct()
  {
    // Inicializar el modelo correspondiente si existe
    $model_name = str_replace('Controller', '', get_class($this));
    $model_file = "models/{$model_name}Model.php";

    if (file_exists($model_file)) {
      require_once $model_file;
      $model_class = $model_name . 'Model';
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
