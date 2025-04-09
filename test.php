<?php
require_once 'config/config.php';

echo "<h1>Prueba de Configuración</h1>";

// Verificar variables de entorno
echo "<h2>Variables de Entorno:</h2>";
echo "<pre>";
echo "APP_NAME: " . config('app.name') . "\n";
echo "APP_ENV: " . config('app.env') . "\n";
echo "APP_DEBUG: " . (config('app.debug') ? 'true' : 'false') . "\n";
echo "APP_URL: " . config('app.url') . "\n";
echo "</pre>";

// Verificar conexión a base de datos
echo "<h2>Configuración de Base de Datos:</h2>";
echo "<pre>";
echo "DB_CONNECTION: " . config('database.connection') . "\n";
echo "DB_HOST: " . config('database.host') . "\n";
echo "DB_DATABASE: " . config('database.database') . "\n";
echo "</pre>";

// Verificar autoloader
echo "<h2>Autoloader:</h2>";
if (class_exists('Dotenv\Dotenv')) {
  echo "✓ Dotenv cargado correctamente\n";
} else {
  echo "✗ Error: Dotenv no está cargado\n";
}

// Verificar errores
echo "<h2>Configuración de Errores:</h2>";
echo "<pre>";
echo "error_reporting: " . error_reporting() . "\n";
echo "display_errors: " . ini_get('display_errors') . "\n";
echo "</pre>";
