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
<div class="form-group-custom" style="margin-bottom: 20px;">
  <label class="required" style="color: #2962ff; font-weight: bold;">Celular</label>

  <div class="phone-group" id="phone-input-group">
    <div id="prefijo-dropdown" class="ui selection dropdown" data-silent="true" style="border: 2px solid #2962ff; border-radius: 5px;">
      <input type="hidden" name="prefijo">
      <div class="text" style="color: #2962ff;">Seleccione prefijo</div>
      <i class="dropdown icon" style="color: #2962ff;"></i>
      <div class="menu">
        <div class="header" style="color: #2962ff;">Venezuela</div>
        <div class="item" data-value="VE +58" style="color: #2962ff;">VE +58</div>

        <div class="header" style="color: #2962ff;">América del Norte</div>
        <div class="item" data-value="US +1" style="color: #2962ff;">US +1</div>
        <div class="item" data-value="MX +52" style="color: #2962ff;">MX +52</div>

        <div class="header" style="color: #2962ff;">América del Sur</div>
        <div class="item" data-value="CO +57" style="color: #2962ff;">CO +57</div>
        <div class="item" data-value="AR +54" style="color: #2962ff;">AR +54</div>
        <div class="item" data-value="PE +51" style="color: #2962ff;">PE +51</div>
        <div class="item" data-value="CL +56" style="color: #2962ff;">CL +56</div>
        <div class="item" data-value="EC +593" style="color: #2962ff;">EC +593</div>
      </div>
    </div>
    <input type="tel" class="form-control-custom" id="telefono" placeholder="0416-3829342" style="border: 2px solid #2962ff; padding: 10px; border-radius: 5px;">
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
 