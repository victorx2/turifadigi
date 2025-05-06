<?php require_once 'views/auth/header.php'; ?>
<!-- Agregar CSS de Toastify -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<!-- Agregar CSS personalizado -->
<link rel="stylesheet" type="text/css" href="assets/css/ToastPersonalizado.css">
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
                <!-- <img src="assets/images/shapes/section-title-tagline-shape.png" alt=""> -->
              </div>
              <span class="section-title__tagline"></span>
            </div>
            <h2 class="section-title__title">Registrar Cuenta</h2>
          </div>
          <form id="form-registro" class="contact-form-validated contact-two__form" action="registro_usuario" method="post">
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <label for="nombre_signup" class="form-label" style="font-weight: bold;">Nombre *</label>
                <div class="contact-two__input-box">
                  <input type="text" name="nombre" id="nombre_signup" placeholder="Ingrese su nombre" title="El nombre es requerido" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="apellido_signup" class="form-label" style="font-weight: bold;">Apellido *</label>
                <div class="contact-two__input-box">
                  <input type="text" name="apellido" id="apellido_signup" placeholder="Ingrese su apellido" title="El apellido es requerido" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="cedula_signup" class="form-label" style="font-weight: bold;">Cédula *</label>
                <div class="contact-two__input-box">
                  <input type="text" name="cedula" id="cedula_signup" placeholder="Ingrese su cédula" title="La cédula es requerida" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="ubicacion_signup" class="form-label" style="font-weight: bold;">Ubicación *</label>
                <div class="contact-two__input-box">
                  <input type="text" name="ubicacion" id="ubicacion_signup" placeholder="E.J: País, estado, dirección" title="La ubicación es requerida" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="usuario_signup" class="form-label" style="font-weight: bold;">Nombre de usuario *</label>
                <div class="contact-two__input-box">
                  <input type="text" name="usuario" id="usuario_signup" placeholder="Cree un nombre de usuario" title="El nombre de usuario es requerido" required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="password_signup" class="form-label" style="font-weight: bold;">Contraseña *</label>
                <div class="contact-two__input-box">
                  <input type="text" name="password" id="password_signup" placeholder="Cree una contraseña" title="Debe rellenar el campo contraseña" required style="-webkit-text-security: disc;">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="telefono_signup" class="form-label" style="font-weight: bold;">Teléfono *</label>
                <div class="contact-two__input-box">
                  <input type="text"
                    name="telefono"
                    id="telefono_signup"
                    placeholder="Ingrese su número de teléfono"
                    pattern="[0-9]{20}"
                    maxlength="20"
                    title="El número de teléfono es requerido"
                    required>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <label for="correo_signup" class="form-label" style="font-weight: bold;">Correo electrónico *</label>
                <div class="contact-two__input-box">
                  <input type="email"
                    name="correo"
                    id="correo_signup"
                    placeholder="Ingrese su correo electrónico"
                    title="El correo electrónico es requerido"
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


  // ? [Array de inputs] - Seleccionamos los elementos del formulario que queremos validar
  [nombre_signup, apellido_signup, cedula_signup, usuario_signup, password_signup, telefono_signup, correo_signup].forEach(input => {

    // ? [Evento keydown] - Escuchamos cuando se presiona una tecla en el input
    input.addEventListener('keydown', function(e) {

      // ! [Validación de espacio] - Si la tecla presionada es un espacio, prevenimos la acción por defecto
      if (e.key === ' ') {
        e.preventDefault();
      }
    });

    // ? [Evento paste específico] - Maneja la acción de pegar con validaciones por campo
    input.addEventListener('paste', function(e) {
      e.preventDefault();
      let text = (e.clipboardData || window.clipboardData).getData('text');

      // * [Validación campos nombre/apellido] - Permite pegar solo texto (sin espacios)
      if (this.id === 'nombre_signup' || this.id === 'apellido_signup') {
        if (/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(text)) {
          this.value = text;
        }
      }
      // * [Validación campos cédula/teléfono] - Permite pegar solo números
      else if (this.id === 'cedula_signup' || this.id === 'telefono_signup') {
        if (/^\d+$/.test(text)) {
          this.value = text;
        }
      }
      // * [Validación campo correo] - Permite pegar cualquier texto, símbolos, números y espacios
      else if (this.id === 'correo_signup') {
        this.value = text;
      }
      // ! [Restricción campos usuario/contraseña] - Bloquea completamente pegar texto
      else if (this.id === 'usuario_signup' || this.id === 'password_signup') {
        return false;
      }
    });
  });


  // Función genérica para validar campos
  const validarCampo = (campo, minLength = 1, regex = null) => {
    const valor = campo.value.trim();
    const vacio = valor === '';
    const longitudInvalida = valor.length < minLength;
    const formatoInvalido = regex && !regex.test(valor);

    if (vacio || longitudInvalida || formatoInvalido) {
      const mensaje = vacio ? 'Campo vacío' :
        longitudInvalida ? `Mínimo ${minLength} caracteres` :
        'Formato inválido';
      showToast('warning', 'Error', `El campo ${campo.name} ${mensaje}`);
      campo.style.border = "2px solid red";
      campo.focus();
      return false;
    }
    campo.style.border = "2px solid #4a90e2";
    return true;
  };

  // Configuración de validaciones por campo
  const validaciones = {
    nombre_signup: {
      minLength: 1
    },
    apellido_signup: {
      minLength: 1
    },
    cedula_signup: {
      minLength: 1
    },
    ubicacion_signup: {
      minLength: 1
    },
    usuario_signup: {
      minLength: 3
    },
    password_signup: {
      minLength: 6
    },
    telefono_signup: {
      minLength: 1
    },
    correo_signup: {
      minLength: 1,
      regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    }
  };

  // Aplicar eventos a todos los campos
  Object.keys(validaciones).forEach(id => {
    const campo = document.getElementById(id);
    const {
      minLength,
      regex
    } = validaciones[id];

    campo.addEventListener('input', () => validarCampo(campo, minLength, regex));

    campo.addEventListener('focus', () => {
      if (campo.value.trim() !== '') {
        campo.style.border = "2px solid #4a90e2";
      }
    });

    campo.addEventListener('blur', () => {
      if (campo.value.trim() !== '') {
        campo.style.border = "";
      }
    });
  });


  const form = document.getElementById('form-registro');
  let isSubmitting = false;

  // Objeto con las reglas de validación
  const validationRules = {
    nombre_signup: {
      pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/,
      message: 'El nombre solo debe contener letras'
    },
    apellido_signup: {
      pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/,
      message: 'El apellido solo debe contener letras'
    },
    cedula_signup: {
      pattern: /^\d+$/,
      message: 'La cédula solo debe contener números'
    },
    ubicacion_signup: {
      allowSpaces: true,
      pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s,.-]+$/,
      message: 'La ubicación contiene caracteres no válidos'
    },
    usuario_signup: {
      pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/,
      minLength: 8,
      message: 'El usuario debe contener mayúsculas, minúsculas, números y caracteres especiales',
      strengthChecks: {
        lowercase: /[a-z]/,
        uppercase: /[A-Z]/,
        numbers: /[0-9]/,
        special: /[$@$!%*?&]/
      }
    },
    password_signup: {
      pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/,
      minLength: 8,
      message: 'La contraseña debe contener mayúsculas, minúsculas, números y caracteres especiales',
      strengthChecks: {
        lowercase: /[a-z]/,
        uppercase: /[A-Z]/,
        numbers: /[0-9]/,
        special: /[$@$!%*?&]/
      }
    },
    telefono_signup: {
      pattern: /^\d+$/,
      message: 'El teléfono solo debe contener números'
    },
    correo_signup: {
      pattern: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/,
      message: 'Formato inválido (ejemplo: usuario@dominio.com)'
    }
  };

  // Función para verificar la fortaleza de contraseña/usuario
  function checkStrength(value, checks) {
    let strength = 0;
    let feedback = [];
    const requirements = {
      'minúsculas': checks.lowercase,
      'mayúsculas': checks.uppercase,
      'números': checks.numbers,
      'caracteres especiales ($@$!%*?&)': checks.special
    };

    for (const [requirement, regex] of Object.entries(requirements)) {
      if (regex.test(value)) {
        strength += 25;
      } else {
        feedback.push(requirement);
      }
    }

    return {
      strength,
      color: strength < 50 ? '#ff4d4d' : strength < 75 ? '#ffd700' : '#4CAF50',
      message: `${strength < 50 ? 'débil' : strength < 75 ? 'medio' : 'fuerte'}${feedback.length ? ` (falta: ${feedback.join(', ')})` : ''}`
    };
  }

  // Función para validar un campo
  function validateField(fieldId, value) {
    const field = document.getElementById(fieldId);
    const rules = validationRules[fieldId];

    if (!value.trim()) {
      field.style.border = "2px solid red";
      showToast('warning', 'Campo vacío', `El campo ${fieldId.split('_')[0]} es requerido`);
      return false;
    }

    if (rules.minLength && value.length < rules.minLength) {
      field.style.border = "2px solid red";
      showToast('warning', 'Campo inválido', `Mínimo ${rules.minLength} caracteres requeridos`);
      return false;
    }

    if (!rules.allowSpaces) {
      field.value = value.replace(/\s/g, '');
    }

    if (rules.pattern && !rules.pattern.test(value.trim())) {
      field.style.border = "2px solid red";
      showToast('warning', 'Formato inválido', rules.message);
      return false;
    }

    if (rules.strengthChecks) {
      const strengthResult = checkStrength(value, rules.strengthChecks);
      field.style.border = `2px solid ${strengthResult.color}`;

      const strengthMessage = document.getElementById(`${fieldId}_strength`);
      if (strengthMessage) {
        strengthMessage.textContent = `Fortaleza: ${strengthResult.message}`;
        strengthMessage.style.color = strengthResult.color;
      }

      return strengthResult.strength === 100;
    }

    field.style.border = "2px solid #4a90e2";
    return true;
  }

  // Inicialización de campos
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

    // Event listeners
    ['input', 'blur', 'keyup'].forEach(event => {
      field.addEventListener(event, () => validateField(fieldId, field.value));
    });

    // Prevenir espacios
    if (!rules.allowSpaces) {
      field.addEventListener('keydown', e => e.key === ' ' && e.preventDefault());
      field.addEventListener('paste', e => {
        e.preventDefault();
        const text = (e.clipboardData || window.clipboardData).getData('text');
        field.value = text.replace(/\s/g, '');
      });
    }
  });

  // Manejo del formulario
  form.addEventListener('submit', async function(event) {
    event.preventDefault();
    if (isSubmitting) return;

    const isValid = Object.keys(validationRules).every(fieldId =>
      validateField(fieldId, document.getElementById(fieldId).value)
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
        ToastPersonalizado.exito(title, message);
        break;
      case 'error':
        ToastPersonalizado.error(title, message);
        break;
      case 'warning':
        ToastPersonalizado.advertencia(title, message);
        break;
      case 'info':
        ToastPersonalizado.info(title, message);
        break;
    }
  }
</script>

<?php if (!empty($_SESSION['mensaje'])) {
  echo $_SESSION['mensaje'];
  unset($_SESSION['mensaje']);
} ?>

<?php require_once 'views/auth/footer.php'; ?>