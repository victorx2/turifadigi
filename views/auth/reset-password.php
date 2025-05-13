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
            <h2 class="section-title__title">Restablecer Contraseña</h2>
          </div>
          <form id="form-reset-password" class="  contact-two__form" action="reset_password" method="post">
            <div class="row">
              <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
              <div class="col-xl-12">
                <div class="contact-two__input-box">
                  <input type="password"
                    name="password"
                    id="password"
                    placeholder="Nueva contraseña"
                    title="La contraseña es requerida"
                    required>
                </div>
              </div>
              <div class="col-xl-12">
                <div class="contact-two__input-box">
                  <input type="password"
                    name="confirm_password"
                    id="confirm_password"
                    placeholder="Confirmar nueva contraseña"
                    title="Debes confirmar la contraseña"
                    required>
                </div>
              </div>
              <div class="col-xl-12 text-center">
                <div class="contact-two__btn-box">
                  <button type="submit" class="thm-btn contact-two__btn">Restablecer Contraseña</button>
                </div>
              </div>
            </div>
          </form>

          <div class="result"></div>

          <!-- Toast para notificaciones -->
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
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');

  // Validación de contraseñas
  function validatePasswords() {
    if (password.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'La contraseña es requerida');
      password.style.border = "2px solid red";
      password.focus();
      return false;
    }

    if (password.value !== confirmPassword.value) {
      showToast('warning', 'Error', 'Las contraseñas no coinciden');
      confirmPassword.style.border = "2px solid red";
      return false;
    }

    if (password.value.length < 6) {
      showToast('warning', 'Error', 'La contraseña debe tener al menos 6 caracteres');
      password.style.border = "2px solid red";
      return false;
    }

    confirmPassword.style.border = "2px solid #4a90e2";
    password.style.border = "2px solid #4a90e2";
    return true;
  }

  // Manejo del envío del formulario
  document.getElementById('form-reset-password').addEventListener('submit', function(event) {
    event.preventDefault();

    if (!validatePasswords()) {
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

  // Función para mostrar notificaciones tipo toast
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

<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>

<?php require_once 'views/layouts/footer.php'; ?>