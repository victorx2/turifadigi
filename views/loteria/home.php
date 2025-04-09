<?php
// Verificar si se está intentando acceder a la ruta de login
$current_uri = $_SERVER['REQUEST_URI'];
$login_path = '/TuRifadigi/login';

if (strpos($current_uri, $login_path) !== false) {
  // Si la ruta es de login, redirigir a la página de login
  header("Location: " . $login_path);
  exit();
} else {
  // Si no es ruta de login, mostrar la vista normal de lotería
  require_once 'views/layouts/header.php';
  require_once 'views/layouts/main.php';
  require_once 'views/layouts/footer.php';
}
