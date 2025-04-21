<?php

namespace App\Models;

class Auth
{
  private $usuarios;
  const MAX_INTENTOS = 3;

  public function __construct()
  {
    $this->usuarios = new Usuarios();
  }

  public function login($user, $password)
  {
    // Intentar autenticar por nombre de usuario
    $usuario = $this->usuarios->getUsuarioByUsername($user);

    // Si no se encuentra por nombre, intentar por teléfono
    if (!$usuario) {
      $usuario = $this->usuarios->getUsuarioByTelefono($user);
    }

    // Si no se encuentra el usuario
    if (!$usuario) {
      return false;
    }

    // Verificar si está bloqueado por intentos fallidos
    if ($usuario['intentos_fallidos'] >= self::MAX_INTENTOS) {
      return false;
    }

    // Verificar la contraseña
    if (password_verify($password, $usuario['clave_usuario'])) {
      // Resetear intentos fallidos y actualizar último acceso
      $this->usuarios->actualizarIntentosFallidos($usuario['id_usuario'], 0);
      $this->usuarios->actualizarUltimoAcceso($usuario['id_usuario']);

      $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
      $_SESSION['user'] = $usuario;
      return true;
    } else {
      // Incrementar intentos fallidos
      $intentos = $usuario['intentos_fallidos'] + 1;
      $this->usuarios->actualizarIntentosFallidos($usuario['id_usuario'], $intentos);
      return false;
    }
  }
}
