<?php

namespace App\Controllers;

class ToastController
{
  public static function success($titulo)
  {
    $_SESSION['mensaje'] = '
            <script>
                ToastPersonalizado.exito("' . $titulo . '", "");
            </script>
        ';
  }

  public static function error($titulo, $mensaje)
  {
    $_SESSION['mensaje'] = '
            <script>
                ToastPersonalizado.error("' . $titulo . '", "' . $mensaje . '");
            </script>
        ';
  }

  public static function info($titulo, $mensaje)
  {
    $_SESSION['mensaje'] = '
            <script>
                ToastPersonalizado.info("' . $titulo . '", "' . $mensaje . '");
            </script>
        ';
  }

  public static function warning($titulo, $mensaje)
  {
    $_SESSION['mensaje'] = '
            <script>
                ToastPersonalizado.advertencia("' . $titulo . '", "' . $mensaje . '");
            </script>
        ';
  }
}
