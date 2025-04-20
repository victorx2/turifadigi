<?php
require_once 'BaseController.php';

class HomeController extends BaseController
{
  public function index()
  {
    echo "<h1>Bienvenido al Sistema de Lotería</h1>";
    echo "<p>Esta es la página principal.</p>";
    echo "<p>El enrutamiento está funcionando correctamente.</p>";
  }

  public function test()
  {
    echo "<h1>Página de Prueba</h1>";
    echo "<p>Esta es una página de prueba para verificar el enrutamiento.</p>";
  }

  public function testPost()
  {
    echo "<h1>Método POST Recibido</h1>";
    echo "<p>Datos recibidos:</p>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
  }
}
