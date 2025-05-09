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

// print_r($_SESSION);

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

if ($request_method === 'GET' && strpos($route, '/confirmarBoleto/') === 0) {
    $id = intval(substr($route, strlen('/confirmarBoleto/')));
    (new BoletoController())->confirmarPago($id);
    exit;
}



















if ($request_method === 'POST' && $route === '/crear_sorteo') {
    (new ConfigMainController())->index();
    exit;
}



























if ($request_method === 'GET' && $route === '/main_config') {
    (new ConfigMainController())->index();
    exit;
}




























/* if ($request_method === 'GET' && $route === '/cuentas_pago/listar') { */
/*     (new ConfigMainController())->listar(); */
/*     exit; */
/* } */
/* if ($request_method === 'POST' && $route === '/cuentas_pago/guardar') { */
/*     (new ConfigMainController())->guardar(); */
/*     exit; */
/* } */
/* if ($request_method === 'POST' && $route === '/cuentas_pago/eliminar') { */
/*     (new ConfigMainController())->eliminar(); */
/*     exit; */
/* } */

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

// print_r($_SESSION);

switch (strtok($route, '?')) {
    case '/':
        require_once 'views/main.php';
        break;

    case '/login':
        if (!isset($_SESSION['usuario'])) {
            require_once 'views/auth/login.php';
        } else {
            header("Location: /TuRifadigi/sorteo");
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

    case '/compras':
        if (!isset($_SESSION['usuario'])) {
            header("Location: /TuRifadigi/login");
            exit;
        }
        require_once 'views/compras/index.php';
        break;

    case '/main_config':
        (new ConfigMainController())->index();
        break;

    //SECCION DE ADMINISTRADOR
    case '/admin_compra_verificacion':
        if (!isset($_SESSION['usuario'])) {
            header("Location: /TuRifadigi/login");
            exit;
        }
        require_once 'views/admin/compra.index.php';
        break;
    case '/admin_rifa_config':
        if (!isset($_SESSION['usuario'])) {
            header("Location: /TuRifadigi/login");
            exit;
        }
        require_once 'views/admin/rifa_config.php';
        break;
    case '/crear_sorteo':
        if (!isset($_SESSION['usuario'])) {
            header("Location: /TuRifadigi/login");
            exit;
        }
        (new ConfigMainController())->index();
        break;

    //SECCION PANTALLAS DE SWEET ALERT
    case '/compras/view/accions_view':
        require_once 'views/compras/view/vistaAcciones.php';
        break;

    case '/admin/view/compra/accions_view':
        require_once 'views/admin/views/compra/vistaAcciones.php';
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
    case '/api/get_purchase':
        require_once 'src/API/obtenerCompras.php';
        break;

    default:
        require_once 'views/main.php';
        break;
}
