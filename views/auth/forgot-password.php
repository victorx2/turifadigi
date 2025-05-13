<?php require_once 'views/layouts/header.php'; ?>
<section class="contact-two">
  <div class="contact-two__img-1 wow fadeInLeft" data-wow-delay="300ms">
    <img src="assets/images/resources/contact-two-img-1.png" alt="" class="float-bob-x">
  </div>

  <div class="container">
    <div class="row">
      <div class="col-xl-8">
        <div class="contact-two__left">
          <div class="section-title text-left">
            <div class="section-title__tagline-box">
              <div class="section-title__tagline-shape">
                <img src="assets/images/shapes/section-title-tagline-shape.png" alt="">
              </div>
              <span class="section-title__tagline"></span>
            </div>
            <h2 class="section-title__title">Recuperar Contraseña</h2>
          </div>
          <form id="form-recuperacion" class="  contact-two__form" action="recuperar_password" method="post">
            <div class="row">
              <div class="col-xl-12">
                <div class="contact-two__input-box">
                  <input type="email"
                    name="correo"
                    id="correo"
                    placeholder="Correo electrónico"
                    title="El correo electrónico es requerido"
                    required>
                </div>
              </div>
              <div class="col-xl-12 text-center">
                <div class="contact-two__btn-box">
                  <button type="submit" class="thm-btn contact-two__btn">Recuperar Contraseña</button>
                </div>
              </div>
            </div>
          </form>

          <div class="result"></div>

          <p class="contact-two__left-text" style="margin-top: 20px;">¿Recordaste tu contraseña? &nbsp;&nbsp;&nbsp;<a href="/login">Inicia sesión</a></p>

          <!-- Toast ubicado debajo del formulario -->
          <div class="toast-container mt-3 mx-auto" style="width: 100%; max-width: 600px;">
            <div id="notificationToast" class="toast w-100" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header d-flex align-items-center">
                <i class="fas fa-info-circle me-2"></i>
                <strong class="me-auto text-truncate" id="toastTitle"></strong>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body" id="toastMessage">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  let correo = document.getElementById('correo');

  // Validación para correo electrónico
  correo.addEventListener('input', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo correo electrónico se encuentra vacío');
      this.style.border = "2px solid red";
      this.focus();
    } else if (!emailRegex.test(this.value.trim())) {
      showToast('warning', 'Formato inválido', 'El formato del correo electrónico no es válido');
      this.style.border = "2px solid red";
      this.focus();
    } else {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Manejo del envío del formulario
  document.getElementById('form-recuperacion').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío normal del formulario

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (correo.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo correo electrónico se encuentra vacío');
      correo.style.border = "2px solid red";
      correo.focus();
      return;
    } else if (!emailRegex.test(correo.value.trim())) {
      showToast('warning', 'Formato inválido', 'El formato del correo electrónico no es válido');
      correo.style.border = "2px solid red";
      correo.focus();
      return;
    }

    // Si pasa las validaciones, prepara los datos para enviar
    let formData = new FormData(this);

    // Envía los datos al servidor usando fetch
    fetch('/recovery_password', {
        method: 'POST',
        body: new URLSearchParams(formData)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showToast(data.type, 'Éxito', data.message);
          // setTimeout(() => {
          //   window.location.href = '/login'; // Redirige después de 3 segundos
          // }, 6000);
        } else {
          showToast(data.type, 'Error', data.message);
        }
      })
      .catch(error => {
        showToast('error', 'Error', 'Hubo un error al procesar la solicitud');
      });
  });

  // Función para mostrar notificaciones tipo toast
  function showToast(type, title, message) {
    const toast = document.getElementById('notificationToast');
    const toastTitle = document.getElementById('toastTitle');
    const toastMessage = document.getElementById('toastMessage');
    const toastInstance = new bootstrap.Toast(toast, {
      autohide: true,
      delay: 5000 // El toast se oculta automáticamente después de 5 segundos
    });

    // Configura el icono y color según el tipo de notificación
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

    // Actualiza el contenido del toast
    toastTitle.innerHTML = icon + title;
    const header = toast.querySelector('.toast-header');
    header.className = `toast-header ${headerClass}`;
    toastMessage.textContent = message;

    // Muestra el toast
    toastInstance.show();
  }
</script>

<style>
  .toast-container {
    position: static !important;
    padding: 1rem;
  }

  .toast {
    background: white;
    border: none;
    border-radius: 8px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    opacity: 1 !important;
    margin: 0 auto;
  }

  .toast-header {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom: none;
    padding: 0.75rem;
  }

  .toast-body {
    padding: 1rem;
    font-size: 0.95rem;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    word-wrap: break-word;
  }

  .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
    padding: 0.5rem;
  }

  .btn-close:hover {
    opacity: 1;
  }

  @media (max-width: 768px) {
    .toast-container {
      padding: 0.5rem;
    }

    .toast {
      width: 100% !important;
      max-width: none;
      margin: 0;
    }

    .toast-header {
      padding: 0.5rem;
    }

    .toast-body {
      padding: 0.75rem;
      font-size: 0.9rem;
    }
  }

  @media (max-width: 576px) {
    .toast-container {
      padding: 0.25rem;
    }

    .toast-header {
      padding: 0.5rem;
    }

    .toast-body {
      padding: 0.5rem;
      font-size: 0.85rem;
    }

    #toastTitle {
      font-size: 0.9rem;
    }
  }

  /* Asegurar que el toast no se salga de la pantalla en dispositivos muy pequeños */
  @media (max-width: 320px) {
    .toast {
      min-width: auto;
    }

    .toast-body {
      font-size: 0.8rem;
    }
  }
</style>


<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>

<?php require_once 'views/layouts/footer.php'; ?>