<?php require_once 'views/auth/header_login.php'; ?>

<!--Contact Two Start-->
<section class="contact-two">
  <div class="contact-two__img-1 wow fadeInLeft" data-wow-delay="300ms">
    <img src="assets/images/resources/contact-two-img-1.png" alt="" class="float-bob-x">
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6">
        <div class="contact-two__left bg-white p-4 rounded shadow">
          <div class="section-title text-center mb-4">
            <h2 class="section-title__title">Iniciar sesión</h2>
          </div>

          <form id="form-login" class="contact-form-validated contact-two__form">
            <div class="row">
              <div class="col-12 mb-3">
                <div class="contact-two__input-box position-relative">
                  <input
                    type="text"
                    name="identificador"
                    id="identificador"
                    class="form-control"
                    placeholder="Nombre de usuario o teléfono"
                    required>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="contact-two__input-box position-relative">
                  <input
                    type="password"
                    name="clave_usuario"
                    id="clave_usuario"
                    class="form-control"
                    placeholder="Contraseña"
                    required>
                </div>
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="thm-btn contact-two__btn w-100">
                  Iniciar sesión
                </button>
              </div>
            </div>
          </form>

          <div class="text-center mt-4">
            <p class="contact-two__left-text">
              <a href="/TuRifadigi/register" class="text-primary">¿No tiene cuenta?</a>
            </p>
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

        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* Estilos adicionales para mejorar la apariencia */
  .contact-two {
    padding: 80px 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  }

  .contact-two__left {
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.9) !important;
    border-radius: 15px !important;
  }

  .form-control {
    height: 50px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 0 15px;
    font-size: 16px;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
  }

  .thm-btn {
    height: 50px;
    border-radius: 8px;
    background-color: #4a90e2;
    color: white;
    border: none;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .thm-btn:hover {
    background-color: #357abd;
    transform: translateY(-2px);
  }

  .contact-two__input-box {
    margin-bottom: 20px;
  }

  /* Estilos para el toast */
  .toast {
    background: white;
    border: none;
    border-radius: 8px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }

  .toast-header {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    padding: 0.75rem;
  }

  .toast-body {
    padding: 1rem;
    font-size: 0.95rem;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .contact-two {
      padding: 40px 0;
    }

    .contact-two__left {
      margin: 15px;
    }
  }
</style>

<!-- Scripts necesarios -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Mantener el mismo JavaScript que teníamos antes para la funcionalidad
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById('clave_usuario');
    if (passwordInput.style.webkitTextSecurity === 'disc') {
      passwordInput.style.webkitTextSecurity = 'none';
    } else {
      passwordInput.style.webkitTextSecurity = 'disc';
    }
  }

  // Agregar el ícono del ojo
  const passwordContainer = document.querySelector('#clave_usuario').parentNode;
  const eyeIcon = document.createElement('i');
  eyeIcon.className = 'fas fa-eye';
  eyeIcon.style.cssText = `
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
`;
  eyeIcon.addEventListener('click', togglePasswordVisibility);
  passwordContainer.style.position = 'relative';
  passwordContainer.appendChild(eyeIcon);

  // Obtener referencias a los elementos
  let identificador = document.getElementById('identificador');
  let clave_usuario = document.getElementById('clave_usuario');

  // Prevenir espacios en todos los campos
  [identificador, clave_usuario].forEach(input => {
    input.addEventListener('keydown', function(e) {
      if (e.key === ' ') {
        e.preventDefault();
      }
    });

    input.addEventListener('paste', function(e) {
      e.preventDefault();
      let text = (e.clipboardData || window.clipboardData).getData('text');
      if (!text.includes(' ')) {
        this.value = text;
      }
    });

    input.addEventListener('input', function() {
      this.value = this.value.replace(/\s/g, '');
    });
  });

  // Validación para identificador
  identificador.addEventListener('input', function() {
    if (this.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo identificador es requerido');
      this.style.border = "2px solid red";
      this.focus();
    } else {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Validación para clave_usuario
  clave_usuario.addEventListener('input', function() {
    if (this.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo contraseña es requerido');
      this.style.border = "2px solid red";
      this.focus();
    } else {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Manejo del formulario
  document.getElementById('form-login').addEventListener('submit', function(event) {
    event.preventDefault();

    // Deshabilitar el botón de submit para evitar doble envío
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    // Validaciones finales antes de enviar
    if (identificador.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo identificador es requerido');
      identificador.style.border = "2px solid red";
      identificador.focus();
      submitButton.disabled = false;
      return;
    }

    if (clave_usuario.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo contraseña es requerido');
      clave_usuario.style.border = "2px solid red";
      clave_usuario.focus();
      submitButton.disabled = false;
      return;
    }

    // Si pasa todas las validaciones, prepara los datos para enviar
    let formData = new FormData(this);

    // Envía los datos al servidor usando fetch
    fetch('/TuRifadigi/login', {
        method: 'POST',
        body: new URLSearchParams(formData)
      })
      .then(response => response.json())
      .then(data => {
        console.log('Respuesta del servidor:', data); // Debug
        if (data.success) {
          showToast(data.type, 'Éxito', data.message);
          setTimeout(() => {
            window.location.href = '/TuRifadigi/home';
          }, 3000);
        } else {
          showToast(data.type, 'Error', data.message);
          submitButton.disabled = false;
        }
      })
      .catch(error => {
        console.error('Error:', error); // Debug
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

<?php require_once 'views/auth/footer_login.php'; ?>