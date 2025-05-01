<div class="form-section">
      <h2 class="form-section-title">
        <i class="fas fa-file-invoice"></i>
        COMPROBANTE DE PAGO
      </h2>
      <p class="form-section-subtitle">Foto o Captura de Pantalla</p>

      <div class="upload-section">
        <button class="btn-upload">
          <i class="fas fa-upload"></i>
          Foto/Captura de Pantalla
        </button>
      </div>

      <div class="form-group-custom">
        <label class="required">Titular</label>
        <input type="text" class="form-control-custom" id="titular">
      </div>

      <div class="form-group-custom">
        <label class="required">Referencia de pago (Últimos 4 dígitos)</label>
        <input type="text" class="form-control-custom" id="referencia">
      </div>

      <div class="form-group-custom">
        <label>Método de pago</label>

        <div id="payment-method-dropdown" class="ui fluid selection dropdown" style="display: block !important;">
          <input type="hidden" name="payment_method">
          <i class="dropdown icon"></i>
          <div class="default text">Seleccione método de pago</div>
          <div class="menu" style="display: none;" data-silent="true">
            <div class="item" data-value="zelle">
              <img src="assets/img/payments/zelle.png" alt="Logo Zelle" class="payment-icon">
              <span class="text">Zelle</span>
            </div>
            <div class="item" data-value="paypal">
              <img src="assets/img/payments/paypal.png" alt="Logo Paypal" class="payment-icon">
              <span class="text">Paypal</span>
            </div>
            <div class="item" data-value="banco_venezuela">
              <img src="assets/img/payments/banco_venezuela.png" alt="Logo Banco de Venezuela" class="payment-icon">
              <span class="text">Banco de Venezuela</span>
            </div>
          </div>
        </div>
      </div>
    </div>