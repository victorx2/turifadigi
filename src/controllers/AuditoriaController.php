<?php

namespace App\controllers;

class AuditoriaController
{
  private $db;

  public function __construct()
  {
    $this->db = new \PDO(
      "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'],
      $_ENV['DB_USERNAME'],
      $_ENV['DB_PASSWORD']
    );
  }

  public function store($data)
  {
    $stmt = $this->db->prepare("
            INSERT INTO auditoria (id_usuario, accion, fecha)
            VALUES (:id_usuario, :accion, NOW())
        ");

    return $stmt->execute([
      'id_usuario' => $data['ID'],
      'accion' => $data['accion']
    ]);
  }
}
