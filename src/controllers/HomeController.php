<?php

namespace App\controllers;

class HomeController extends BaseController
{
  public function index() {}

  public function login()
  {
    require_once 'views/layouts/modal_login.php';
  }
}
