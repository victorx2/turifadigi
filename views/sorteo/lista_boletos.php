<link rel="stylesheet" href="assets/css/boletos.css">

<?php require_once 'views/sorteo/main_slider.php'; ?>

<?php require_once 'premio.php'; ?>

<div class="container-fluid">
  <div class="text-center">
    <h1 class="lista-title">LISTA DE BOLETOS</h1>

    <div class="contador-boletos">
      <button class="btn-circle">-</button>
      <span class="numero-boletos">3</span>
      <button class="btn-circle">+</button>
      <div class="total">Total: <span id="totalUSD">12 USD</span></div>
    </div>

    <div class="buscar-container">
      <button class="btn-buscar">BUSCAR</button>
    </div>

    <div class="elegir-title">★ ELEGIR A LA SUERTE ★</div>

    <div class="boletos-grid" id="boletosList">
      <!-- Los boletos se generarán dinámicamente aquí -->
    </div>

    <div class="seleccionados-container">
      <span class="seleccionados-text">SELECCIONADOS</span>
      <div class="contador">0 de 3</div>
      <button class="btn-continuar">CONTINUAR</button>
    </div>
  </div>

  <div class="datos-personales" id="datosPersonales" style="display: none;">
    <h2 class="section-title">DATOS PERSONALES</h2>
    <form id="formularioDatos">
      <div class="form-group">
        <label>Nombres y Apellidos *</label>
        <input type="text" class="form-control" id="nombre" required>
      </div>

      <div class="form-group">
        <label>Cédula *</label>
        <input type="text" class="form-control" id="cedula" required>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Celular *</label>
          <select class="form-control" id="prefijo">
            <option value="VE +58">VE +58</option>
          </select>
        </div>
        <div class="form-group col-md-8">
          <label>&nbsp;</label>
          <input type="tel" class="form-control" id="telefono" required>
        </div>
      </div>

      <div class="form-group">
        <label>Ubicación</label>
        <select class="form-control" id="ubicacion">
          <option value="Tachira">Tachira</option>
        </select>
      </div>
    </form>

    <div class="metodos-pago">
      <h2 class="section-title">MODOS DE PAGO</h2>
      <p class="subtitle">Transferencia o depósito</p>

      <div class="payment-methods">
        <div class="payment-method active">
          <img src="assets/img/pago-movil.png" alt="Pago Móvil">
        </div>
        <!-- Agregar más métodos de pago aquí -->
      </div>

      <div class="cuenta-info">
        <p>PAGO MOVIL</p>
        <p>Cuenta a Consultar</p>
      </div>

      <div class="conversor">
        <h3>Conversor USD a BS</h3>
        <div class="conversor-controls">
          <button class="btn-circle">-</button>
          <input type="text" value="3" readonly>
          <button class="btn-circle">+</button>
        </div>

        <div class="currency-options">
          <label><input type="radio" name="currency" value="BS" checked> BS</label>
          <label><input type="radio" name="currency" value="COP"> COP</label>
          <label><input type="radio" name="currency" value="CLP"> CLP</label>
        </div>

        <div class="conversion-result">
          <div class="amount">
            <span>USD</span>
            <span id="usdAmount">12.00</span>
          </div>
          <div class="amount">
            <span>BS</span>
            <span id="bsAmount">1275.72</span>
          </div>
        </div>
        <p class="exchange-rate">Tasa de cambio: 1 USD = 106.31 BS</p>
      </div>
    </div>

    <div class="comprobante">
      <h2 class="section-title">COMPROBANTE DE PAGO</h2>
      <p class="subtitle">Foto o Captura de Pantalla</p>

      <div class="upload-container">
        <button class="btn-upload">
          <i class="fas fa-upload"></i>
          Foto/Captura de Pantalla
        </button>
      </div>

      <div class="form-group">
        <label>Titular *</label>
        <input type="text" class="form-control" id="titular" required>
      </div>

      <div class="form-group">
        <label>Referencia de pago (Últimos 4 dígitos) *</label>
        <input type="text" class="form-control" id="referencia" required>
      </div>

      <div class="form-group">
        <label>Método de pago</label>
        <select class="form-control" id="metodoPago">
          <option value="Banco de venezuela">Banco de venezuela</option>
        </select>
      </div>

      <div class="terms">
        <p>Al confirmar autorizo el uso de <a href="#">Mis Datos Personales</a></p>
      </div>

      <button type="submit" class="btn-confirmar">CONFIRMAR</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const boletosSeleccionados = new Set();
    const maxBoletos = 3;
    const tasaUSD = 106.31;
    let precioUnitarioUSD = 4;

    // Generar boletos
    const boletosList = document.getElementById('boletosList');

    // Generar números de boletos
    for (let i = 1; i <= 500; i++) {
      const numero = i.toString().padStart(4, '0');
      const boleto = document.createElement('div');
      boleto.className = 'boleto';
      boleto.textContent = numero;
      boleto.onclick = function() {
        if (this.classList.contains('selected')) {
          this.classList.remove('selected');
          boletosSeleccionados.delete(numero);
          actualizarContador();
          actualizarTotal();
        } else {
          if (boletosSeleccionados.size >= maxBoletos) {
            alert('No puede seleccionar más de 3 boletos');
            return;
          }
          this.classList.add('selected');
          boletosSeleccionados.add(numero);
          actualizarContador();
          actualizarTotal();
        }
      };
      boletosList.appendChild(boleto);
    }

    function actualizarContador() {
      const contador = document.querySelector('.contador');
      contador.textContent = `${boletosSeleccionados.size} de ${maxBoletos}`;
    }

    function actualizarTotal() {
      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      const usdAmount = document.getElementById('usdAmount');
      const bsAmount = document.getElementById('bsAmount');

      usdAmount.textContent = totalUSD.toFixed(2);
      bsAmount.textContent = totalBS.toFixed(2);
    }

    // Verificar disponibilidad de boletos seleccionados
    async function verificarBoletosSeleccionados() {
      const boletosArray = Array.from(boletosSeleccionados);
      console.log('Boletos seleccionados para verificar:', boletosArray);

      try {
        const response = await fetch('/TuRifadigi/verificarDisponibilidad', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Cache-Control': 'no-cache'
          },
          body: JSON.stringify({
            boletos: boletosArray
          })
        });

        if (!response.ok) {
          throw new Error(`Error HTTP: ${response.status}`);
        }

        const responseText = await response.text();

        if (!responseText.trim()) {
          throw new Error('Respuesta vacía del servidor');
        }

        const data = JSON.parse(responseText);

        if (!data.disponibles || !Array.isArray(data.disponibles)) {
          throw new Error('Formato de respuesta inválido');
        }

        const boletosNoDisponibles = data.disponibles.filter(b => !b.disponible).map(b => b.numero);

        if (boletosNoDisponibles.length > 0) {
          alert(`Los siguientes boletos no están disponibles: ${boletosNoDisponibles.join(', ')}`);
          return false;
        }

        return true;
      } catch (error) {
        console.error('Error en verificación:', error);
        alert('Error al verificar la disponibilidad de los boletos: ' + error.message);
        return false;
      }
    }

    // Continuar con el proceso
    document.querySelector('.btn-continuar').onclick = function() {
      if (boletosSeleccionados.size === 0) {
        alert('Por favor seleccione al menos un boleto');
        return;
      }

      document.getElementById('datosPersonales').style.display = 'block';
      this.parentElement.style.display = 'none';
    };

    // Manejar el envío del formulario
    document.querySelector('.btn-confirmar').onclick = async function(e) {
      e.preventDefault();

      // Validar campos requeridos
      const nombre = document.getElementById('nombre').value.trim();
      const cedula = document.getElementById('cedula').value.trim();
      const telefono = document.getElementById('telefono').value.trim();
      const ubicacion = document.getElementById('ubicacion').value.trim();
      const titular = document.getElementById('titular').value.trim();
      const referencia = document.getElementById('referencia').value.trim();
      const metodoPago = document.getElementById('metodoPago').value;

      if (!nombre || !cedula || !telefono || !ubicacion || !titular || !referencia) {
        alert('Por favor complete todos los campos requeridos');
        return;
      }

      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      try {
        // Primero procesamos la compra
        const datosCompra = {
          boletos: Array.from(boletosSeleccionados),
          nombre: nombre,
          cedula: cedula,
          telefono: telefono,
          ubicacion: ubicacion,
          total: totalBS,
          titular: titular,
          referencia: referencia,
          metodo_pago: metodoPago
        };

        const responseCompra = await fetch('/TuRifadigi/procesarCompra', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(datosCompra)
        });

        const dataCompra = await responseCompra.json();

        if (dataCompra.success) {
          // Después de procesar la compra, verificamos la disponibilidad
          const responseVerificacion = await fetch('/TuRifadigi/verificarDisponibilidad', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              boletos: Array.from(boletosSeleccionados)
            })
          });

          const dataVerificacion = await responseVerificacion.json();
          const boletosNoDisponibles = dataVerificacion.disponibles.filter(b => !b.disponible).map(b => b.numero);

          if (boletosNoDisponibles.length > 0) {
            alert(`Los siguientes boletos ya no están disponibles: ${boletosNoDisponibles.join(', ')}`);
            return;
          }

          alert('¡Compra procesada correctamente!');
          window.location.reload();
        } else {
          alert(dataCompra.error || 'Error al procesar la compra');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud');
      }
    };

    // Conversor de moneda
    document.querySelectorAll('.conversor-controls .btn-circle').forEach(btn => {
      btn.onclick = function() {
        const input = this.parentElement.querySelector('input');
        const valor = parseInt(input.value);
        if (this.textContent === '+' && valor < maxBoletos) {
          input.value = valor + 1;
        } else if (this.textContent === '-' && valor > 1) {
          input.value = valor - 1;
        }
        actualizarTotal();
      };
    });

    // Subir comprobante
    document.querySelector('.btn-upload').onclick = function() {
      const input = document.createElement('input');
      input.type = 'file';
      input.accept = 'image/*';
      input.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
          console.log('Imagen seleccionada:', file.name);
        }
      };
      input.click();
    };
  });
</script>