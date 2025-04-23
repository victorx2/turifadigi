<!-- Sección de Datos Personales y Pagos -->
<section class="team-one">
  <!-- Fondo de la sección -->
  <div class="team-one__bg-box">
    <div class="team-one__bg"></div>
  </div>
  
  <!-- Contenedor principal -->
  <div class="container">
    <!-- Título de la sección -->
    <div class="section-title text-center">
      <div class="section-title__tagline-box">
        <div class="section-title__tagline-shape"></div>
      </div>
      <h2 class="section-title__title">Información de Pago</h2>
    </div>
    
    <!-- Contenido principal -->
    <div class="row">
      <div class="col-xl-12">
        <!-- Sección de Datos Personales -->
        <h4 class="text-start"><i class="fa fa-user" aria-hidden="true"></i> DATOS PERSONALES</h4>
        
        <!-- Sección de Pagos -->
        <div id="sectionAllPayments">
          <h4 class="mt-20 text-start"><i class="fa fa-bank" aria-hidden="true"></i> MODOS DE PAGO</h4>
          
          <!-- Métodos de pago disponibles -->
          <div class="col-lg-12 mb-10">
            <div class="row">
              <div class="input-field col s6 m6">
                <h6 class="text-start">Transferencia o depósito</h6>
              </div>
            </div>
          </div>
          
          <!-- Contenedor de opciones de pago -->
          <div id="container-payments" class="types flex flex-wrap justify-space-between payments-options mb-30">
            <!-- Cada div representa un método de pago con su logo -->
            <div id="2" class="type option-payment selected" onclick="showPaymentDetails(2)">
              <div class="logo">
                <img src="./assets/imgs/26436fd4e0.png" width="86" alt="PAGOMOVIL">
              </div>
            </div>
            <!-- Repetir para cada método de pago... -->
          </div>

          <!-- Detalles del banco seleccionado -->
          <div id="datosBanco" class="text-center input-field col s12 m6">
            <div>
              <h6>
                <span data-toggle="tooltip" data-placement="bottom" title="PAGO MOVIL">PAGO MOVIL</span>
                <span data-toggle="tooltip" data-placement="bottom" title="Cuenta Personal"><i class="help-account fa fa-user" aria-hidden="true"></i></span>
              </h6>
            </div>
            <div class="titularBank">Cuenta a Consultar</div>
            <div class="payment-notes"><b></b></div>
          </div>

          <!-- Calculadora de conversión de moneda -->
          <div class="calculatorContainer">
            <h4>Conversor USD a <strong class="currencyCode">BS</strong></h4>
            <div class="calculatorCon">
              <button id="btnMinusCal" class="btnMinus thm-btn"></button>
              <div>
                <input class="ticketQty" id="ticketQtyID" type="text" name="productQty" value="3" min="3" max="1000">
              </div>
              <button id="btnPlusCal" class="btnPlus thm-btn"></button>
            </div>
            <div class="calculatorRadio">
              <div>
                <label for="BS">BS</label>
                <input type="radio" name="currency" id="BS" value="BS" checked>
              </div>
              <div>
                <label for="COP">COP</label>
                <input type="radio" name="currency" id="COP" value="COP">
              </div>
              <div>
                <label for="CLP">CLP</label>
                <input type="radio" name="currency" id="CLP" value="CLP">
              </div>
            </div>
            <div class="calculatorCurrencies">
              <div class="cal-group">
                <p>USD</p>
                <strong id="montoTotalCal">32.00</strong>
              </div>
              <div class="cal-group">
                <p class="currencyCode">BS</p>
                <strong id="montoTotalCalFormatt">3401.92</strong>
              </div>
            </div>
            <span>Tasa de cambio: 1 USD = </span> <span class="changeRate">106.31</span> <span class="currencyCode">BS</span>
          </div>

          <!-- Total a pagar -->
          <div id="priceConvert">
            <strong>Total: <span id="other">3401.92</span> <span class="currencyCode">BS</span> <small>(<span id="QtyNumberPrice">8</span> boletos)</small></strong>
          </div>
          
          <!-- Mensaje de consulta de tasa -->
          <div id="bottomcontact" class="hidden">
            <strong>CONSULTAR LA TASA DEL DIA</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Estilos CSS para la sección -->
<style>
  /* Estilos para la sección de pagos */
  .types {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
  }
  /* ... (resto de estilos) ... */
</style>

<!-- Scripts JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const btnMinusCal = document.getElementById('btnMinusCal');
    const btnPlusCal = document.getElementById('btnPlusCal');
    const ticketQty = document.getElementById('ticketQtyID');
    const montoTotalCal = document.getElementById('montoTotalCal');
    const montoTotalCalFormatt = document.getElementById('montoTotalCalFormatt');
    const other = document.getElementById('other');
    const QtyNumberPrice = document.getElementById('QtyNumberPrice');
    const currencyRadios = document.querySelectorAll('input[name="currency"]');
    const currencyCode = document.querySelectorAll('.currencyCode');
    const changeRate = document.querySelector('.changeRate');

    // Tasas de cambio
    const rates = {
      'BS': 106.31,
      'COP': 4000,
      'CLP': 900
    };

    let currentCurrency = 'BS';
    const pricePerTicket = 4;

    // Funciones
    function updateCalculations() {
      const qty = parseInt(ticketQty.value);
      const total = qty * pricePerTicket;
      const localTotal = total * rates[currentCurrency];

      montoTotalCal.textContent = total.toFixed(2);
      montoTotalCalFormatt.textContent = localTotal.toFixed(2);
      other.textContent = localTotal.toFixed(2);
      QtyNumberPrice.textContent = qty;
    }

    function updateCurrency(currency) {
      currentCurrency = currency;
      currencyCode.forEach(el => el.textContent = currency);
      changeRate.textContent = rates[currency].toFixed(2);
      updateCalculations();
    }

    // Event Listeners
    btnMinusCal.addEventListener('click', () => {
      const currentValue = parseInt(ticketQty.value);
      if (currentValue > 3) {
        ticketQty.value = currentValue - 1;
        updateCalculations();
      }
    });

    btnPlusCal.addEventListener('click', () => {
      const currentValue = parseInt(ticketQty.value);
      if (currentValue < 1000) {
        ticketQty.value = currentValue + 1;
        updateCalculations();
      }
    });

    ticketQty.addEventListener('change', (e) => {
      let value = parseInt(e.target.value);
      if (value < 3) value = 3;
      if (value > 1000) value = 1000;
      e.target.value = value;
      updateCalculations();
    });

    currencyRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        updateCurrency(e.target.value);
      });
    });

    // Inicialización
    updateCalculations();
  });

  // Función para mostrar detalles de pago
  function showPaymentDetails(paymentId) {
    const options = document.querySelectorAll('.option-payment');
    options.forEach(option => option.classList.remove('selected'));

    const selected = document.getElementById(paymentId);
    selected.classList.add('selected');

    const datosBanco = document.getElementById('datosBanco');
    const paymentTitle = datosBanco.querySelector('h6 span:first-child');

    const paymentMethods = {
      2: 'PAGO MOVIL',
      3: 'ZELLE',
      4: 'ZINLI',
      8: 'BANCOLOMBIA',
      10: 'PAYPAL',
      11: 'BANCOESTADO',
      12: 'NEQUI',
      6: 'TENPO',
      7: 'EFECTIVO',
      9: 'BINANCE'
    };

    paymentTitle.textContent = paymentMethods[paymentId] || 'MÉTODO DE PAGO';
  }
</script>