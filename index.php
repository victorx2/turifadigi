<?php
// Carga las dependencias necesarias usando Composer
require_once __DIR__ . '/vendor/autoload.php';

// Importa las clases necesarias
use Dotenv\Dotenv; // Para manejar variables de entorno
use App\Controllers\{AuthController, RegisterUserController, HomeController, BoletoController, ConfigMainController}; // Controladores principales

// Inicia la sesión para manejar la autenticación del usuario
@session_start();

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

if ($request_method === 'POST' && $route === '/login') {
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
    (new RegisterUserController())->insert($_POST);
    exit;
}

if ($request_method === 'GET' && strpos($route, '/confirmarBoleto/') === 0) {
    $id = intval(substr($route, strlen('/confirmarBoleto/')));
    (new BoletoController())->confirmarPago($id);
    exit;
}

if ($request_method === 'GET' && $route === '/main_config') {
    (new ConfigMainController())->index();
    exit;
}

if ($request_method === 'POST' && $route === '/banner_update') {
    (new ConfigMainController())->actualizarBanner();
    exit;
}

switch (strtok($route, '?')) {
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

    //SECCIONES API
    case '/api/login':
        require_once 'src/API/login.php';
        break;

    case '/api/recovery_password':
        require_once 'src/API/passwordRecovery.php';
        break;
    case '/api/session_verfication':
        require_once 'src/API/sessionVerify.php';
        break;

    case '/api/get_tickets':
        require_once 'src/API/boletosDisponibility.php';
        break;

    case '/api/process_purchase':
        require_once 'src/API/procesarCompra.php';
        break;
    case '/api/session_destroy':
        require_once 'src/API/destruirSesion.php';
        break;

    default:
        require_once 'views/main.php';
        break;
}
