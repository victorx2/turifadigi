<?php require_once 'views/auth/header.php'; ?>
<!-- Agregar CSS de Toastify -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<!-- Agregar CSS personalizado -->
<link rel="stylesheet" type="text/css" href="assets/css/ToastPersonalizado.css">
<!-- Agregar Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Estilos personalizados para los iconos del signup -->
<style>
  .icon-signup {
    padding-right: 8px;
    opacity: 0.8;
    font-size: 1.1em;
    vertical-align: middle;
    transition: color 0.2s;
  }

  .icon-signup.nombre {
    color: #2962ff;
  }

  .icon-signup.apellido {
    color: #4173ff;
  }

  .icon-signup.cedula {
    color: #5a85ff;
  }

  .icon-signup.ubicacion {
    color: #7296ff;
  }

  .icon-signup.usuario {
    color: #8aa7ff;
  }

  .icon-signup.password {
    color: #a2b8ff;
  }

  .icon-signup.telefono {
    color: #baccff;
  }

  .icon-signup.correo {
    color: #d1deff;
  }

  /* Estilo de error personalizado para los inputs del signup */
  .input-error-signup {
    border: 2px solid #2962ff !important;
    background: rgba(41, 98, 255, 0.07) !important;
    box-shadow: 0 0 0 3px rgba(41, 98, 255, 0.12);
    transition: all 500ms ease;
  }

  /* Efecto hover/focus para los inputs del signup (diferente al error) */
  .input-hover-signup {
    transition: all 500ms ease;
  }

  .input-hover-signup:focus,
  .input-hover-signup:hover {
    border: 1.5px solid #90caf9;
    background: #f5f8ff;
    box-shadow: 0 0 0 2px rgba(41, 98, 255, 0.08);
    outline: none;
  }
</style>
<!-- Agregar JS de Toastify -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- Agregar JS personalizado -->
<script type="text/javascript" src="assets/js/ToastPersonalizado.js"></script>

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

              </div>
              <span class="section-title__tagline"></span>
            </div>
            <h2 class="section-title__title">Registrar Cuenta</h2>
          </div>
          <form id="form-registro" class="contact-form-validated contact-two__form" action="registro_usuario" method="post">
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <label for="nombre_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-fill icon-signup nombre"></i> Nombre *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="nombre" id="nombre_signup" placeholder="Ingrese su nombre" title="El nombre es requerido" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="apellido_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-badge-fill icon-signup apellido"></i> Apellido *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="apellido" id="apellido_signup" placeholder="Ingrese su apellido" title="El apellido es requerido" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="cedula_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-card-text icon-signup cedula"></i> Cédula *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="cedula" id="cedula_signup" placeholder="Ingrese su cédula" title="La cédula es requerida" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="ubicacion_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-geo-alt-fill icon-signup ubicacion"></i> Ubicación *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="ubicacion" id="ubicacion_signup" placeholder="E.J: País, estado, dirección" title="La ubicación es requerida" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="usuario_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-person-circle icon-signup usuario"></i> Nombre de usuario *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="usuario" id="usuario_signup" placeholder="Cree un nombre de usuario" title="El nombre de usuario es requerido" required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="password_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-lock-fill icon-signup password"></i> Contraseña *
                </label>
                <div class="contact-two__input-box">
                  <input type="text" name="password" id="password_signup" placeholder="Cree una contraseña" title="Debe rellenar el campo contraseña" required style="-webkit-text-security: disc;" class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="telefono_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-telephone-fill icon-signup telefono"></i> Teléfono *
                </label>
                <div class="contact-two__input-box">
                  <input type="text"
                    name="telefono"
                    id="telefono_signup"
                    placeholder="Ingrese su número de teléfono"
                    pattern="[0-9]{20}"
                    maxlength="20"
                    title="El número de teléfono es requerido"
                    required class="input-hover-signup">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="correo_signup" class="form-label" style="font-weight: bold;">
                  <i class="bi bi-envelope-fill icon-signup correo"></i> Correo electrónico *
                </label>
                <div class="contact-two__input-box">
                  <input type="email"
                    name="correo"
                    id="correo_signup"
                    placeholder="Ingrese su correo electrónico"
                    title="El correo electrónico es requerido"
                    required class="input-hover-signup">
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

        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // ? [Función para mostrar/ocultar contraseña] - Alterna la visibilidad del texto en el campo de contraseña
  // ! Usa la propiedad webkitTextSecurity para cambiar entre 'disc' (puntos) y 'none' (texto visible)
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password_signup');
    if (passwordInput.style.webkitTextSecurity === 'disc') {
      passwordInput.style.webkitTextSecurity = 'none';
    } else {
      passwordInput.style.webkitTextSecurity = 'disc';
    }
  }

  const passwordContainer = document.querySelector('#password_signup').parentNode;
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
  let nombre_signup = document.getElementById('nombre_signup');
  let apellido_signup = document.getElementById('apellido_signup');
  let cedula_signup = document.getElementById('cedula_signup');
  let ubicacion_signup = document.getElementById('ubicacion_signup');
  let usuario_signup = document.getElementById('usuario_signup');
  let password_signup = document.getElementById('password_signup');
  let telefono_signup = document.getElementById('telefono_signup');
  let correo_signup = document.getElementById('correo_signup');

  // Objeto con las reglas de validación
  const validationRules = {
    nombre_signup: {
      pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/,
      message: 'El nombre solo debe contener letras',
      minLength: 1
    },
    apellido_signup: {
      pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/,
      message: 'El apellido solo debe contener letras',
      minLength: 1
    },
    cedula_signup: {
      pattern: /^\d+$/,
      message: 'La cédula solo debe contener números',
      minLength: 1
    },
    ubicacion_signup: {
      allowSpaces: true,
      pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s,.-]+$/,
      message: 'La ubicación contiene caracteres no válidos',
      minLength: 1
    },
    usuario_signup: {
      pattern: /^[A-Za-z0-9_-]+$/,
      minLength: 8,
      message: 'El usuario debe contener letras, números y opcionalmente los símbolos (_-)',
      strengthChecks: {
        lowercase: /[a-z]/,
        uppercase: /[A-Z]/,
        numbers: /[0-9]/,
        special: /[_-]/
      }
    },
    password_signup: {
      pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.%$#"@*&%/(._-])[A-Za-z\d.%$#"@*&%/(._-]{8,}/,
      minLength: 8,
      message: 'La contraseña debe contener mayúsculas, minúsculas, números y caracteres especiales',
      strengthChecks: {
        lowercase: /[a-z]/,
        uppercase: /[A-Z]/,
        numbers: /[0-9]/,
        special: /[.%$#"@*&%/(._-]/
      }
    },
    telefono_signup: {
      pattern: /^\d+$/,
      message: 'El teléfono solo debe contener números',
      minLength: 1
    },
    correo_signup: {
      pattern: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/,
      message: 'Formato inválido (ejemplo: usuario@dominio.com)',
      minLength: 1
    }
  };

  // Función para verificar la fortaleza de contraseña/usuario
  function checkStrength(value, checks) {
    let strength = 0;
    let feedback = [];
    let totalChecks = 0;

    // Para usuario_signup, solo requerimos letras y números
    if (checks === validationRules.usuario_signup.strengthChecks) {
      const requirements = {
        'minúsculas': checks.lowercase,
        'mayúsculas': checks.uppercase,
        'números': checks.numbers
      };
      totalChecks = 3; // Solo 3 requisitos para usuario

      for (const [requirement, regex] of Object.entries(requirements)) {
        if (regex.test(value)) {
          strength += 33.33; // 100/3 para distribuir el peso entre los 3 requisitos
        } else {
          feedback.push(requirement);
        }
      }
    } else {
      // Para password_signup y otros campos que requieren todos los checks
      const requirements = {
        'minúsculas': checks.lowercase,
        'mayúsculas': checks.uppercase,
        'números': checks.numbers,
        'caracteres especiales': checks.special
      };
      totalChecks = 4; // 4 requisitos para contraseña

      for (const [requirement, regex] of Object.entries(requirements)) {
        if (regex.test(value)) {
          strength += 25; // 100/4 para distribuir el peso entre los 4 requisitos
        } else {
          feedback.push(requirement);
        }
      }
    }

    return {
      strength,
      color: strength < (100 / totalChecks) ? '#ff4d4d' : strength < (100 / totalChecks * 2) ? '#ffd700' : '#4CAF50',
      message: `${strength < (100/totalChecks) ? 'débil' : strength < (100/totalChecks * 2) ? 'medio' : 'fuerte'}${feedback.length ? ` (falta: ${feedback.join(', ')})` : ''}`
    };
  }

  // Función para validar un campo
  function validateField(fieldId, value, autoRemoveError = false) {
    const field = document.getElementById(fieldId);
    const rules = validationRules[fieldId];

    if (!value.trim()) {
      field.classList.add('input-error-signup');
      if (autoRemoveError) setTimeout(() => field.classList.remove('input-error-signup'), 2000);
      showToast('warning', 'Campo vacío', `El campo ${fieldId.split('_')[0]} es requerido`);
      return false;
    }

    if (rules.minLength && value.length < rules.minLength) {
      field.classList.add('input-error-signup');
      if (autoRemoveError) setTimeout(() => field.classList.remove('input-error-signup'), 2000);
      showToast('warning', 'Campo inválido', `Mínimo ${rules.minLength} caracteres requeridos`);
      return false;
    }

    if (!rules.allowSpaces) {
      field.value = value.replace(/\s/g, '');
    }

    if (rules.pattern && !rules.pattern.test(value.trim())) {
      field.classList.add('input-error-signup');
      if (autoRemoveError) setTimeout(() => field.classList.remove('input-error-signup'), 2000);
      showToast('warning', 'Formato inválido', rules.message);
      return false;
    }

    if (rules.strengthChecks) {
      const strengthResult = checkStrength(value, rules.strengthChecks);
      field.style.border = `2px solid ${strengthResult.color}`;
      field.classList.remove('input-error-signup');

      const strengthMessage = document.getElementById(`${fieldId}_strength`);
      if (strengthMessage) {
        strengthMessage.textContent = `Fortaleza: ${strengthResult.message}`;
        strengthMessage.style.color = strengthResult.color;
      }

      return strengthResult.strength === 100;
    }

    field.style.border = "2px solid #4a90e2";
    field.classList.remove('input-error-signup');
    return true;
  }

  // Inicialización y eventos de los campos
  Object.keys(validationRules).forEach(fieldId => {
    const field = document.getElementById(fieldId);
    const rules = validationRules[fieldId];

    // Crear indicador de fortaleza si es necesario
    if (rules.strengthChecks) {
      const strengthDiv = document.createElement('div');
      strengthDiv.id = `${fieldId}_strength`;
      strengthDiv.style.cssText = 'margin-top: 5px; font-size: 12px;';
      field.parentElement.appendChild(strengthDiv);
    }

    // Event listeners para validación
    ['input', 'keyup'].forEach(event => {
      field.addEventListener(event, () => {
        validateField(fieldId, field.value);
        // Remueve el error visual si el campo es válido
        if (field.classList.contains('input-error-signup') && validateField(fieldId, field.value)) {
          field.classList.remove('input-error-signup');
        }
      });
    });
    // Al perder el foco, si el campo es válido, remueve el error
    field.addEventListener('blur', () => {
      if (validateField(fieldId, field.value)) {
        field.classList.remove('input-error-signup');
      }
    });
    // Al hacer focus, si hay error, lo remueve a los 5 segundos si no se corrige antes
    field.addEventListener('focus', () => {
      if (field.classList.contains('input-error-signup')) {
        setTimeout(() => {
          if (field.classList.contains('input-error-signup')) {
            field.classList.remove('input-error-signup');
          }
        }, 5000);
      }
    });
    // Prevenir espacios y manejar pegado
    field.addEventListener('keydown', e => {
      if (e.key === ' ' && !rules.allowSpaces) {
        e.preventDefault();
      }
    });

    field.addEventListener('paste', e => {
      e.preventDefault();
      let text = (e.clipboardData || window.clipboardData).getData('text');

      if (rules.pattern.test(text.trim())) {
        field.value = rules.allowSpaces ? text : text.replace(/\s/g, '');
      }
    });
  });

  const form = document.getElementById('form-registro');
  let isSubmitting = false;

  // Manejo del formulario
  form.addEventListener('submit', async function(event) {
    event.preventDefault();
    if (isSubmitting) return;

    const isValid = Object.keys(validationRules).every(fieldId =>
      validateField(fieldId, document.getElementById(fieldId).value, true)
    );

    if (!isValid) return;
    isSubmitting = true;
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    try {
      const formData = new URLSearchParams(new FormData(this));
      const response = await fetch('/TuRifadigi/registro_usuario', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData.toString(),
        credentials: 'same-origin',
        mode: 'same-origin'
      });

      const data = await response.json();
      if (!response.ok) throw data;

      showToast('success', 'Éxito', data.message);
      Array.from(form.getElementsByTagName('input')).forEach(input => input.disabled = true);
      setTimeout(() => window.location.href = data.redirect, 1500);

    } catch (error) {
      console.error('Error:', error);
      showToast('error', 'Error', error.message || 'Hubo un error al procesar la solicitud');
    } finally {
      isSubmitting = false;
      submitButton.disabled = false;
    }
  });

  function showToast(type, title, message) {
    switch (type) {
      case 'success':
        ToastPersonalizado.exito(title, message, 5000);
        break;
      case 'error':
        ToastPersonalizado.error(title, message, 5000);
        break;
      case 'warning':
        ToastPersonalizado.advertencia(title, message, 5000);
        break;
      case 'info':
        ToastPersonalizado.info(title, message, 5000);
        break;
    }
  }
</script>

<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>

<?php require_once 'views/auth/footer.php'; ?>