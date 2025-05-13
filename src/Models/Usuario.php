<?php

namespace App\Models;

use App\config\Conexion;
use Exception;

class Usuario
{
  // Constantes para las tablas y columnas de la base de datos
  const TABLE_NAME = 'usuarios';
  const COLUMN_ID = 'id_usuario';
  const COLUMN_STATUS = 'id_estatus';
  const COLUMN_NAME = 'usuario';
  const COLUMN_PASSWORD = 'password';
  const COLUMN_PHONE = 'telefono';
  const COLUMN_EMAIL = 'correo';
  const COLUMN_LAST_ACCESS = 'ultimo_acceso';
  const COLUMN_ATTEMPTS = 'intentos_fallidos';

  const STATUS_TABLE = 'usuarios_estados';
  const STATUS_ID = 'id_estatus_estado';
  const STATUS_NAME = 'usuario_estado';

  const ROLES_TABLE = 'usuarios_roles';
  const ROLE_ID = 'id_rol';
  const ROLE_NAME = 'usuario_rol';

  private $db;
  private $datosPersonales;
  private $audi;

  /**
   * Constructor: Inicializa la conexión a la base de datos y el modelo de datos personales
   */
  public function __construct()
  {
    $this->db = new Conexion();
    $this->audi = new Auditoria();
    $this->datosPersonales = new DatosPersonales();
  }

  /**
   * Inserta un nuevo usuario en la base de datos
   * @param array $data - Datos del usuario (usuario, password, telefono, correo)
   * @return int|bool - ID del usuario insertado o false en caso de error
   */
  public function insert(array $data): int|bool
  {
    try {
      // Validar datos requeridos
      if (empty($data['usuario']) || empty($data['password'])) {
        error_log("Error en Usuario::insert: Datos requeridos faltantes");
        return false;
      }

      // Verificar si el usuario ya existe
      if ($this->existeUsuario($data['usuario'])) {
        error_log("Error en Usuario::insert: El usuario ya existe");
        return false;
      }

      // Insertar el usuario
      $userSql = "INSERT INTO " . self::TABLE_NAME . " 
                (usuario, password,correo,nivel,estado) 
                VALUES (:usuario, :password,:correo,1,1)";

      $userId = $this->db->ejecutar($userSql, [
        ':usuario' => $data['usuario'],
        ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ':correo' => $data['correo']
      ]);

      $this->audi->store([
        'ID' => $userId,
        'acciones' => 'Usuario Registrado',
        'fecha' => date('Y-m-d'),
        'hora' => date('H:i:s')
      ]);
      if (!$userId) {
        error_log("Error en Usuario::insert: No se pudo insertar el usuario");
        return false;
      }

      return $userId;
    } catch (Exception $e) {
      error_log("Error en Usuario::insert: " . $e->getMessage());
      return false;
    }
  }

  /**
   * Obtiene un usuario por su ID
   * @param int $id - ID del usuario
   * @return array|null - Datos del usuario o null si no existe
   */
  public function getById(int $id): ?array
  {
    try {
      $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_ID . " = :id";
      $result = $this->db->consultar($sql, [':id' => $id]);

      return $result ? $result[0] : null;
    } catch (Exception $e) {
      error_log("Error en Usuario::getById: " . $e->getMessage());
      return null;
    }
  }

  /**
   * Obtiene un usuario por su nombre de usuario
   * @param string $username - Nombre de usuario
   * @return array|null - Datos del usuario o null si no existe
   */
  public function getByUsername(string $username): ?array
  {
    try {
      $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_NAME . " = :username";
      $result = $this->db->consultar($sql, [':username' => $username]);

      return $result ? $result[0] : null;
    } catch (Exception $e) {
      error_log("Error en Usuario::getByUsername: " . $e->getMessage());
      return null;
    }
  }

  /**
   * Obtiene un usuario por su teléfono
   * @param string $telefono - Número de teléfono
   * @return array|null - Datos del usuario o null si no existe
   */
  public function getByTelefono(string $telefono): ?array
  {
    try {
      $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_PHONE . " = :telefono";
      $result = $this->db->consultar($sql, [':telefono' => $telefono]);

      return $result ? $result[0] : null;
    } catch (Exception $e) {
      error_log("Error en Usuario::getByTelefono: " . $e->getMessage());
      return null;
    }
  }

  /**
   * Actualiza los intentos fallidos de inicio de sesión
   * @param int $id_usuario - ID del usuario
   * @param int $intentos - Número de intentos fallidos
   * @return bool - true si se actualizó correctamente, false en caso contrario
   */
  public function actualizarIntentosFallidos(int $id_usuario, int $intentos): bool
  {
    try {
      $sql = "UPDATE " . self::TABLE_NAME . " SET " . self::COLUMN_ATTEMPTS . " = :intentos WHERE " . self::COLUMN_ID . " = :id";
      $this->db->ejecutar($sql, [
        ':intentos' => $intentos,
        ':id' => $id_usuario
      ]);

      return true;
    } catch (Exception $e) {
      error_log("Error en Usuario::actualizarIntentosFallidos: " . $e->getMessage());
      return false;
    }
  }

  /**
   * Actualiza la fecha y hora del último acceso
   * @param int $id_usuario - ID del usuario
   * @return bool - true si se actualizó correctamente, false en caso contrario
   */
  public function actualizarUltimoAcceso(int $id_usuario): bool
  {
    try {
      $sql = "UPDATE " . self::TABLE_NAME . " SET " . self::COLUMN_LAST_ACCESS . " = NOW() WHERE " . self::COLUMN_ID . " = :id";
      $this->db->ejecutar($sql, [':id' => $id_usuario]);

      return true;
    } catch (Exception $e) {
      error_log("Error en Usuario::actualizarUltimoAcceso: " . $e->getMessage());
      return false;
    }
  }

  /**
   * Registra datos personales para un usuario
   * @param int $id_usuario - ID del usuario
   * @param array $datos - Datos personales (nombre, apellido, cedula, telefono, ubicacion)
   * @return bool - true si se registró correctamente, false en caso contrario
   */
  public function registrarDatosPersonales(int $id_usuario, array $datos): bool
  {
    return $this->datosPersonales->insert($id_usuario, $datos);
  }

  /**
   * Obtiene los datos personales de un usuario
   * @param int $id_usuario - ID del usuario
   * @return array|null - Datos personales o null si no existen
   */
  public function obtenerDatosPersonales(int $id_usuario): ?array
  {
    return $this->datosPersonales->getByUsuarioId($id_usuario);
  }

  /**
   * Verifica si un usuario existe por su nombre de usuario
   * @param string $username - Nombre de usuario
   * @return bool - true si existe, false en caso contrario
   */
  public function existeUsuario(string $username): bool
  {
    $result = $this->db->consultar(
      "SELECT COUNT(*) as count FROM " . self::TABLE_NAME . " WHERE " . self::COLUMN_NAME . " = :username",
      [':username' => $username]
    );

    return $result && $result[0]['count'] > 0;
  }

  /**
   * Obtiene un rol existente o crea uno nuevo
   * @param string $rolName - Nombre del rol
   * @return int - ID del rol
   */

  /* private function obtenerOCrearRol(string $rolName): int */
  /* { */
  /*   try { */
  /*     // Verificar si el rol ya existe */
  /*     $sql = "SELECT " . self::ROLE_ID . " FROM " . self::ROLES_TABLE . " WHERE " . self::ROLE_NAME . " = :role_name"; */
  /*     $result = $this->db->consultar($sql, [':role_name' => $rolName]); */

  /*     if ($result && count($result) > 0) { */
  /*       return $result[0][self::ROLE_ID]; */
  /*     } */

  /*     // Si no existe, crearlo */
  /*     $sql = "INSERT INTO " . self::ROLES_TABLE . " (" . self::ROLE_NAME . ") VALUES (:role_name)"; */
  /*     return $this->db->ejecutar($sql, [':role_name' => $rolName]); */
  /*   } catch (Exception $e) { */
  /*     error_log("Error en Usuario::obtenerOCrearRol: " . $e->getMessage()); */
  /*     throw $e; */
  /*   } */
  /* } */

  /**
   * Obtiene un estado existente o crea uno nuevo
   * @param string $estadoName - Nombre del estado
   * @param string $descripcion - Descripción del estado
   * @return int - ID del estado
   */
  /* private function obtenerOCrearEstado(string $estadoName, string $descripcion): int */
  /* { */
  /*   try { */
  /*     // Verificar si el estado ya existe */
  /*     $sql = "SELECT " . self::STATUS_ID . " FROM " . self::STATUS_TABLE . " WHERE " . self::STATUS_NAME . " = :status_name"; */
  /*     $result = $this->db->consultar($sql, [':status_name' => $estadoName]); */

  /*     if ($result && count($result) > 0) { */
  /*       return $result[0][self::STATUS_ID]; */
  /*     } */

  /*     // Si no existe, crearlo */
  /*     $sql = "INSERT INTO " . self::STATUS_TABLE . " (" . self::STATUS_NAME . ", descripcion_estado) VALUES (:status_name, :descripcion)"; */
  /*     return $this->db->ejecutar($sql, [ */
  /*       ':status_name' => $estadoName, */
  /*       ':descripcion' => $descripcion */
  /*     ]); */
  /*   } catch (Exception $e) { */
  /*     error_log("Error en Usuario::obtenerOCrearEstado: " . $e->getMessage()); */
  /*     throw $e; */
  /*   } */
  /* } */

  /**
   * Registra una acción en la tabla de auditoría
   * @param int $id_usuario - ID del usuario
   * @param string $accion - Descripción de la acción
   * @return int - ID de la auditoría
   */
  /* private function registrarAuditoria(int $id_usuario, string $accion): int */
  /* { */
  /*   try { */
  /*     $sql = "INSERT INTO usuarios_auditorias (id_usuario, acciones_auditoria, fecha_auditoria, hora_auditoria)  */
  /*             VALUES (:id_usuario, :accion, CURDATE(), CURTIME())"; */

  /*     return $this->db->ejecutar($sql, [ */
  /*       ':id_usuario' => $id_usuario, */
  /*       ':accion' => $accion */
  /*     ]); */
  /*   } catch (Exception $e) { */
  /*     error_log("Error en Usuario::registrarAuditoria: " . $e->getMessage()); */
  /*     throw $e; */
  /*   } */
  /* } */
}
