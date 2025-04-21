<?php require_once 'views/auth/header_login.php'; ?>
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
            <h2 class="section-title__title">Registrar Cuenta</h2>
          </div>
          <form id="form-registro" class="contact-form-validated contact-two__form" action="registro_usuario" method="post">
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <div class="contact-two__input-box">
                  <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre del usuario" title="El nombre del usuario es requerido" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="contact-two__input-box">
                  <input type="text" name="clave_usuario" id="clave_usuario" placeholder="Contraseña" title="Debe rellenar el campo contraseña" required style="-webkit-text-security: disc;">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="contact-two__input-box">
                  <input type="text"
                    name="telefono_usuario"
                    id="telefono_usuario"
                    placeholder="Número de teléfono"
                    pattern="[0-9]{20}"
                    maxlength="20"
                    title="El número de teléfono es requerido"
                    required>
                </div>
              </div>
              <div class="col-xl-12 text-center">
                <div class="contact-two__btn-box">
                  <button type="submit" class="thm-btn contact-two__btn">Registrarme</button>
                </div>
              </div>
            </div>
          </form>

          <div class="result"></div>

          <p class="contact-two__left-text" style="margin-top: 20px;">¿Ya tienes una cuenta? &nbsp;&nbsp;&nbsp;<a href="/TuRifadigi/login">Inicia sesión</a></p>

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
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById('clave_usuario');
    if (passwordInput.style.webkitTextSecurity === 'disc') {
      passwordInput.style.webkitTextSecurity = 'none';
    } else {
      passwordInput.style.webkitTextSecurity = 'disc';
    }
  }

  const passwordContainer = document.querySelector('#clave_usuario').parentNode;
  const eyeIcon = document.createElement('i');
  eyeIcon.className = 'fas fa-eye';
  eyeIcon.style.position = 'absolute';
  eyeIcon.style.right = '15px';
  eyeIcon.style.top = '50%';
  eyeIcon.style.transform = 'translateY(-50%)';
  eyeIcon.style.cursor = 'pointer';
  eyeIcon.addEventListener('click', togglePasswordVisibility);
  passwordContainer.style.position = 'relative';
  passwordContainer.appendChild(eyeIcon);
</script>


<script>
  
  let nombre_usuario = document.getElementById('nombre_usuario');
  let clave_usuario = document.getElementById('clave_usuario');
  let telefono_usuario = document.getElementById('telefono_usuario');

  // Prevenir espacios en todos los campos
  [nombre_usuario, clave_usuario, telefono_usuario].forEach(input => {
    // Prevenir que se escriban espacios con la barra espaciadora
    input.addEventListener('keydown', function(e) {
      if (e.key === ' ') {
        e.preventDefault(); // Cancela la acción por defecto de escribir un espacio
      }
    });

    // Prevenir pegar texto que contenga espacios
    input.addEventListener('paste', function(e) {
      e.preventDefault(); // Cancela el pegado normal
      let text = (e.clipboardData || window.clipboardData).getData('text');
      if (!text.includes(' ')) {
        // Solo permite pegar si el texto no contiene espacios
        this.value = text;
      }
    });

    // Limpiar espacios si se intentan agregar de otra forma
    input.addEventListener('input', function() {
      this.value = this.value.replace(/\s/g, ''); // Elimina todos los espacios
    });
  });

  // Validación en tiempo real para el campo nombre_usuario
  nombre_usuario.addEventListener('input', function() {
    if (this.value.trim() === '' || this.value.length < 3) {
      showToast('warning', 'Campo vacío', 'El campo nombre de usuario se encuentra vacío y debe tener al menos 3 caracteres');
      this.style.border = "2px solid red"; // Borde rojo si es inválido
      this.focus();
    } else {
      this.style.border = "2px solid #4a90e2"; // Borde azul si es válido
    }
  });

  // Cambiar estilo cuando el campo nombre_usuario recibe foco
  nombre_usuario.addEventListener('focus', function() {
    if (!(this.value.trim() === '' || this.value.length < 3)) {
      this.style.border = "2px solid #4a90e2"; // Borde azul si es válido
    }
  });

  // Quitar borde cuando el campo nombre_usuario pierde el foco
  nombre_usuario.addEventListener('blur', function() {
    if (!(this.value.trim() === '' || this.value.length < 3)) {
      this.style.border = ""; // Quita el borde si es válido
    }
  });

  // Validación en tiempo real para el campo clave_usuario
  clave_usuario.addEventListener('input', function() {
    if (this.value.trim() === '' || this.value.length < 6) {
      showToast('warning', 'Campo vacío', 'El campo contraseña se encuentra vacío y debe tener al menos 6 caracteres');
      this.style.border = "2px solid red";
      this.focus();
    } else {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Cambiar estilo cuando el campo clave_usuario recibe foco
  clave_usuario.addEventListener('focus', function() {
    if (!(this.value.trim() === '' || this.value.length < 6)) {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Quitar borde cuando el campo clave_usuario pierde el foco
  clave_usuario.addEventListener('blur', function() {
    if (!(this.value.trim() === '' || this.value.length < 6)) {
      this.style.border = "";
    }
  });

  // Validación en tiempo real para el campo telefono_usuario
  telefono_usuario.addEventListener('input', function() {
    if (this.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo teléfono se encuentra vacío');
      this.style.border = "2px solid red";
      this.focus();
    } else {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Cambiar estilo cuando el campo telefono_usuario recibe foco
  telefono_usuario.addEventListener('focus', function() {
    if (!(this.value.trim() === '')) {
      this.style.border = "2px solid #4a90e2";
    }
  });

  // Quitar borde cuando el campo telefono_usuario pierde el foco
  telefono_usuario.addEventListener('blur', function() {
    if (!(this.value.trim() === '')) {
      this.style.border = "";
    }
  });

  // Manejo del envío del formulario
  document.getElementById('form-registro').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío normal del formulario

    // Validaciones finales antes de enviar
    if (nombre_usuario.value.trim() === '' || nombre_usuario.value.length < 3) {
      showToast('warning', 'Campo vacío', 'El campo nombre de usuario se encuentra vacío y debe tener al menos 3 caracteres');
      nombre_usuario.style.border = "2px solid red";
      nombre_usuario.focus();
      return;
    }

    if (clave_usuario.value.trim() === '' || clave_usuario.value.length < 6) {
      showToast('warning', 'Campo vacío', 'El campo contraseña se encuentra vacío y debe tener al menos 6 caracteres');
      clave_usuario.style.border = "2px solid red";
      clave_usuario.focus();
      return;
    }

    if (telefono_usuario.value.trim() === '') {
      showToast('warning', 'Campo vacío', 'El campo teléfono se encuentra vacío');
      telefono_usuario.style.border = "2px solid red";
      telefono_usuario.focus();
      return;
    }

    // Si pasa todas las validaciones, prepara los datos para enviar
    let formData = new FormData(this);

    // Envía los datos al servidor usando fetch
    fetch('/TuRifadigi/registro_usuario', {
        method: 'POST',
        body: new URLSearchParams(formData)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showToast(data.type, 'Éxito', data.message);
          setTimeout(() => {
            window.location.href = '/TuRifadigi/login'; // Redirige después de 3 segundos
          }, 3000);
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

  /* Responsive styles */

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

<?php require_once 'views/auth/footer_login.php'; ?>