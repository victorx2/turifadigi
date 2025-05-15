<?php

namespace App\Controllers;

use App\Models\RaffleConfig;

class RaffleConfigController
{
  private $model;

  public function __construct()
  {
    $this->model = new RaffleConfig();
  }

  public function showEditForm()
  {
    // Obtener configuración actual o usar valores por defecto
    $config = $this->model->getConfig();

    // Si no hay configuración, usar valores por defecto
    if (empty($config)) {
      $config = [
        'titulo' => '🎉 ¡POR EL SUPERGANA! 🎉',
        'precio_boleto' => '3',
        'boletos_minimos' => '2',
        'numero_contacto' => '407-428-7580',
        'url_rifa' => 'https://tripletachira.com/',
        'texto_ejemplo' => 'Si compras 10 boletos, participas automáticamente en el sorteo de $1000 cuando se alcance el 50% de los números vendidos. El día se anunciará públicamente.',
        'premios' => [
          [
            'id' => 1,
            'nombre' => 'Premio Mayor',
            'descripcion' => "Si estás en Estados Unidos, ganas una moto\nSi estás en otro país, ganas el valor de la moto al cambio de la moneda local desde donde participes",
            'boletos_minimos' => 2
          ],
          [
            'id' => 2,
            'nombre' => 'Segundo Premio',
            'descripcion' => "Un iPhone 16 Pro Max\nDisponible para cualquier país participante",
            'boletos_minimos' => 2
          ],
          [
            'id' => 3,
            'nombre' => 'Tercer Premio',
            'descripcion' => "$1000 en efectivo\nEste premio se activa con el 50% de los boletos vendidos",
            'boletos_minimos' => 10
          ]
        ]
      ];
    }

    $tiposPremios = $this->model->getTiposPremios();
    extract(['config' => $config, 'tiposPremios' => $tiposPremios]);
    require_once 'views/admin/rifa_config.php';
  }

  public function update(array $request): void
  {
    try {
      $result = $this->model->updateConfig($request);
      $_SESSION['success'] = 'La configuración se ha actualizado correctamente';
    } catch (\Exception $e) {
      error_log("Error en RaffleConfigController::update: " . $e->getMessage());
      $_SESSION['error'] = 'Error al actualizar la configuración';
    }

    header('Location: /rifa_config');
    exit();
  }
}
