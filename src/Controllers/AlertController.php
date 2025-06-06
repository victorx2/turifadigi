<?php

namespace App\Controllers;

class AlertController
{
  private const COLORS = [
    'success' => '#28a745',
    'info' => '#3FC3EE',
    'warning' => '#F8BB86',
    'error' => '#F27474'
  ];

  private const DEFAULT_TIMER = 3000;

  public static function success(string $titulo, ?string $texto = null)
  {
    self::setAlert('success', $titulo, $texto, self::DEFAULT_TIMER);
  }

  public static function info(string $titulo, string $texto)
  {
    self::setAlert('info', $titulo, $texto);
  }

  public static function warning(string $titulo, string $texto)
  {
    self::setAlert('warning', $titulo, $texto);
  }

  public static function error(string $titulo, string $texto)
  {
    self::setAlert('error', $titulo, $texto);
  }

  private static function setAlert(string $type, string $titulo, ?string $texto = null, ?int $timer = null)
  {
    if (!isset($_SESSION)) {
      session_start();
    }

    $titulo = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');
    $texto = $texto ? htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') : null;

    $config = [
      'icon' => $type,
      'title' => $titulo,
      'confirmButtonColor' => self::COLORS[$type] ?? self::COLORS['info']
    ];

    if ($texto) {
      $config['text'] = $texto;
    }

    if ($timer !== null) {
      $config['showConfirmButton'] = false;
      $config['timer'] = $timer;
    }

    $_SESSION['mensaje'] = sprintf(
      '<script>Swal.fire(%s);</script>',
      json_encode($config, JSON_HEX_QUOT | JSON_HEX_TAG)
    );
  }

  public static function clear()
  {
    if (isset($_SESSION['mensaje'])) {
      unset($_SESSION['mensaje']);
    }
  }
}
