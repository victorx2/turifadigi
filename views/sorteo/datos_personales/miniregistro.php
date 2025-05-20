<div class="form-section">
    <h2 class="form-section-title">
        <i class="fas fa-file-invoice"></i>
        INGRESE SUS DATOS
    </h2>
    <div class="form-group-custom">
        <label class="required">Nombre</label>
        <input type="text" class="form-control-custom" id="nombre" name="nombre" placeholder="Nombre" required>
    </div>

    <div class="form-group-custom">
        <label class="required">Apellido</label>
        <input type="text" class="form-control-custom" id="apellido" name="apellido" placeholder="Apellido" required>
    </div>

    <div class="form-group-custom">
        <label class="required">Número de Teléfono</label>
        <div style="display: flex; gap: 8px;">
            <select class="form-control-custom" id="prefijo_pais" name="prefijo_pais" required style="max-width: 120px;">
                <option value="">País</option>
                <option value="+1">Estados Unidos (+1)</option>
                <option value="+1">Canadá (+1)</option>
                <option value="+52">México (+52)</option>
                <option value="+55">Brasil (+55)</option>
                <option value="+54">Argentina (+54)</option>
                <option value="+57">Colombia (+57)</option>
                <option value="+56">Chile (+56)</option>
                <option value="+58">Venezuela (+58)</option>
                <option value="+51">Perú (+51)</option>
                <option value="+593">Ecuador (+593)</option>
                <option value="+53">Cuba (+53)</option>
                <option value="+591">Bolivia (+591)</option>
                <option value="+506">Costa Rica (+506)</option>
                <option value="+507">Panamá (+507)</option>
                <option value="+598">Uruguay (+598)</option>
            </select>
            <input type="tel" class="form-control-custom" id="telefono" name="telefono" placeholder="Número" required pattern="[0-9]{6,15}">
        </div>
    </div>

    <div class="form-group-custom">
        <label class="required">Titular del pago (Telefono del titular del pago, si es Pago Movil)</label>
        <input type="text" class="form-control-custom" id="titular" placeholder="Nombre Apellido (o telefono)">
    </div>

    <div class="form-group-custom">
        <label class="required">Referencia del pago</label>
        <input type="text" class="form-control-custom" id="referencia" placeholder="123456">
    </div>

    <div class="form-group-custom">
        <label class="required">Monto Pagado</label>
        <input type="text" class="form-control-custom" id="monto_pagado" placeholder="0.00">
    </div>

    <div class="form-group-custom">
        <label>Método de pago</label>

        <select name="phone " id=""></select>

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