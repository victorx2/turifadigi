<?php
require_once 'vendor/autoload.php'; // Carga automáticamente las clases necesarias

use Dotenv\Dotenv; // Importa la clase Dotenv para manejar variables de entorno
// use App\config\DatabaseBackup; // Comentado: posible uso de una clase para respaldos de base de datos
use App\Controllers\{AuthController, RegisterUserController, HomeController}; // Importa controladores necesarios

session_start(); // Inicializa la sesión para el manejo de usuarios



// Agregar soporte multi-idioma
// define('DEFAULT_TIMEZONE', 'America/New_York');
// define('DEFAULT_LOCALE', 'es_US');
// date_default_timezone_set(DEFAULT_TIMEZONE);
// setlocale(LC_ALL, DEFAULT_LOCALE);

// header('Cache-Control: public, max-age=31536000');
// header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000));

// Agregar protección contra ataques
// header('Content-Security-Policy: default-src \'self\'');
// header('X-Content-Type-Options: nosniff');
// header('X-Frame-Options: DENY');

// Mejorar el sistema de logging
// error_log(json_encode([
//   'timestamp' => date('Y-m-d H:i:s'),
//   'ip' => $_SERVER['REMOTE_ADDR'],
//   'user_agent' => $_SERVER['HTTP_USER_AGENT'],
//   'request' => $_SERVER['REQUEST_URI'],
//   'error' => $e->getMessage()
// ]));

// Forzar HTTPS
// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
//   header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//   exit();
// }


// Verifica si la sesión se ha iniciado correctamente
if (session_status() === PHP_SESSION_ACTIVE) {
  // Si la sesión está activa, obtiene información sobre la sesión
  $session_path = session_save_path(); // Ruta donde se guardan las sesiones
  $session_name = session_name(); // Nombre de la sesión
  $session_id = session_id(); // ID de la sesión
  $session_options = session_get_cookie_params(); // Parámetros de la cookie de sesión
  $session_status = session_status(); // Estado de la sesión

  // Código comentado para depuración
  // echo "<pre>";
  // echo "Ruta de sesiones: " . $session_path . "\n";
  // echo "Nombre de sesión: " . $session_name . "\n";
  // echo "ID de sesión: " . $session_id . "\n";
  // echo "Opciones de sesión:\n";
  // print_r($session_options);
  // echo "Estado de la sesión: " . $session_status . "\n";
  // echo "</pre>";
} else {
  // Si la sesión no está activa, muestra un mensaje de error
  echo "<pre>La sesión no se ha iniciado correctamente.</pre>";
}

// Carga las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__)->load();

// Configuración de cookies
$cookie_duration = 30 * 24 * 60 * 60; // Duración de la cookie: 30 días
$cookie_config = [
  'expires' => time() + $cookie_duration, // Fecha de expiración de la cookie
  'path' => '/', // Ruta donde la cookie es válida
  'domain' => $_ENV['APP_DOMAIN'] ?? '', // Dominio de la cookie
  'secure' => true, // Solo se envía a través de HTTPS
  'httponly' => true, // No accesible a través de JavaScript
  'samesite' => 'Strict' // Restricciones de envío de cookies
];

// Obtener la URL solicitada
$request_method = $_SERVER['REQUEST_METHOD']; // Método de la solicitud (GET, POST, etc.)
$request_uri = $_SERVER['REQUEST_URI']; // URI solicitada

// Limpiar la ruta base
$base_path = "/TuRifadigi"; // Ruta base de la aplicación
$route = str_replace($base_path, '', $request_uri); // Elimina la ruta base de la URI

// Debug de sesión (solo en desarrollo)
if ($_ENV['APP_ENV'] === 'development') {
  // Muestra la información de la sesión si está en modo desarrollo
  //echo "<pre>";
  //print_r($_SESSION);
  //echo "</pre>";
}

// Manejo de la solicitud de inicio de sesión POST
if ($request_method === 'POST' && $route === '/login') {
  $authController = (new AuthController())->login($_REQUEST['user'], $_REQUEST['password']);
  if (!$authController) {
    $error = true;
    require_once 'views/auth/login.php';
    exit;
  }
}

if ($request_method === 'POST' && $route === '/registro_usuario') {
  (new RegisterUserController())->insert($_REQUEST);
  exit;
}


// Manejo principal de rutas
switch ($route) {
  case '/':
    // Mostrar siempre la vista de lotería en la página principal
    require_once 'views/loteria/home.php';
    break;

  case '/login':
    // Redirigir a login si el usuario no está autenticado
    if (!isset($_SESSION['nombre_usuario'])) {
      require_once 'views/auth/login.php';
    } else {
      (new HomeController())->index();
    }
    break;

  case '/login2':
    // Redirigir a login2 si el usuario no está autenticado
    if (!isset($_SESSION['nombre_usuario'])) {
      require_once 'views/auth/login2.php';
    } else {
      (new HomeController())->index();
    }
    break;

  case '/logout':
    (new AuthController())->logout();
    break;

  case '/home':
    if (isset($_SESSION['nombre_usuario'])) {
      (new HomeController())->index();
    } else {
      header("Location: /TuRifadigi/login");
      exit;
    }
    break;

  default:
    // Si la ruta no coincide, mostrar la vista de lotería por defecto
    require_once 'views/loteria/home.php';
    break;
}
