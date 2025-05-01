<style>
  .location-options {
    margin-bottom: 15px;
    display: flex;
    gap: 40px;
    align-items: center;
    justify-content: center;
  }

  .location-options label {
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

  .location-options label:hover {
    background: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }

  .location-options label.active {
    background: rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
  }

  .location-options label.active .map-icon {
    transform: scale(1.05);
  }

  .map-icon {
    width: 150px;
    height: 100px;
    transition: all 0.3s ease;
    object-fit: contain;
  }

  .location-options input[type="radio"] {
    display: none;
  }

  .location-options label span {
    font-size: 1.2em;
    font-weight: 600;
    color: #333;
    transition: all 0.3s ease;
  }

  .location-options label:hover span,
  .location-options label.active span {
    transform: scale(1.1);
  }

  .ui.search.dropdown {
    width: 100%;
    margin-top: 20px;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(10px);
  }

  .ui.search.dropdown.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .map-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  /* Ajustes específicos para cada mapa */
  .venezuela-map {
    transform: scale(0.9);
  }

  .latinoamerica-map {
    transform: scale(0.8);
  }
</style>

<div class="form-group-custom">
  <label>Ubicación</label>

  <div class="location-options">
    <label id="venezuelaLabel">
      <input type="radio" name="location_type" value="venezuela" checked>
      <img src="assets/img/backgrounds/vzla.jpg" alt="Bandera de Venezuela" class="map-icon">
      <span>Venezuela</span>
    </label>

    <label id="latinoamericaLabel">
      <input type="radio" name="location_type" value="internacional">
      <img src="assets/img/backgrounds/america.png" alt="Mapa de América" class="map-icon">
      <span>Internacional</span>
    </label>
  </div>

  <div id="venezuela-dropdown" class="ui search dropdown">
    <input type="hidden" name="estado_venezuela">
    <div class="default text">Seleccione un estado</div>
    <i class="dropdown icon"></i>
    <div class="menu">
      <div class="item" data-value="AM">Amazonas</div>
      <div class="item" data-value="AN">Anzoátegui</div>
      <div class="item" data-value="AP">Apure</div>
      <div class="item" data-value="AR">Aragua</div>
      <div class="item" data-value="BA">Barinas</div>
      <div class="item" data-value="BO">Bolívar</div>
      <div class="item" data-value="CA">Carabobo</div>
      <div class="item" data-value="CO">Cojedes</div>
      <div class="item" data-value="DA">Delta Amacuro</div>
      <div class="item" data-value="DC">Distrito Capital</div>
      <div class="item" data-value="FA">Falcón</div>
      <div class="item" data-value="GU">Guárico</div>
      <div class="item" data-value="LA">Lara</div>
      <div class="item" data-value="MI">Miranda</div>
      <div class="item" data-value="MO">Monagas</div>
      <div class="item" data-value="ME">Mérida</div>
      <div class="item" data-value="NE">Nueva Esparta</div>
      <div class="item" data-value="PO">Portuguesa</div>
      <div class="item" data-value="SU">Sucre</div>
      <div class="item" data-value="TR">Trujillo</div>
      <div class="item" data-value="TA">Táchira</div>
      <div class="item" data-value="VA">Vargas</div>
      <div class="item" data-value="YA">Yaracuy</div>
      <div class="item" data-value="ZU">Zulia</div>
    </div>
    <input type="text" class="search" placeholder="">
  </div>

  <div id="paises-dropdown" class="ui search dropdown" style="display: none;">
    <input type="hidden" name="pais_internacional">
    <div class="default text">Seleccione un país</div>
    <i class="dropdown icon"></i>
    <div class="menu">
      <div class="header">América del Norte</div>
      <div class="item" data-value="CA">Canadá</div>
      <div class="item" data-value="US">Estados Unidos</div>
      <div class="item" data-value="MX">México</div>

      <div class="header">América Central</div>
      <div class="item" data-value="BZ">Belice</div>
      <div class="item" data-value="CR">Costa Rica</div>
      <div class="item" data-value="SV">El Salvador</div>
      <div class="item" data-value="GT">Guatemala</div>
      <div class="item" data-value="HN">Honduras</div>
      <div class="item" data-value="NI">Nicaragua</div>
      <div class="item" data-value="PA">Panamá</div>

      <div class="header">El Caribe</div>
      <div class="item" data-value="AG">Antigua y Barbuda</div>
      <div class="item" data-value="BS">Bahamas</div>
      <div class="item" data-value="BB">Barbados</div>
      <div class="item" data-value="CU">Cuba</div>
      <div class="item" data-value="DM">Dominica</div>
      <div class="item" data-value="GD">Granada</div>
      <div class="item" data-value="HT">Haití</div>
      <div class="item" data-value="JM">Jamaica</div>
      <div class="item" data-value="DO">República Dominicana</div>
      <div class="item" data-value="KN">San Cristóbal y Nieves</div>
      <div class="item" data-value="LC">Santa Lucía</div>
      <div class="item" data-value="VC">San Vicente y las Granadinas</div>
      <div class="item" data-value="TT">Trinidad y Tobago</div>

      <div class="header">América del Sur</div>
      <div class="item" data-value="AR">Argentina</div>
      <div class="item" data-value="BO">Bolivia</div>
      <div class="item" data-value="BR">Brasil</div>
      <div class="item" data-value="CL">Chile</div>
      <div class="item" data-value="CO">Colombia</div>
      <div class="item" data-value="EC">Ecuador</div>
      <div class="item" data-value="GY">Guyana</div>
      <div class="item" data-value="PY">Paraguay</div>
      <div class="item" data-value="PE">Perú</div>
      <div class="item" data-value="SR">Surinam</div>
      <div class="item" data-value="UY">Uruguay</div>
      <div class="item" data-value="VE">Venezuela</div>
    </div>
    <input type="text" class="search" placeholder="">
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const locationRadios = document.querySelectorAll('input[name="location_type"]');
    const venezuelaDropdown = document.getElementById('venezuela-dropdown');
    const paisesDropdown = document.getElementById('paises-dropdown');
    const venezuelaLabel = document.getElementById('venezuelaLabel');
    const latinoamericaLabel = document.getElementById('latinoamericaLabel');

    // Inicializar los dropdowns de Semantic UI
    $('.ui.dropdown').dropdown();

    // Función para manejar el cambio de radio button
    function handleLocationChange(e) {
      // Remover clase active de todos los labels
      venezuelaLabel.classList.remove('active');
      latinoamericaLabel.classList.remove('active');
      venezuelaDropdown.classList.remove('visible');
      paisesDropdown.classList.remove('visible');

      if (e.target.value === 'venezuela') {
        venezuelaDropdown.style.display = 'block';
        paisesDropdown.style.display = 'none';
        venezuelaLabel.classList.add('active');
        setTimeout(() => venezuelaDropdown.classList.add('visible'), 50);
      } else {
        venezuelaDropdown.style.display = 'none';
        paisesDropdown.style.display = 'block';
        latinoamericaLabel.classList.add('active');
        setTimeout(() => paisesDropdown.classList.add('visible'), 50);
      }
    }

    // Agregar el evento a cada radio button
    locationRadios.forEach(radio => {
      radio.addEventListener('change', handleLocationChange);
    });

    // Establecer el estado inicial
    const initialSelection = document.querySelector('input[name="location_type"]:checked');
    if (initialSelection) {
      handleLocationChange({
        target: initialSelection
      });
      setTimeout(() => venezuelaDropdown.classList.add('visible'), 50);
    }
  });
</script>