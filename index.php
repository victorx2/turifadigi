<?php
// Carga las dependencias necesarias usando Composer
require_once 'vendor/autoload.php';

// Importa las clases necesarias
use Dotenv\Dotenv; // Para manejar variables de entorno
use App\Controllers\{AuthController, RegisterUserController, HomeController}; // Controladores principales

// Inicia la sesión para manejar la autenticación del usuario
session_start();

// Sección de configuraciones comentadas que podrían ser útiles en el futuro:
// - Soporte multi-idioma
// - Configuración de caché HTTP
// - Protección contra ataques (CSP, X-Content-Type, X-Frame)
// - Mejoras en el sistema de logging
// - Forzar conexiones HTTPS

// Verificación del estado de la sesión
if (session_status() === PHP_SESSION_ACTIVE) {
    // Si la sesión está activa, se obtiene información sobre la misma
    $session_path = session_save_path(); // Ruta de almacenamiento de sesiones
    $session_name = session_name(); // Nombre de la sesión
    $session_id = session_id(); // ID único de la sesión
    $session_options = session_get_cookie_params(); // Configuración de la cookie de sesión
    $session_status = session_status(); // Estado actual de la sesión
} else {
    // Mensaje de error si la sesión no se inició correctamente
    echo "<pre>La sesión no se ha iniciado correctamente.</pre>";
}

// Carga las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__)->load();

// Configuración de cookies para mayor seguridad
$cookie_duration = 30 * 24 * 60 * 60; // Duración de 30 días
$cookie_config = [
    'expires' => time() + $cookie_duration, // Fecha de expiración
    'path' => '/', // Ruta válida
    'domain' => $_ENV['APP_DOMAIN'] ?? '', // Dominio de la aplicación
    'secure' => true, // Solo HTTPS
    'httponly' => true, // No accesible desde JavaScript
    'samesite' => 'Strict' // Prevención de ataques CSRF
];

// Procesamiento de la solicitud HTTP
$request_method = $_SERVER['REQUEST_METHOD']; // Método HTTP (GET, POST, etc.)
$request_uri = $_SERVER['REQUEST_URI']; // URI solicitada

// Normalización de la ruta
$base_path = "/TuRifadigi"; // Ruta base de la aplicación
$route = str_replace($base_path, '', $request_uri); // Elimina la ruta base

// Debug de sesión (solo en entorno de desarrollo)
if ($_ENV['APP_ENV'] === 'development') {
    // Código de depuración comentado
}

// Manejo de solicitudes POST
if ($request_method === 'POST') {
    // Procesamiento de inicio de sesión
    if ($route === '/login') {
        $authController = (new AuthController())->login($_REQUEST['name'], $_REQUEST['password']);
        if (!$authController) {
            $error = true;
            require_once 'views/auth/login.php';
            exit;
        }
    }
    
    // Procesamiento de registro de usuario
    if ($route === '/registro_usuario') {
        (new RegisterUserController())->insert($_REQUEST);
        exit;
    }
}

// Enrutamiento principal de la aplicación
switch ($route) {
    case '/':
        // Página principal con la vista de lotería
        require_once 'views/loteria/home.php';
        break;


    case '/login':
         // Página de inicio de sesión
         if (!isset($_SESSION['logged_in'])) {
            require_once 'views/auth/login.php';
        } else {
            header("Location: /TuRifadigi/home");
            exit;
        }
        break;

          

        case '/home':
            // Página principal del usuario autenticado
            if (isset($_SESSION['logged_in'])) {
                (new HomeController())->index();
            } else {
                header("Location: /TuRifadigi/login");
                exit;
            }
            break;

    case '/register':
        // Página de registro (solo para usuarios no autenticados)
        if (!isset($_SESSION['nombre_usuario'])) {
            require_once 'views/auth/register.php';
        } else {
            (new HomeController())->index();
        }
        break;


    default:
        // Ruta por defecto (página de lotería)
        require_once 'views/loteria/home.php';
        break;
}
