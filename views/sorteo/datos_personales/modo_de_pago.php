<div class="payment-section">
  <div class="payment-title">
    <i class="fas fa-money-bill"></i>
    METODO DE PAGO
  </div>
  <div class="payment-subtitle">Transferencia o depósito</div>

  <div class="payment-methods">
    <div class="payment-method" onclick="mostrarDatosDePago('pago_movil')">
      <img src="assets/img/webp/pago_movil.webp" alt="pago movil">
    </div>
    <div class="payment-method" onclick="mostrarDatosDePago('zelle')">
      <img src="assets/img/webp/zelle.webp" alt="zelle">
    </div>
    <div class="payment-method" onclick="mostrarDatosDePago('davivienda')">
      <img src="assets/img/webp/davivienda.webp" alt="davivienda">
    </div>
    <div class="payment-method" onclick="mostrarDatosDePago('paypal')">
      <img src="assets/img/webp/paypal.webp" alt="paypal">
    </div>
    <div class="payment-method" onclick="mostrarDatosDePago('banco_venezuela')">
      <img src="assets/img/webp/banco_venezuela.webp" alt="banco_de_Venezuela">
    </div>
    <div class="payment-method" onclick="mostrarDatosDePago('bancolombia')">
      <img src="assets/img/webp/bancolombia.webp" alt="bancolombia">
    </div>
  </div>

  <div class="payment-info">
    <p id="paymentTitle"></p>
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

<script>
  function mostrarDatosDePago(metodo) {
    const paymentTitle = document.getElementById('paymentTitle');
    const paymentDetails = document.getElementById('paymentDetails');
    switch (metodo) {
      case 'zelle':
        paymentTitle.textContent = 'ZELLE';
        paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Número de teléfono: +1 4074287580</p>
          `;
        break;

      case 'paypal':
        paymentTitle.textContent = 'PAYPAL';
        paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Nombre: Yorsin Cruz Osorio</p>
            <p>Correo Electrónico: Yorsincruz1995@gmail.com</p>
            <p>Usuario: @Yorsin0506</p>
            <p>Número teléfono: +1 4074287580</p>
          `;
        break;

      case 'banco_venezuela':
        paymentTitle.textContent = 'BANCO DE VENEZUELA';
        paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Nombre: Yorsin Cruz Osorio</p>
            <p>Cédula de identidad: 28517267</p>
            <p>numero de cuenta: 01021234567891234567</p>
          `;
        break

      case 'davivienda':
        paymentTitle.textContent = 'DAVIVIENDA COLOMBIA';
        paymentDetails.innerHTML = `
            <p class="subtitle">Datos de la cuenta</p>
            <p>Cédula de identidad: 123456789</p>
            <p>numero de cuenta: 4884 5018 1679</p>

          `;
        break;

      case 'pago_movil':
        paymentTitle.textContent = 'PAGO MOVIL';
        paymentDetails.innerHTML = `
              <p class="subtitle">Datos de la cuenta</p>
              <p>Número de teléfono: 04124124923</p>
              <p>Cédula de identidad: 28517267</p>
              <p>Banco: 0102 - Banco de Venezuela</p>  
            `;
        break;
      case 'bancolombia':
        paymentTitle.textContent = 'BANCOLOMBIA';
        paymentDetails.innerHTML = `
              <p class="subtitle">Datos de la cuenta</p>
              <p>Cédula de identidad: 28517267</p>
              <p>numero de cuenta: 123456789</p>
              `;
        break;
      default:
        paymentTitle.textContent = 'Seleccione un método de pago';
        paymentDetails.innerHTML = '';
        break;
    }
  }
</script>