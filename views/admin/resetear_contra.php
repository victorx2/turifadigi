<?php require_once 'views/layouts/header.php'; ?>
<!-- Agregar CSS de Toastify y Bootstrap Icons si no están ya en el header -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  .icon-reset {
    padding-right: 8px;
    opacity: 0.8;
    font-size: 1.1em;
    vertical-align: middle;
    transition: color 0.2s;
    color: #2962ff;
  }

  .input-reset {
    border: 1.5px solid #90caf9;
    background: #f5f8ff;
    border-radius: 6px;
    padding: 10px 40px 10px 12px;
    width: 100%;
    font-size: 1.05em;
    transition: all 0.3s;
  }

  .input-reset:focus {
    border: 2px solid #2962ff;
    background: #fff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(41, 98, 255, 0.12);
  }

  .input-error-reset {
    border: 2px solid #e53935 !important;
    background: #fff0f0 !important;
  }

  .password-toggle-reset {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #2962ff;
    font-size: 1.2em;
    opacity: 0.7;
  }

  .password-toggle-reset:hover {
    opacity: 1;
  }

  .form-label-reset {
    font-weight: bold;
    margin-bottom: 4px;
    color: #2962ff;
  }
</style>
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
            <h2 class="section-title__title">Restablecer Contraseña</h2>
          </div>
          <form id="form_password" class="contact-two__form" action="reset_password" method="post" accept-charset="UTF-8">
            <label for="">
              <div class="contact-two__input-box"><input type="text" name="id_usuario" id="id_usuario"></div>
            </label>
            <div class="row">
              <div class="col-xl-12">
                <label for="password" class="form-label-reset">
                  <i class="bi bi-lock-fill icon-reset"></i> Nueva contraseña
                </label>
                <div class="contact-two__input-box" style="position: relative;">
                  <input type="password"
                    name="password"
                    id="password"
                    class="input-reset"
                    placeholder="Ej: MiContraseñaSegura123"
                    title="La contraseña es requerida"
                    required
                    autocomplete="new-password">
                  <span class="password-toggle-reset" onclick="togglePasswordVisibilityReset('password', 'icon-eye-reset1')">
                    <i class="bi bi-eye-fill" id="icon-eye-reset1"></i>
                  </span>
                </div>
              </div>
              <div class="col-xl-12 mt-3">
                <label for="confirm_password" class="form-label-reset">
                  <i class="bi bi-lock-fill icon-reset"></i> Confirmar nueva contraseña
                </label>
                <div class="contact-two__input-box" style="position: relative;">
                  <input type="password"
                    name="confirm_password"
                    id="confirm_password"
                    class="input-reset"
                    placeholder="Repite tu contraseña"
                    title="Debe confirmar la contraseña"
                    required
                    autocomplete="new-password">
                  <span class="password-toggle-reset" onclick="togglePasswordVisibilityReset('confirm_password', 'icon-eye-reset2')">
                    <i class="bi bi-eye-fill" id="icon-eye-reset2"></i>
                  </span>
                </div>
              </div>
              <div class="col-xl-12 text-center mt-4">
                <div class="contact-two__btn-box">
                  <button type="submit" class="thm-btn contact-two__btn">Restablecer Contraseña</button>
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
  // Toggle de visibilidad de contraseña
  function togglePasswordVisibilityReset(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('bi-eye-fill');
      icon.classList.add('bi-eye-slash-fill');
    } else {
      input.type = 'password';
      icon.classList.remove('bi-eye-slash-fill');
      icon.classList.add('bi-eye-fill');
    }
  }
  // Validación en tiempo real para los campos
  const form = document.getElementById('form_password');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');
  password.addEventListener('input', function() {
    if (this.value.trim() === '') {
      this.classList.add('input-error-reset');
    } else {
      this.classList.remove('input-error-reset');
    }
  });
  confirmPassword.addEventListener('input', function() {
    if (this.value.trim() === '' || password.value !== this.value) {
      this.classList.add('input-error-reset');
    } else {
      this.classList.remove('input-error-reset');
    }
  });
  // Manejo del envío del formulario
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    if (password.value.trim() === '' || confirmPassword.value.trim() === '') {
      showToast('warning', 'Campos vacíos', 'Ambos campos de contraseña son requeridos');
      if (password.value.trim() === '') {
        password.classList.add('input-error-reset');
        password.focus();
      } else {
        confirmPassword.classList.add('input-error-reset');
        confirmPassword.focus();
      }
      return;
    }
    if (password.value !== confirmPassword.value) {
      showToast('warning', 'Contraseñas no coinciden', 'Las contraseñas ingresadas no coinciden');
      password.classList.add('input-error-reset');
      confirmPassword.classList.add('input-error-reset');
      password.focus();
      return;
    }
    let formData = new FormData(this);
    fetch('/reset_password', {
        method: 'POST',
        body: new URLSearchParams(formData)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showToast('success', 'Éxito', data.message);
          setTimeout(() => {
            window.location.href = '/login';
          }, 3000);
        } else {
          showToast('error', 'Error', data.message);
        }
      })
      .catch(error => {
        showToast('error', 'Error', 'Hubo un error al procesar la solicitud');
      });
  });
  // Toast
  function showToast(type, title, message) {
    const toast = document.getElementById('notificationToast');
    const toastTitle = document.getElementById('toastTitle');
    const toastMessage = document.getElementById('toastMessage');
    const toastInstance = new bootstrap.Toast(toast, {
      autohide: true,
      delay: 5000
    });
    let headerClass = '';
    switch (type) {
      case 'success':
        headerClass = 'bg-success text-white';
        break;
      case 'error':
        headerClass = 'bg-danger text-white';
        break;
      case 'warning':
        headerClass = 'bg-warning text-white';
        break;
      default:
        headerClass = 'bg-info text-white';
    }
    toastTitle.textContent = title;
    toast.querySelector('.toast-header').className = toast-header ${headerClass};
    toastMessage.textContent = message;
    toastInstance.show();
  }
</script>
<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>
<?php require_once 'views/layouts/footer.php'; ?>