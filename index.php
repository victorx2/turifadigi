<?php
// Carga las dependencias necesarias usando Composer
require_once __DIR__ . '/vendor/autoload.php';

// Importa las clases necesarias
use Dotenv\Dotenv; // Para manejar variables de entorno
use App\Controllers\{AuthController, RegisterUserController, HomeController, RaffleConfigController, BoletoController, ConfigMainController}; // Controladores principales
//use App\Controllers\BoletoController;

// Inicia la sesión para manejar la autenticación del usuario
session_start();

// Configuración de zona horaria y localización
date_default_timezone_set('America/Caracas');
setlocale(LC_TIME, 'Spanish');

// Carga las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__)->load();

// Configuración de cookies para mayor seguridad
$cookie_duration = 30 * 24 * 60 * 60; // Duración de 30 días
$cookie_config = [
    'expires' => time() + $cookie_duration,
    'path' => '/',
    'domain' => $_ENV['APP_DOMAIN'] ?? '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
];

// Procesamiento de la solicitud HTTP
$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

// Normalización de la ruta
$base_path = "/TuRifadigi";
$route = str_replace($base_path, '', $request_uri);

if ($request_method === 'POST' && $route === '/verificarDisponibilidad') {
    (new BoletoController())->verificarDisponibilidad();
}

if ($request_method === 'POST' && $route === '/procesarCompra') {
    (new BoletoController())->procesarCompra();
}

if ($request_method === 'GET' && strpos($route, '/boletos/obtenerBoletosPaginados') === 0) {
    header('Content-Type: application/json');
    try {
        $controller = new BoletoController();
        $controller->obtenerBoletosPaginados();
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

// if ($request_method === 'GET' && $route === '/inicializarBoletos') {
//     (new BoletoController())->inicializarBoletos();
// }

// Manejo de solicitudes POST
//if ($request_method === 'POST') {
//    if ($route === '/login') {
//        $authController = (new AuthController())->login($_REQUEST['user'], $_REQUEST['password']);
//        if (!$authController) {
//            $error = true;
//            require_once 'views/auth/login.php';
//        }
//        exit;
//    }
//
//    if ($route === '/guardarComprador') {
//        (new BoletoController())->procesarCompra();
//        exit;
//    }
//}

// if ($request_method === 'POST' && $route === '/procesarCompra') {
//     (new BoletoController())->show();
// }

if ($request_method === 'POST' && $route === '/login') {
    (new AuthController())->login($_REQUEST['usuario'], $_REQUEST['password']);
    exit;
}

if ($request_method === 'POST' && $route === '/recuperar_password') {
    (new AuthController())->recuperarPassword(['correo' => $_REQUEST['correo']]);
    exit;
}

if ($request_method === 'POST' && $route === '/reset_password') {
    (new AuthController())->resetPassword([
        'token' => $_REQUEST['token'],
        'password' => $_REQUEST['password']
    ]);
    exit;
}

if ($request_method === 'GET' && $route === '/reset-password') {
    if (!isset($_GET['token'])) {
        header('Location: /TuRifadigi/login');
        exit;
    }
    require_once 'views/auth/reset-password.php';
    exit;
}

if ($request_method === 'POST' && $route === '/registro_usuario') {
    (new RegisterUserController())->insert();
    exit;
}

if ($request_method === 'GET' && strpos($route, '/confirmarBoleto/') === 0) {
    $id = intval(substr($route, strlen('/confirmarBoleto/')));
    (new BoletoController())->confirmarPago($id);
    exit;
}

if ($request_method === 'GET' && strpos($route, '/confirmarBoleto/') === 0) {
    $id = intval(substr($route, strlen('/confirmarBoleto/')));
    (new BoletoController())->confirmarPago($id);
    exit;
}

if ($request_method === 'GET' && $route === '/cuentas_pago/listar') {
    (new ConfigMainController())->listar();
    exit;
}
if ($request_method === 'POST' && $route === '/cuentas_pago/guardar') {
    (new ConfigMainController())->guardar();
    exit;
}
if ($request_method === 'POST' && $route === '/cuentas_pago/eliminar') {
    (new ConfigMainController())->eliminar();
    exit;
}

/* if ($request_method === 'GET' && $route === '/main_config') { */
/*     (new ConfigMainController())->index(); */
/*     exit; */
/* } */

//if ($request_method === 'GET' && strpos($route, '/confirmarBoleto/') === 0) {
//    $id = intval(substr($route, strlen('/confirmarBoleto/')));
//    (new BoletoController())->verificarDisponibilidad($id);
//    exit;
//}

// Validación de sesión
//if (empty($_SESSION)) {
//    require_once 'views/auth/login.php';
//    exit;

//} else if ((isset($_SESSION['usuario']) && $route === '/login') || (isset($_SESSION['usuario']) && $route === '/')) {
//    (new HomeController())->index();
//    exit;
//}

// Enrutamiento principal de la aplicación

switch ($route) {
    case '/':
        require_once 'views/main.php';
        break;

    case '/login':
        if (!isset($_SESSION['usuario'])) {
            require_once 'views/auth/login.php';
        } else {
            header("Location: /TuRifadigi/home");
            exit;
        }
        break;

    case '/home':
        if (isset($_SESSION['usuario'])) {
            (new HomeController())->index();
        } else {
            header("Location: /TuRifadigi/login");
            exit;
        }
        break;

    case '/signup':
        if (!isset($_SESSION['usuario'])) {
            require_once 'views/auth/signup.php';
        } else {
            (new HomeController())->index();
        }
        break;

    case '/forgot-password':
        require_once 'views/auth/forgot-password.php';
        break;

    case '/boletos/obtenerBoletos':
        require_once 'views/sorteo/boletosDisponibility.php';
        break;

    case '/procesarCompra':
        break;

    case '/sorteo':
        (new BoletoController())->index();
        break;

    case '/rifa_config':
        require_once 'views/admin/rifa_config.php';
        break;

    case '/boletos':
        (new BoletoController())->indexAdmin();
        break;

    case '/main_config':
        (new ConfigMainController())->index();
        break;

    default:
        require_once 'views/main.php';
        break;
}
