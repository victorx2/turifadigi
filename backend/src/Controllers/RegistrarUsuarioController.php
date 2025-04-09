<?php

namespace App\Controllers;

use App\Models\RegisterUser;
use App\Controllers\AlertController;

class RegisterUserController
{
  private $registro;

  public function __construct()
  {
    $this->registro = new RegisterUser();
  }

  public function insert(array $request)
  {
    $this->registro->insert($request);
    AlertController::success('Usuario registrado', 'El usuario se ha registrado correctamente');
  }
}
