<?php

namespace App\Controllers;

use App\Models\Auditoria;

class AuditoriaController
{

  private $audi;

  public function __construct()
  {
    $this->audi = new Auditoria();
  }

  public function index() {}

  public function store(array $request)
  {
    $request['fecha'] = date('Y-m-d');
    $request['hora'] = date('H:i:s');
    $bool = $this->audi->store($request);
    return true;
  }
}
