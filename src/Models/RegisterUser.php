<?php

namespace App\Models;

use App\config\Conexion;
use Exception;

class RegisterUser
{
  // Constantes para las tablas y columnas de la base de datos
  const TABLE_NAME = 'usuarios';
  const COLUMN_ID = 'id_usuario';
  const COLUMN_STATUS = 'id_estatus';
  const COLUMN_NAME = 'nombre_usuario';
  const COLUMN_PASSWORD = 'clave_usuario';
  const COLUMN_PHONE = 'telefono_usuario';
  const COLUMN_EMAIL = 'correo_usuario';

  const STATUS_TABLE = 'usuarios_estados';
  const STATUS_ID = 'id_estatus_estado';
  const STATUS_NAME = 'usuario_estado';
  const STATUS_DESC = 'descripcion_estado';

  const ROLES_TABLE = 'usuarios_roles';
  const ROLE_ID = 'id_rol';
  const ROLE_NAME = 'usuario_rol';

  const AUDIT_TABLE = 'usuarios_auditorias';
  const AUDIT_ID = 'id_auditoria';
  const AUDIT_USER_ID = 'id_usuario';
  const AUDIT_ACTION = 'acciones_auditoria';
  const AUDIT_DATE = 'fecha_auditoria';
  const AUDIT_TIME = 'hora_auditoria';

  const PERSONAL_DATA_TABLE = 'datos_personales';
  const PERSONAL_DATA_ID = 'id_datos';
  const PERSONAL_DATA_NAME = 'nombre';
  const PERSONAL_DATA_IDENT = 'cedula';
  const PERSONAL_DATA_PHONE = 'telefono';
  const PERSONAL_DATA_LOCATION = 'ubicacion';

  // Códigos de estado de registro
  const REGISTRATION_SUCCESS = 1;    // Registro exitoso
  const ERROR_USER_EXISTS = 2;       // Usuario ya existe
  const ERROR_PHONE_EXISTS = 3;      // Teléfono ya existe
  const ERROR_DATABASE = 4;          // Error de base de datos
  const ERROR_INVALID_DATA = 5;      // Datos inválidos

  // Mensajes de respuesta
  const MESSAGE_REGISTRATION_SUCCESS = 'Usuario registrado correctamente';
  const MESSAGE_USER_EXISTS = 'El nombre de usuario ya existe';
  const MESSAGE_PHONE_EXISTS = 'El número de teléfono ya está registrado';
  const MESSAGE_DATABASE_ERROR = 'Error al procesar la solicitud en la base de datos';

  const MESSAGE_INVALID_DATA = 'Datos inválidos o incompletos';

  // Valores por defecto
  const DEFAULT_STATUS = 1;
  const DEFAULT_STATUS_NAME = 'Activo';
  const DEFAULT_ROLE = 1;
  const DEFAULT_ROLE_NAME = 'Usuario';
  const DEFAULT_ROLE_DESC = 'Usuario normal del sistema';
  const DEFAULT_ROLE_ACTIVE = 1;

  private $db;

  /**
   * Constructor: Inicializa la conexión a la base de datos
   */
  public function __construct()
  {
    $this->db = new Conexion();
  }

  /**
   * insert: Inserta un nuevo usuario en la base de datos
   * @param array $request - Datos del usuario a registrar
   * @return int - Código de estado del registro
   * 
   * Realiza las siguientes operaciones:
   * 1. Valida los datos requeridos
   * 2. Verifica si el usuario o teléfono ya existen
   * 3. Inserta o verifica los roles y estatus por defecto
   * 4. Inserta el nuevo usuario
   * 5. Registra la acción en la auditoría
   * 6. Inserta los datos personales
   */
  public function insert(array $request): int
  {
    try {
      // Validar datos requeridos
      if (
        empty($request['nombre_usuario']) || empty($request['clave_usuario']) || empty($request['telefono_usuario']) ||
        empty($request['nombre']) || empty($request['apellido']) || empty($request['cedula']) || empty($request['ubicacion']) ||
        empty($request['correo_usuario'])
      ) {
        return self::ERROR_INVALID_DATA;
      }

      // Verificar si el usuario ya existe
      if ($this->userExists($request['nombre_usuario'])) {
        return self::ERROR_USER_EXISTS;
      }

      // Verificar si el teléfono ya existe
      if ($this->phoneExists($request['telefono_usuario'])) {
        return self::ERROR_PHONE_EXISTS;
      }

      try {
        // 1. Insertar el rol
        $roleSql = "INSERT INTO usuarios_roles (usuario_rol) VALUES ('Usuario')";
        $roleId = $this->db->ejecutar($roleSql, []);

        // 2. Insertar el estado
        $statusSql = "INSERT INTO usuarios_estados (usuario_estado, descripcion_estado) 
                    VALUES ('Activo', 'Usuario activo en el sistema')";
        $statusId = $this->db->ejecutar($statusSql, []);

        // 3. Insertar el usuario
        $userSql = "INSERT INTO usuarios 
                  (nombre_usuario, clave_usuario, telefono_usuario, correo_usuario, id_estatus, id_rol) 
                  VALUES (:nombre_usuario, :clave_usuario, :telefono_usuario, :correo_usuario, :id_estatus, :id_rol)";

        $userId = $this->db->ejecutar($userSql, [
          ':nombre_usuario' => $request['nombre_usuario'],
          ':clave_usuario' => $request['clave_usuario'],
          ':telefono_usuario' => $request['telefono_usuario'],
          ':correo_usuario' => $request['correo_usuario'],
          ':id_estatus' => $statusId,
          ':id_rol' => $roleId
        ]);

        // 4. Insertar en usuarios_auditorias
        $auditSql = "INSERT INTO usuarios_auditorias 
                   (id_usuario, acciones_auditoria, fecha_auditoria, hora_auditoria) 
                   VALUES (:id_usuario, :accion, CURDATE(), CURTIME())";

        $this->db->ejecutar($auditSql, [
          ':id_usuario' => $userId,
          ':accion' => 'Registro de nuevo usuario'
        ]);

        // 5. Crear una entrada "compra" ficticia para poder relacionar los datos personales
        // Como los datos personales tienen un id_compra, necesitamos crear una compra
        $compraSql = "INSERT INTO compras_boletos (id_rifa, total, fecha, estado) 
                     VALUES (1, 0, CURDATE(), 'pendiente')";
        $compraId = $this->db->ejecutar($compraSql, []);

        // 6. Insertar datos personales
        $nombreCompleto = $request['nombre'] . ' ' . $request['apellido'];
        $personalDataSql = "INSERT INTO datos_personales 
                          (id_compra, nombre, cedula, telefono, ubicacion) 
                          VALUES (:id_compra, :nombre, :cedula, :telefono, :ubicacion)";

        $this->db->ejecutar($personalDataSql, [
          ':id_compra' => $compraId,
          ':nombre' => $nombreCompleto,
          ':cedula' => $request['cedula'],
          ':telefono' => $request['telefono_usuario'],
          ':ubicacion' => $request['ubicacion']
        ]);

        return self::REGISTRATION_SUCCESS;
      } catch (Exception $e) {
        throw $e;
      }
    } catch (Exception $e) {
      error_log("Error en RegisterUser::insert: " . $e->getMessage());
      return self::ERROR_DATABASE;
    }
  }

  /**
   * Obtiene el mensaje de estado correspondiente al código de resultado
   * @param int $status Código de estado de la operación
   * @return array Array con el mensaje y tipo de respuesta
   */
  public function getStatusMessage(int $status): array
  {
    switch ($status) {
      case self::REGISTRATION_SUCCESS:
        return [
          'success' => true,
          'message' => self::MESSAGE_REGISTRATION_SUCCESS,
          'type' => 'success'
        ];
      case self::ERROR_USER_EXISTS:
        return [
          'success' => false,
          'message' => self::MESSAGE_USER_EXISTS,
          'type' => 'error'
        ];
      case self::ERROR_PHONE_EXISTS:
        return [
          'success' => false,
          'message' => self::MESSAGE_PHONE_EXISTS,
          'type' => 'error'
        ];
      case self::ERROR_INVALID_DATA:
        return [
          'success' => false,
          'message' => self::MESSAGE_INVALID_DATA,
          'type' => 'error'
        ];
      default:
        return [
          'success' => false,
          'message' => self::MESSAGE_DATABASE_ERROR,
          'type' => 'error'
        ];
    }
  }

  private function userExists(string $username): bool
  {
    $result = $this->db->consultar(
      "SELECT COUNT(*) as count FROM " . self::TABLE_NAME . " 
       WHERE " . self::COLUMN_NAME . " = :nombre_usuario",
      [':nombre_usuario' => $username]
    );

    return $result && $result[0]['count'] > 0;
  }

  private function phoneExists(string $telefono_usuario): bool
  {
    $result = $this->db->consultar(
      "SELECT COUNT(*) as count FROM " . self::TABLE_NAME . " 
       WHERE " . self::COLUMN_PHONE . " = :telefono_usuario",
      [':telefono_usuario' => $telefono_usuario]
    );

    return $result && $result[0]['count'] > 0;
  }
}
