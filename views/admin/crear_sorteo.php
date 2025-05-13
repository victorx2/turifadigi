<?php
require_once 'views/layouts/header.php';
?>
<!-- Agregar CSS de Toastify -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<!-- Agregar CSS personalizado -->
<link rel="stylesheet" type="text/css" href="assets/css/ToastPersonalizado.css">
<!-- Agregar Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<section class="contact-two">
  <div class="container">
    <div class="section-title text-center">
      <div class="section-title__tagline-box">
        <div class="section-title__tagline-shape"></div>
        <span class="section-title__tagline"></span>
      </div>
      <h2 class="section-title__title">Configuración del Sorteo</h2>
    </div>
    <div class="row">
      <div class="col-xl-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Crear Nuevo Sorteo</h3>
          </div>
          <div class="card-body">
            <form id="form-config" class="contact-two__form" enctype="multipart/form-data">
              <div class="form-group mb-3">
                <label for="imagen" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-image icon-signup"></i> Banner del Sorteo
                </label>
                <input type="file" class="form-control input-hover-signup" id="imagen" name="imagen" accept=".jpg,.jpeg,.png">
                <small class="form-text text-muted">(Opcional, PNG o JPG, máximo 5MB)</small>
              </div>

              <div class="mb-3">
                <label for="titulo" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-card-heading icon-signup"></i> Título del Sorteo *
                </label>
                <input type="text" class="form-control input-hover-signup" id="titulo" name="titulo" value="🎉 ¡POR EL SUPERGANA! 🎉" required>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="fecha_inicio" class="form-label" style="font-weight: bold;">
                      <i class="bi bi-calendar-event icon-signup"></i> Fecha de Inicio *
                    </label>
                    <input type="date" class="form-control input-hover-signup" id="fecha_inicio" name="fecha_inicio" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="fecha_final" class="form-label" style="font-weight: bold;">
                      <i class="bi bi-calendar-x icon-signup"></i> Fecha de Fin *
                    </label>
                    <input type="date" class="form-control input-hover-signup" id="fecha_final" name="fecha_final" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <label for="precio_boleto" class="form-label" style="font-weight: bold;">
                      <i class="bi bi-currency-dollar icon-signup"></i> Precio del Boleto ($) *
                    </label>
                    <input type="number" step="0.01" class="form-control input-hover-signup" id="precio_boleto" name="precio_boleto" value="3" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="boletos_minimos" class="form-label" style="font-weight: bold;">
                      <i class="bi bi-ticket-perforated icon-signup"></i> Compra Mínima de Boletos *
                    </label>
                    <input type="number" class="form-control input-hover-signup" id="boletos_minimos" name="boletos_minimos" value="2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="boletos_maximos" class="form-label" style="font-weight: bold;">
                      <i class="bi bi-ticket-detailed icon-signup"></i> Compra Máxima de Boletos *
                    </label>
                    <input type="number" class="form-control input-hover-signup" id="boletos_maximos" name="boletos_maximos" value="500" required>
                  </div>
                </div>
              </div>

              <h4 class="mt-4 mb-3" style="font-weight: bold;">
                <i class="bi bi-gift icon-signup"></i> Premios
              </h4>
              <div id="premios-container">
                <div class="card mb-3 premio-item">
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label" style="font-weight: bold;">
                        <i class="bi bi-trophy icon-signup"></i> Nombre del Premio *
                      </label>
                      <input type="text" class="form-control input-hover-signup" name="premios[0][nombre]" value="🛵 Premio Mayor" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" style="font-weight: bold;">
                        <i class="bi bi-card-text icon-signup"></i> Descripción del Premio *
                      </label>
                      <textarea class="form-control input-hover-signup" name="premios[0][descripcion]" rows="3" required>Si estás en Estados Unidos, ganas una moto
Si estás en otro país, ganas el valor de la moto al cambio de la moneda local desde donde participes</textarea>
                    </div>
                  </div>
                </div>

                <div class="card mb-3 premio-item">
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label" style="font-weight: bold;">
                        <i class="bi bi-trophy icon-signup"></i> Nombre del Premio *
                      </label>
                      <input type="text" class="form-control input-hover-signup" name="premios[1][nombre]" value="📱 Segundo Premio" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" style="font-weight: bold;">
                        <i class="bi bi-card-text icon-signup"></i> Descripción del Premio *
                      </label>
                      <textarea class="form-control input-hover-signup" name="premios[1][descripcion]" rows="3" required>Un iPhone 16 Pro Max
Disponible para cualquier país participante</textarea>
                    </div>
                  </div>
                </div>

                <div class="card mb-3 premio-item">
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label" style="font-weight: bold;">
                        <i class="bi bi-trophy icon-signup"></i> Nombre del Premio *
                      </label>
                      <input type="text" class="form-control input-hover-signup" name="premios[2][nombre]" value="💵 Tercer Premio" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" style="font-weight: bold;">
                        <i class="bi bi-card-text icon-signup"></i> Descripción del Premio *
                      </label>
                      <textarea class="form-control input-hover-signup" name="premios[2][descripcion]" rows="3" required>$1000 en efectivo
Para participar debes comprar 10 boletos o más
Este premio se activa con el 50% de los boletos vendidos</textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="numero_contacto" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-telephone-fill icon-signup"></i> Número de Contacto *
                </label>
                <input type="text" class="form-control input-hover-signup" id="numero_contacto" name="numero_contacto" value="407-428-7580" required>
              </div>

              <div class="mb-3">
                <label for="url_rifa" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-link-45deg icon-signup"></i> URL de la Lotería *
                </label>
                <input type="url" class="form-control input-hover-signup" id="url_rifa" name="url_rifa" value="https://tripletachira.com/" required>
              </div>

              <div class="mb-3">
                <label for="texto_ejemplo" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-chat-left-text icon-signup"></i> Texto de Ejemplo *
                </label>
                <textarea class="form-control input-hover-signup" id="texto_ejemplo" name="texto_ejemplo" rows="3" required>Si compras 10 boletos, participas automáticamente en el sorteo de $1000 cuando se alcance el 50% de los números vendidos. El día se anunciará públicamente.</textarea>
              </div>

              <button type="submit" class="btn btn-primary">Crear Sorteo</button>
            </form>

          </div>
        </div>
      </div>
    </div>

    <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto" id="toastTitle"></strong>
        <small class="text-muted" id="toastTime"></small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body" id="toastMessage"></div>
    </div>

  </div>

</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-config');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.onsubmit = function(e) {
      e.preventDefault();

      // Deshabilitar el botón
      submitBtn.disabled = true;
      submitBtn.textContent = 'Creando sorteo...';

      const formData = new FormData(form);

      fetch('/crear_sorteo', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showToast('success', 'Éxito', data.message || 'Sorteo creado exitosamente');
          } else {
            showToast('error', 'Error', data.error || 'Error al crear el sorteo');
          }
        })
        .catch(error => {
          showToast('error', 'Error', 'Ocurrió un error al procesar la solicitud');
          console.error(error);
        })
        .finally(() => {
          // Habilitar el botón nuevamente
          submitBtn.disabled = false;
          submitBtn.textContent = 'Crear Sorteo';
        });
    };

    // Función para mostrar notificaciones
    function showToast(type, title, message) {
      const toast = document.getElementById('notificationToast');
      const toastTitle = document.getElementById('toastTitle');
      const toastMessage = document.getElementById('toastMessage');

      if (!toast || !toastTitle || !toastMessage) {
        alert(message); // Fallback si no existe el toast
        return;
      }

      toastTitle.textContent = title;
      toastMessage.textContent = message;

      new bootstrap.Toast(toast).show();
    }
  });
</script>

<?php
require_once 'views/layouts/footer.php';
?>