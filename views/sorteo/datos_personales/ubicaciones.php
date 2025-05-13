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

  /* Estilos para los selects personalizados */
  .select-container {
    width: 100%;
    margin-top: 20px;
    position: relative;
  }

  .select-custom {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: white;
    cursor: pointer;
  }

  .custom-dropdown {
    position: relative;
    width: 100%;
  }

  .dropdown-input {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: white;
    cursor: pointer;
  }

  .dropdown-input:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
  }

  .dropdown-options {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 2px solid #ddd;
    border-radius: 8px;
    margin-top: 4px;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
  }

  .dropdown-options.show {
    display: block;
  }

  .dropdown-option {
    padding: 10px 12px;
    cursor: pointer;
  }

  .dropdown-option:hover {
    background-color: #f5f5f5;
  }

  .dropdown-group-label {
    padding: 8px 12px;
    font-weight: bold;
    background-color: #f0f0f0;
    color: #666;
  }

  .no-results {
    padding: 12px;
    color: #666;
    text-align: center;
    font-style: italic;
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

<div class="form-group-custom" style="margin-bottom: 20px;">
  <label class="required" style="color: #2962ff; font-weight: bold;">Ubicación</label>

  <div class="location-options">
    <label id="venezuelaLabel" style="border: 2px solid #2962ff; padding: 10px; border-radius: 5px;">
      <input type="radio" name="location_type" value="venezuela" checked>
      <img src="assets/img/backgrounds/vzla.jpg" alt="Bandera de Venezuela" class="map-icon">
      <span>Venezuela</span>
    </label>

    <label id="latinoamericaLabel" style="border: 2px solid #2962ff; padding: 10px; border-radius: 5px;">
      <input type="radio" name="location_type" value="internacional">
      <img src="assets/img/backgrounds/america.png" alt="Mapa de América" class="map-icon">
      <span>Internacional</span>
    </label>
  </div>

  <div id="venezuela-dropdown" class="custom-dropdown">
    <input type="text" class="dropdown-input" placeholder="Buscar estado..." data-type="venezuela" style="border: 2px solid #2962ff; padding: 10px; border-radius: 5px;">
    <input type="hidden" name="estado_venezuela" id="estado-venezuela-value">
    <div class="dropdown-options">
      <div class="dropdown-option" data-value="AM">Amazonas</div>
      <div class="dropdown-option" data-value="AN">Anzoátegui</div>
      <div class="dropdown-option" data-value="AP">Apure</div>
      <div class="dropdown-option" data-value="AR">Aragua</div>
      <div class="dropdown-option" data-value="BA">Barinas</div>
      <div class="dropdown-option" data-value="BO">Bolívar</div>
      <div class="dropdown-option" data-value="CA">Carabobo</div>
      <div class="dropdown-option" data-value="CO">Cojedes</div>
      <div class="dropdown-option" data-value="DA">Delta Amacuro</div>
      <div class="dropdown-option" data-value="DC">Distrito Capital</div>
      <div class="dropdown-option" data-value="FA">Falcón</div>
      <div class="dropdown-option" data-value="GU">Guárico</div>
      <div class="dropdown-option" data-value="LA">Lara</div>
      <div class="dropdown-option" data-value="MI">Miranda</div>
      <div class="dropdown-option" data-value="MO">Monagas</div>
      <div class="dropdown-option" data-value="ME">Mérida</div>
      <div class="dropdown-option" data-value="NE">Nueva Esparta</div>
      <div class="dropdown-option" data-value="PO">Portuguesa</div>
      <div class="dropdown-option" data-value="SU">Sucre</div>
      <div class="dropdown-option" data-value="TR">Trujillo</div>
      <div class="dropdown-option" data-value="TA">Táchira</div>
      <div class="dropdown-option" data-value="VA">Vargas</div>
      <div class="dropdown-option" data-value="YA">Yaracuy</div>
      <div class="dropdown-option" data-value="ZU">Zulia</div>
    </div>
  </div>

  <div id="paises-dropdown" class="custom-dropdown" style="display: none;">
    <input type="text" class="dropdown-input" placeholder="Buscar país..." data-type="internacional" style="border: 2px solid #2962ff; padding: 10px; border-radius: 5px;">
    <input type="hidden" name="pais_internacional" id="pais-internacional-value">
    <div class="dropdown-options">
      <div class="dropdown-group-label">América del Norte</div>
      <div class="dropdown-option" data-value="CA">Canadá</div>
      <div class="dropdown-option" data-value="US">Estados Unidos</div>
      <div class="dropdown-option" data-value="MX">México</div>

      <div class="dropdown-group-label">América Central</div>
      <div class="dropdown-option" data-value="BZ">Belice</div>
      <div class="dropdown-option" data-value="CR">Costa Rica</div>
      <div class="dropdown-option" data-value="SV">El Salvador</div>
      <div class="dropdown-option" data-value="GT">Guatemala</div>
      <div class="dropdown-option" data-value="HN">Honduras</div>
      <div class="dropdown-option" data-value="NI">Nicaragua</div>
      <div class="dropdown-option" data-value="PA">Panamá</div>

      <div class="dropdown-group-label">El Caribe</div>
      <div class="dropdown-option" data-value="AG">Antigua y Barbuda</div>
      <div class="dropdown-option" data-value="BS">Bahamas</div>
      <div class="dropdown-option" data-value="BB">Barbados</div>
      <div class="dropdown-option" data-value="CU">Cuba</div>
      <div class="dropdown-option" data-value="DM">Dominica</div>
      <div class="dropdown-option" data-value="GD">Granada</div>
      <div class="dropdown-option" data-value="HT">Haití</div>
      <div class="dropdown-option" data-value="JM">Jamaica</div>
      <div class="dropdown-option" data-value="DO">República Dominicana</div>
      <div class="dropdown-option" data-value="KN">San Cristóbal y Nieves</div>
      <div class="dropdown-option" data-value="LC">Santa Lucía</div>
      <div class="dropdown-option" data-value="VC">San Vicente y las Granadinas</div>
      <div class="dropdown-option" data-value="TT">Trinidad y Tobago</div>

      <div class="dropdown-group-label">América del Sur</div>
      <div class="dropdown-option" data-value="AR">Argentina</div>
      <div class="dropdown-option" data-value="BO">Bolivia</div>
      <div class="dropdown-option" data-value="BR">Brasil</div>
      <div class="dropdown-option" data-value="CL">Chile</div>
      <div class="dropdown-option" data-value="CO">Colombia</div>
      <div class="dropdown-option" data-value="EC">Ecuador</div>
      <div class="dropdown-option" data-value="GY">Guyana</div>
      <div class="dropdown-option" data-value="PY">Paraguay</div>
      <div class="dropdown-option" data-value="PE">Perú</div>
      <div class="dropdown-option" data-value="SR">Surinam</div>
      <div class="dropdown-option" data-value="UY">Uruguay</div>
      <div class="dropdown-option" data-value="VE">Venezuela</div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const locationRadios = document.querySelectorAll('input[name="location_type"]');
    const venezuelaDropdown = document.getElementById('venezuela-dropdown');
    const paisesDropdown = document.getElementById('paises-dropdown');
    const venezuelaLabel = document.getElementById('venezuelaLabel');
    const latinoamericaLabel = document.getElementById('latinoamericaLabel');

    // Función para manejar el cambio de radio button
    function handleLocationChange(e) {
      venezuelaLabel.classList.remove('active');
      latinoamericaLabel.classList.remove('active');

      if (e.target.value === 'venezuela') {
        venezuelaDropdown.style.display = '';
        paisesDropdown.style.display = 'none';
        venezuelaLabel.classList.add('active');
      } else {
        venezuelaDropdown.style.display = 'none';
        paisesDropdown.style.display = '';
        latinoamericaLabel.classList.add('active');
      }
    }

    // Inicializar dropdowns personalizados
    function initializeCustomDropdowns() {
      const dropdowns = document.querySelectorAll('.custom-dropdown');

      dropdowns.forEach(dropdown => {
        const input = dropdown.querySelector('.dropdown-input');
        const options = dropdown.querySelector('.dropdown-options');
        const allOptions = dropdown.querySelectorAll('.dropdown-option');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');

        // Mostrar/ocultar opciones al hacer clic en el input
        input.addEventListener('click', () => {
          options.classList.toggle('show');
        });

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', (e) => {
          if (!dropdown.contains(e.target)) {
            options.classList.remove('show');
          }
        });

        // Filtrar opciones al escribir
        input.addEventListener('input', () => {
          const searchText = input.value.toLowerCase();
          let hasResults = false;

          allOptions.forEach(option => {
            const text = option.textContent.toLowerCase();
            if (text.includes(searchText)) {
              option.style.display = '';
              hasResults = true;
            } else {
              option.style.display = 'none';
            }
          });

          // Mostrar mensaje si no hay resultados
          const existingNoResults = options.querySelector('.no-results');
          if (!hasResults) {
            if (!existingNoResults) {
              const noResults = document.createElement('div');
              noResults.className = 'no-results';
              noResults.textContent = 'No se encontraron resultados';
              options.appendChild(noResults);
            }
          } else if (existingNoResults) {
            existingNoResults.remove();
          }

          options.classList.add('show');
        });

        // Seleccionar opción
        allOptions.forEach(option => {
          option.addEventListener('click', () => {
            const value = option.getAttribute('data-value');
            const text = option.textContent;
            input.value = text;
            hiddenInput.value = value;
            options.classList.remove('show');
          });
        });
      });
    }

    // Agregar eventos a los radio buttons
    locationRadios.forEach(radio => {
      radio.addEventListener('change', handleLocationChange);
    });

    // Establecer estado inicial
    const initialSelection = document.querySelector('input[name="location_type"]:checked');
    if (initialSelection) {
      handleLocationChange({
        target: initialSelection
      });
    }

    // Inicializar dropdowns personalizados
    initializeCustomDropdowns();
  });
</script>