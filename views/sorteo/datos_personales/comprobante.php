<div class="form-section">
  <h2 class="form-section-title">
    <i class="fas fa-file-invoice"></i>
    COMPROBANTE DE PAGO
  </h2>
  <div class="form-group-custom">
    <label class="required">Titular</label>
    <input type="text" class="form-control-custom" id="titular">
  </div>

  <div class="form-group-custom">
    <label class="required">Referencia de pago (Últimos 4 dígitos)</label>
    <input type="text" class="form-control-custom" id="referencia">
  </div>

  <div class="form-group-custom">
    <label class="required">Monto Pagado</label>
    <input type="text" class="form-control-custom" id="monto_pagado">
  </div>

  <div class="form-group-custom">
    <label>Método de pago</label>

    <div id="payment-method-dropdown" class="ui fluid selection dropdown" style="display: block !important;">
      <input type="hidden" name="payment_method">
      <i class="dropdown icon"></i>
      <div class="default text">Seleccione método de pago</div>
      <div class="menu" style="display: none;" data-silent="true">
        <div class="item" data-value="pago_movil">
          <img src="assets/img/svg/pago_movil.svg" alt="Logo Pago Movil" class="payment-icon">
          <span class="text">Pago Movil</span>
        </div>
        <div class="item" data-value="zelle">
          <img src="assets/img/svg/zelle.svg" alt="Logo Zelle" class="payment-icon">
          <span class="text">Zelle</span>
        </div>
        <div class="item" data-value="davivienda">
          <img src="assets/img/svg/davivienda.svg" alt="Logo Davivienda" class="payment-icon">
          <span class="text">Davivienda</span>
        </div>
        <div class="item" data-value="paypal">
          <img src="assets/img/svg/paypal.svg" alt="Logo Paypal" class="payment-icon">
          <span class="text">Paypal</span>
        </div>
        <div class="item" data-value="banco_venezuela">
          <img src="assets/img/svg/banco_venezuela.svg" alt="Logo Banco de Venezuela" class="payment-icon">
          <span class="text">Banco de Venezuela</span>
        </div>
        <div class="item" data-value="bancolombia">
          <img src="assets/img/svg/bancolombia.svg" alt="Logo Bancolombia" class="payment-icon">
          <span class="text">Bancolombia</span>
        </div>
      </div>
    </div>
  </div>
</div>