<?php

namespace App\Controllers;

use App\Models\RaffleConfig;

class RaffleConfigController
{
  private $model;

  public function __construct($db)
  {
    $this->model = new RaffleConfig($db);
  }

  public function showEditForm()
  {
    $config = $this->model->getConfig();
    $tiposPremios = $this->model->getTiposPremios();
    require_once 'views/admin/raffle-config.php';
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Datos de configuración principal
      $data = [
        'titulo' => $_POST['titulo'] ?? '',
        'precio_boleto' => $_POST['precio_boleto'] ?? 0,
        'boletos_minimos' => $_POST['boletos_minimos'] ?? 0,
        'numero_contacto' => $_POST['numero_contacto'] ?? '',
        'url_loteria' => $_POST['url_loteria'] ?? '',
        'texto_ejemplo' => $_POST['texto_ejemplo'] ?? '',
        'premios' => []
      ];

      // Procesar premios
      foreach ($_POST['premios'] as $id => $premio) {
        $data['premios'][] = [
          'id' => $id,
          'tipo_premio_id' => $premio['tipo_premio_id'],
          'descripcion' => $premio['descripcion'],
          'boletos_minimos' => $premio['boletos_minimos']
        ];
      }

      if ($this->model->updateConfig($data)) {
        $_SESSION['success'] = "Configuración actualizada exitosamente";
      } else {
        $_SESSION['error'] = "Error al actualizar la configuración";
      }
    }

    header('Location: /admin/raffle-config');
    exit;
  }
}
