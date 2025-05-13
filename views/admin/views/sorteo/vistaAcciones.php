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

$id_configuracion = $data["id_configuracion"] ?? '';
$id_usuario = $data["id_usuario"] ?? '';
$titulo = $data["titulo"] ?? '';
$fecha_inicio = $data["fecha_inicio"] ?? '';
$fecha_final = $data["fecha_final"] ?? '';
$precio_boleto = $data["precio_boleto"] ?? '';
$boletos_minimos = $data["boletos_minimos"] ?? '';
$boletos_maximos = $data["boletos_maximos"] ?? '';
$numero_contacto = $data["numero_contacto"] ?? '';
$url_rifa = $data["url_rifa"] ?? '';
$texto_ejemplo = $data["texto_ejemplo"] ?? '';
$estado = $data["estado"] ?? '';

?>
<div class="form-section">
  <h4 class="form-section-title">
    <i class="fas fa-ticket-alt"></i>
    INFORMACIÓN DE LA RIFA
  </h4>
  <div class="form-group-custom">
    <label>ID Configuración</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($id_configuracion); ?>">
  </div>
  <div class="form-group-custom">
    <label>ID Usuario</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($id_usuario); ?>">
  </div>
  <div class="form-group-custom">
    <label>Título</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($titulo); ?>">
  </div>
  <div class="form-group-custom">
    <label>Fecha de inicio</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($fecha_inicio); ?>">
  </div>
  <div class="form-group-custom">
    <label>Fecha final</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($fecha_final); ?>">
  </div>
  <div class="form-group-custom">
    <label>Precio por boleto</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($precio_boleto); ?> $">
  </div>
  <div class="form-group-custom">
    <label>Boletos mínimos</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($boletos_minimos); ?>">
  </div>
  <div class="form-group-custom">
    <label>Boletos máximos</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($boletos_maximos); ?>">
  </div>
  <div class="form-group-custom">
    <label>Número de contacto</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($numero_contacto); ?>">
  </div>
  <div class="form-group-custom">
    <label>URL de la rifa</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($url_rifa); ?>">
  </div>
  <div class="form-group-custom">
    <label>Texto ejemplo</label>
    <textarea class="form-control-custom" disabled><?php echo htmlspecialchars($texto_ejemplo); ?></textarea>
  </div>
  <div class="form-group-custom">
    <label>Estado</label>
    <input type="text" class="form-control-custom" disabled value="<?php echo htmlspecialchars($estado); ?>">
  </div>
</div>
<link rel="stylesheet" href="/assets/css/datos_personales.css">
<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>