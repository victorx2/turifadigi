<div class="payment-section">
  <div class="payment-title">
    <i class="fas fa-money-bill"></i>
    MODOS DE PAGO
  </div>
  <div class="payment-subtitle">Transferencia o depósito</div>

  <div class="payment-methods">
    <div class="payment-method active" onclick="mostrarDatosPago('pagoMovil')">
      <img src="assets/img/backgrounds/pagomovilmini.png" alt="Pago Móvil">
    </div>
    <div class="payment-method" onclick="mostrarDatosPago('zelle')">
      <img src="assets/img/backgrounds/zellemini.png" alt="Zelle">
    </div>
    <div class="payment-method" onclick="mostrarDatosPago('nesqui')">
      <img src="assets/img/backgrounds/nesquimini.png" alt="Nesqui">
    </div>
    <div class="payment-method" onclick="mostrarDatosPago('paypal')">
      <img src="assets/img/backgrounds/paypalmini.webp" alt="Paypal">
    </div>
    <div class="payment-method" onclick="mostrarDatosPago('venezuela')">
      <img src="assets/img/backgrounds/vzlamini.png" alt="Banco de Venezuela">
    </div>
    <div class="payment-method" onclick="mostrarDatosPago('colombia')">
      <img src="assets/img/backgrounds/bancocolombia.png" alt="Colombia">
    </div>
  </div>

  <div class="payment-info">
    <p id="paymentTitle">PAGO MÓVIL</p>
    <div id="paymentDetails">
      <!-- Los detalles se cargarán dinámicamente -->
    </div>
  </div>

  <div class="converter-container">
    <h3 class="text-center">Conversor USD a BS</h3>
    <div class="converter-controls">
      <button class="btn-circle-custom">-</button>
      <input type="text" value="1" readonly>
      <button class="btn-circle-custom">+</button>
    </div>

    <div class="currency-options">
      <label class="currency-option">
        <input type="radio" name="currency" value="BS" checked> BS
      </label>
      <label class="currency-option">
        <input type="radio" name="currency" value="COP"> COP
      </label>
    </div>

    <div class="conversion-result">
      <div class="amount">
        <span>USD</span>
        <span>40.00</span>
      </div>
      <div class="amount">
        <span>BS</span>
        <span>4252.40</span>
      </div>
    </div>
    <p class="exchange-rate">Tasa de cambio: 1 USD = 106.31 BS</p>
  </div>
</div>