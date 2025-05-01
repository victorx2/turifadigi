<style>
  .phone-options {
    margin-bottom: 15px;
    display: flex;
    gap: 40px;
    align-items: center;
    justify-content: center;
  }

  .phone-options label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    cursor: pointer;
    padding: 20px;
    border-radius: 10px;
    transition: all 0.3s ease;
    position: relative;
    min-width: 150px;
  }

  .phone-options label:hover {
    background: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }

  .phone-options label.active {
    background: rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
  }

  .phone-group {
    display: flex;
    gap: 10px;
    align-items: stretch;
    margin-top: 20px;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(10px);
  }

  .phone-group.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .phone-group .ui.dropdown {
    min-height: 45px;
    width: 140px !important;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    padding: 0 15px;
    background: white;
    margin: 0;
  }

  .phone-group input[type="tel"] {
    height: 45px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 0 15px;
    font-size: 14px;
    color: #333;
    flex: 1;
    min-width: 0;
  }
</style>

<div class="form-group-custom">
  <label class="required">Celular</label>

  <div class="phone-group" id="phone-input-group">
    <div id="prefijo-dropdown" class="ui selection dropdown" data-silent="true">
      <input type="hidden" name="prefijo">
      <div class="text">Seleccione prefijo</div>
      <i class="dropdown icon"></i>
      <div class="menu">
        <div class="header">Venezuela</div>
        <div class="item" data-value="VE +58">VE +58</div>

        <div class="header">América del Norte</div>
        <div class="item" data-value="US +1">US +1</div>
        <div class="item" data-value="MX +52">MX +52</div>

        <div class="header">América del Sur</div>
        <div class="item" data-value="CO +57">CO +57</div>
        <div class="item" data-value="AR +54">AR +54</div>
        <div class="item" data-value="PE +51">PE +51</div>
        <div class="item" data-value="CL +56">CL +56</div>
        <div class="item" data-value="EC +593">EC +593</div>
      </div>
    </div>
    <input type="tel" class="form-control-custom" id="telefono" placeholder="0416-3829342">
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const phoneGroup = document.getElementById('phone-input-group');

    // Inicializar el dropdown con configuración optimizada
    $('#prefijo-dropdown').dropdown({
      onChange: function(value, text, $selectedItem) {
        // Aquí puedes agregar lógica adicional cuando cambie el prefijo
      },
      transition: 'none',
      duration: 0,
      animation: 'none',
      allowReselection: true,
      forceSelection: false,
      direction: 'auto',
      keepOnScreen: true
    });

    // Mostrar el grupo de teléfono con animación
    setTimeout(() => {
      phoneGroup.classList.add('visible');
    }, 50);
  });
</script>

<!-- <div class="form-group-custom">
  <label class="required">Celular</label>
  <div class="phone-group" style="display: flex; gap: 10px; align-items: center;">
    <div id="prefijo-dropdown" class="ui search dropdown">
      <input type="hidden" name="prefijo">
      <div class="default text">Seleccione prefijo</div>
      <i class="dropdown icon"></i>
      <div class="menu">
        <div class="item" data-value="VE +58">VE +58</div>
        <div class="item" data-value="US +1">US +1</div>
        <div class="item" data-value="MX +52">MX +52</div>
        <div class="item" data-value="CO +57">CO +57</div>
        <div class="item" data-value="ES +34">ES +34</div>
        <div class="item" data-value="AR +54">AR +54</div>
        <div class="item" data-value="PE +51">PE +51</div>
        <div class="item" data-value="CL +56">CL +56</div>
        <div class="item" data-value="EC +593">EC +593</div>
        <div class="item" data-value="DO +1">DO +1</div>
        <div class="item" data-value="CA +1">CA +1</div>
        <div class="item" data-value="BZ +501">BZ +501</div>
        <div class="item" data-value="CR +506">CR +506</div>
        <div class="item" data-value="SV +503">SV +503</div>
        <div class="item" data-value="GT +502">GT +502</div>
        <div class="item" data-value="HN +504">HN +504</div>
        <div class="item" data-value="NI +505">NI +505</div>
        <div class="item" data-value="PA +507">PA +507</div>
        <div class="item" data-value="AG +1">AG +1</div>
        <div class="item" data-value="BS +1">BS +1</div>
        <div class="item" data-value="BB +1">BB +1</div>
        <div class="item" data-value="CU +53">CU +53</div>
        <div class="item" data-value="DM +1">DM +1</div>
        <div class="item" data-value="GD +1">GD +1</div>
        <div class="item" data-value="HT +509">HT +509</div>
        <div class="item" data-value="JM +1">JM +1</div>
        <div class="item" data-value="KN +1">KN +1</div>
        <div class="item" data-value="LC +1">LC +1</div>
        <div class="item" data-value="VC +1">VC +1</div>
        <div class="item" data-value="TT +1">TT +1</div>
        <div class="item" data-value="BO +591">BO +591</div>
        <div class="item" data-value="BR +55">BR +55</div>
        <div class="item" data-value="GY +592">GY +592</div>
        <div class="item" data-value="PY +595">PY +595</div>
        <div class="item" data-value="SR +597">SR +597</div>
        <div class="item" data-value="UY +598">UY +598</div>
      </div>
      <input type="text" class="search" placeholder="">
    </div>
    <input type="tel" class="form-control-custom" id="telefono" placeholder="0416-3829342" style="width: 700px;" maxlength="11">
  </div>
</div> -->