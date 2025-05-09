<?php require_once 'views/layouts/header.php'; ?>

<div class="container py-5">
  <div class="row">
    <div class="col-12">
      <div class="card" style="margin-top: 120px;">
        <div class="card-header">
          <h3 class="card-title">Configuración del Sorteo</h3>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
              <?php echo $_SESSION['success'];
              unset($_SESSION['success']); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['error'];
              unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>

          <form id="form-config" action="/TuRifadigi/rifa_config" method="POST">
            <div class="mb-3">
              <label for="titulo" class="form-label">Título del Sorteo</label>
              <input type="text" class="form-control" id="titulo" name="titulo"
                value="<?php echo htmlspecialchars($config['titulo'] ?? '🎉 ¡POR EL SUPERGANA! 🎉'); ?>" required>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                  <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                    value="<?php echo htmlspecialchars($config['fecha_inicio'] ?? ''); ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="fecha_final" class="form-label">Fecha de Fin</label>
                  <input type="date" class="form-control" id="fecha_final" name="fecha_final"
                    value="<?php echo htmlspecialchars($config['fecha_final'] ?? ''); ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="precio_boleto" class="form-label">Precio del Boleto ($)</label>
                  <input type="number" step="0.01" class="form-control" id="precio_boleto" name="precio_boleto"
                    value="<?php echo htmlspecialchars($config['precio_boleto'] ?? '3'); ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="boletos_minimos" class="form-label">Compra Mínima de Boletos</label>
                  <input type="number" class="form-control" id="boletos_minimos" name="boletos_minimos"
                    value="<?php echo htmlspecialchars($config['boletos_minimos'] ?? '2'); ?>" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="boletos_maximos" class="form-label">Compra Máxima de Boletos</label>
                  <input type="number" class="form-control" id="boletos_maximos" name="boletos_maximos"
                    value="<?php echo htmlspecialchars($config['boletos_maximos'] ?? '500'); ?>" required>
                </div>
              </div>
            </div>

            <!-- Premios -->
            <h4 class="mt-4 mb-3">Premios</h4>
            <div id="premios-container">
              <?php
              $premios = $config['premios'] ?? [
                ['nombre' => '🛵 Premio Mayor', 'descripcion' => "Si estás en Estados Unidos, ganas una moto\nSi estás en otro país, ganas el valor de la moto al cambio de la moneda local desde donde participes"],
                ['nombre' => '📱 Segundo Premio', 'descripcion' => "Un iPhone 16 Pro Max\nDisponible para cualquier país participante"],
                ['nombre' => '💵 Tercer Premio', 'descripcion' => "$1000 en efectivo\nPara participar debes comprar 10 boletos o más\nEste premio se activa con el 50% de los boletos vendidos"]
              ];
              foreach ($premios as $index => $premio): ?>
                <div class="card mb-3 premio-item">
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label">Nombre del Premio</label>
                      <input type="text" class="form-control" name="premios[<?php echo $index; ?>][nombre]"
                        value="<?php echo htmlspecialchars($premio['nombre']); ?>" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Descripción del Premio</label>
                      <textarea class="form-control" name="premios[<?php echo $index; ?>][descripcion]" rows="3" required><?php echo htmlspecialchars($premio['descripcion']); ?></textarea>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Información de contacto y enlaces -->
            <div class="mb-3">
              <label for="numero_contacto" class="form-label">Número de Contacto</label>
              <input type="text" class="form-control" id="numero_contacto" name="numero_contacto"
                value="<?php echo htmlspecialchars($config['numero_contacto'] ?? '407-428-7580'); ?>" required>
            </div>

            <div class="mb-3">
              <label for="url_rifa" class="form-label">URL de la Lotería</label>
              <input type="url" class="form-control" id="url_rifa" name="url_rifa"
                value="<?php echo htmlspecialchars($config['url_rifa'] ?? 'https://tripletachira.com/'); ?>" required>
            </div>

            <div class="mb-3">
              <label for="texto_ejemplo" class="form-label">Texto de Ejemplo</label>
              <textarea class="form-control" id="texto_ejemplo" name="texto_ejemplo" rows="3" required><?php echo htmlspecialchars($config['texto_ejemplo'] ?? 'Si compras 10 boletos, participas automáticamente en el sorteo de $1000 cuando se alcance el 50% de los números vendidos. El día se anunciará públicamente.'); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header d-flex align-items-center">
      <i class="fas fa-info-circle me-2"></i>
      <strong class="me-auto" id="toastTitle"></strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastMessage"></div>
  </div>
</div>

<script>
  // Manejo del formulario
  document.getElementById('form-config').addEventListener('submit', function(event) {
    event.preventDefault();

    // Deshabilitar el botón de submit para evitar doble envío
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    // Si pasa todas las validaciones, prepara los datos para enviar
    let formData = new FormData(this);

    // Envía los datos al servidor usando fetch
    fetch('/TuRifadigi/rifa_config', {
        method: 'POST',
        body: new URLSearchParams(formData)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showToast(data.type, 'Éxito', data.message);
          setTimeout(() => {
            window.location.reload();
          }, 3000);
        } else {
          showToast(data.type, 'Error', data.message);
          submitButton.disabled = false;
        }
      })
      .catch(error => {
        showToast('error', 'Error', 'Hubo un error al procesar la solicitud');
        submitButton.disabled = false;
      });
  });

  // Función showToast
  function showToast(type, title, message) {
    const toast = document.getElementById('notificationToast');
    const toastTitle = document.getElementById('toastTitle');
    const toastMessage = document.getElementById('toastMessage');
    const toastInstance = new bootstrap.Toast(toast, {
      autohide: true,
      delay: 5000
    });

    let icon = '';
    let headerClass = '';
    switch (type) {
      case 'success':
        icon = '<i class="fas fa-check-circle text-white me-2"></i>';
        headerClass = 'bg-success text-white';
        break;
      case 'error':
        icon = '<i class="fas fa-exclamation-circle text-white me-2"></i>';
        headerClass = 'bg-danger text-white';
        break;
      case 'warning':
        icon = '<i class="fas fa-exclamation-triangle text-white me-2"></i>';
        headerClass = 'bg-warning text-white';
        break;
      default:
        icon = '<i class="fas fa-info-circle text-white me-2"></i>';
        headerClass = 'bg-info text-white';
    }

    toastTitle.innerHTML = icon + title;
    const header = toast.querySelector('.toast-header');
    header.className = `toast-header ${headerClass}`;
    toastMessage.textContent = message;

    toastInstance.show();
  }
</script>

<?php require_once 'views/layouts/footer.php'; ?>