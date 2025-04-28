<link rel="stylesheet" href="assets/css/boletos.css">
<link rel="stylesheet" href="assets/css/chip_alzar.css">

<?php require_once 'views/sorteo/main_slider.php'; ?>
<?php require_once 'premio.php'; ?>

<div class="container-fluid">
  <div class="text-center">
    <h1 class="lista-title">LISTA DE BOLETOS</h1>

    <div class="elegir-title">
      <button id="btnRandomNumber" class="magic-button">
        <i class="fa fa-star"></i>
        <span>ELEGIR A LA SUERTE</span>
        <i class="fa fa-star"></i>
      </button>
    </div>

    <div class="contador-boletos">
      <button class="btn-circle">-</button>
      <span class="numero-boletos">3</span>
      <button class="btn-circle">+</button>
      <div class="total">Total: <span id="totalUSD">12 USD</span></div>
    </div>

    <div class="buscar-container">
      <input type="text" id="buscador" class="form-control" placeholder="Buscar boleto (ej: 001, 0020...)">
      <button class="btn-buscar">BUSCAR</button>
    </div>

    <div class="boletos-grid" id="boletosList">
      <!-- Los boletos se generarán dinámicamente aquí -->
    </div>

    <div class="seleccionados-container">
      <span class="seleccionados-text">SELECCIONADOS</span>
      <div class="contador">0 de 3</div>
      <div class="boletos-seleccionados-chips"></div>
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


<link rel="stylesheet" href="assets/css/buscar_boletos.css">


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const boletosSeleccionados = new Set();
    const minBoletos = 2;
    let cantidadSeleccion = 3; // Cantidad inicial de boletos
    const tasaUSD = 106.31;
    let precioUnitarioUSD = 3;

    // Referencias a elementos del DOM
    const boletosList = document.getElementById('boletosList');
    const buscador = document.getElementById('buscador');
    const btnRandomNumber = document.getElementById('btnRandomNumber');
    const numeroBoletosSpan = document.querySelector('.numero-boletos');
    const totalUSDSpan = document.getElementById('totalUSD');
    const btnMenos = document.querySelector('.btn-circle:first-of-type');
    const btnMas = document.querySelector('.btn-circle:last-of-type');
    const todosLosBoletos = [];

    // Función para actualizar el total en USD
    function actualizarTotal() {
      const total = cantidadSeleccion * precioUnitarioUSD;
      totalUSDSpan.textContent = `${total} USD`;
    }

    // Manejadores para los botones + y -
    btnMenos.addEventListener('click', () => {
      if (cantidadSeleccion > minBoletos) {
        cantidadSeleccion--;
        numeroBoletosSpan.textContent = cantidadSeleccion;
        actualizarTotal();
      }
    });

    btnMas.addEventListener('click', () => {
      if (cantidadSeleccion < 500) { // Cambiado a 500 boletos máximo
        cantidadSeleccion++;
        numeroBoletosSpan.textContent = cantidadSeleccion;
        actualizarTotal();
      }
    });

    // Generar números de boletos
    for (let i = 1; i <= 500; i++) {
      const numero = i.toString().padStart(4, '0');
      const boleto = document.createElement('div');
      boleto.className = 'boleto';
      boleto.textContent = numero;
      boleto.dataset.numero = numero;
      boleto.onclick = function() {
        toggleBoleto(this, numero);
      };
      boletosList.appendChild(boleto);
      todosLosBoletos.push(boleto);
    }

    // Función para actualizar los chips de boletos seleccionados
    function actualizarChipsBoletos() {
      const contenedor = document.querySelector('.boletos-seleccionados-chips');
      contenedor.innerHTML = '';

      Array.from(boletosSeleccionados).sort().forEach(numero => {
        const chip = document.createElement('div');
        chip.className = 'boleto-chip';
        chip.textContent = numero;
        chip.onclick = function() {
          const boleto = document.querySelector(`.boleto[data-numero="${numero}"]`);
          if (boleto) {
            toggleBoleto(boleto, numero);
          }
        };
        contenedor.appendChild(chip);
      });
    }

    // Función para alternar selección de boleto
    function toggleBoleto(elemento, numero) {
      if (elemento.classList.contains('selected')) {
        if (boletosSeleccionados.size <= minBoletos) {
          alert('Debe seleccionar al menos 2 boletos');
          return;
        }
        elemento.classList.remove('selected');
        boletosSeleccionados.delete(numero);
      } else {
        elemento.classList.add('selected');
        boletosSeleccionados.add(numero);
      }
      actualizarContador();
      actualizarTotal();
      actualizarChipsBoletos(); // Actualizar los chips cuando se selecciona/deselecciona
    }

    // Función para elegir boletos al azar
    function elegirBoletosAlAzar() {
      boletosSeleccionados.clear();
      document.querySelectorAll('.boleto.selected').forEach(b => b.classList.remove('selected'));
      document.querySelector('.boletos-seleccionados-chips').innerHTML = ''; // Limpiar chips

      const boletosDisponibles = Array.from(todosLosBoletos).filter(b => !b.classList.contains('disabled'));

      if (boletosDisponibles.length < cantidadSeleccion) {
        alert('No hay suficientes boletos disponibles');
        return;
      }

      for (let i = 0; i < cantidadSeleccion; i++) {
        let indiceAleatorio;
        let boletoSeleccionado;

        do {
          indiceAleatorio = Math.floor(Math.random() * boletosDisponibles.length);
          boletoSeleccionado = boletosDisponibles[indiceAleatorio];
        } while (boletosSeleccionados.has(boletoSeleccionado.dataset.numero));

        setTimeout(() => {
          boletoSeleccionado.classList.add('selected');
          boletosSeleccionados.add(boletoSeleccionado.dataset.numero);
          actualizarContadorSeleccionados();
          actualizarChipsBoletos(); // Actualizar chips con retraso
        }, i * 200);

        boletosDisponibles.splice(indiceAleatorio, 1);
      }
    }

    // Actualizar el contador de seleccionados
    function actualizarContadorSeleccionados() {
      const contadorElement = document.querySelector('.contador');
      contadorElement.textContent = `${boletosSeleccionados.size} de ${cantidadSeleccion}`;
    }

    // Evento para el botón de elegir a la suerte
    btnRandomNumber.addEventListener('click', elegirBoletosAlAzar);

    // Función de búsqueda en tiempo real
    function filtrarBoletos(busqueda) {
      busqueda = busqueda.trim();

      todosLosBoletos.forEach(boleto => {
        const numeroBoleto = boleto.dataset.numero;
        if (busqueda === '') {
          // Si no hay búsqueda, mostrar todos
          boleto.style.display = '';
          boleto.style.order = ''; // Restaurar orden original
        } else if (numeroBoleto.startsWith(busqueda)) {
          // Si el número coincide con la búsqueda, mostrar
          boleto.style.display = '';
          boleto.style.order = '1'; // Mover al principio
        } else {
          // Si no coincide, ocultar
          boleto.style.display = 'none';
          boleto.style.order = '2';
        }
      });
    }

    // Evento de entrada en el buscador (tiempo real)
    buscador.addEventListener('input', function(e) {
      filtrarBoletos(e.target.value);
    });

    // Evento del botón buscar
    document.querySelector('.btn-buscar').onclick = function() {
      filtrarBoletos(buscador.value);
    };

    function actualizarContador() {
      const contador = document.querySelector('.contador');
      contador.textContent = `${boletosSeleccionados.size} boletos`;
    }

    function actualizarTotal() {
      const totalUSD = boletosSeleccionados.size * precioUnitarioUSD;
      const totalBS = totalUSD * tasaUSD;

      const usdAmount = document.getElementById('usdAmount');
      const bsAmount = document.getElementById('bsAmount');
      const totalUSDDisplay = document.getElementById('totalUSD');

      usdAmount.textContent = totalUSD.toFixed(2);
      bsAmount.textContent = totalBS.toFixed(2);
      totalUSDDisplay.textContent = totalUSD.toFixed(2) + ' USD';
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
      if (boletosSeleccionados.size < minBoletos) {
        alert('Debe seleccionar al menos 2 boletos');
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
        if (this.textContent === '+' && valor < 500) {
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