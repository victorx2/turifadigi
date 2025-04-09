<?php

namespace App\models;

class UsuariosModel
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

  public function buscar_usuario($user)
  {
    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :user");
    $stmt->execute(['user' => $user]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function updateEstado($estado, $id)
  {
    $stmt = $this->db->prepare("
      UPDATE usuarios 
      SET estado = :estado, 
          intentos_fallidos = :intentos,
          ultimo_login = CASE 
              WHEN :estado = 'activo' THEN NOW() 
              ELSE ultimo_login 
          END
      WHERE id = :id
    ");

    return $stmt->execute([
      'estado' => $estado,
      'intentos' => ($estado === 'bloqueado' ? 3 : 0),
      'id' => $id
    ]);
  }

  public function incrementarIntentosFallidos($id)
  {
    $stmt = $this->db->prepare("
      UPDATE usuarios 
      SET intentos_fallidos = intentos_fallidos + 1,
          estado = CASE 
              WHEN intentos_fallidos + 1 >= 3 THEN 'bloqueado'
              ELSE estado 
          END
      WHERE id = :id
    ");

    return $stmt->execute(['id' => $id]);
  }

  public function actualizarUltimoLogin($id)
  {
    $stmt = $this->db->prepare("
      UPDATE usuarios 
      SET ultimo_login = NOW(),
          intentos_fallidos = 0
      WHERE id = :id
    ");

    return $stmt->execute(['id' => $id]);
  }

  public function verificarPassword($id, $password)
  {
    $stmt = $this->db->prepare("SELECT password FROM usuarios WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $result && password_verify($password, $result['password']);
  }
}
