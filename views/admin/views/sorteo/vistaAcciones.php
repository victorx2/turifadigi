<?php

use App\Controllers\SorteoController;

$idC = $_GET['acvi'] ?? null;

if (!isset($idC)) {
  echo '<div class="alerta danger">Error: ID de sorteo no obtenido.</div>';
  exit;
}

$id = intval($idC);
$controller = new SorteoController();

$response = $controller->obtenerSorteo($id);

$data = $response["data"][0];

if ($response["success"] == null) {
  echo '
  <div class="alerta danger">Error al obtener los datos del sorteo.</div>';
  exit;
}

$titulo = $data["titulo"] ?? '';
$fecha_creacion = $data["fecha_creacion"] ?? '';
$boletos_maximos = $data["configuracion"]["boletos_maximos"] ?? '';
$precio_boleto = $data["configuracion"]["precio_boleto"] ?? '';
$estado = $data["estado"] ?? '';

?>
<div class="form-section">
  <h4 class="form-section-title">
    <i class="fas fa-ticket-alt"></i>
    DETALLES DEL SORTEO
  </h4>
  
  <div class="form-group-custom">
    <label class="required">Título</label>
    <input type="text" class="form-control-custom" id="titulo" disabled value="<?php echo htmlspecialchars($titulo); ?>">
  </div>

  <div class="form-group-custom">
    <label class="required">Fecha de creación</label>
    <input type="text" class="form-control-custom" id="fecha_creacion" disabled value="<?php echo htmlspecialchars($fecha_creacion); ?>">
  </div>

  <div class="form-group-custom">
    <label class="required">Boletos máximos</label>
    <input type="text" class="form-control-custom" id="boletos_maximos" disabled value="<?php echo htmlspecialchars($boletos_maximos); ?>">
  </div>

  <div class="form-group-custom">
    <label class="required">Precio por boleto</label>
    <input type="text" class="form-control-custom" id="precio_boleto" disabled value="<?php echo htmlspecialchars($precio_boleto); ?> $">
  </div>

  <div class="form-group-custom">
    <label class="required">Estado</label>
    <input type="text" class="form-control-custom" id="estado" disabled value="<?php echo htmlspecialchars($estado); ?>">
  </div>

</div>
<link rel="stylesheet" href="/TuRifadigi/assets/css/datos_personales.css">
<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>