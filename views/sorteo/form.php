<!-- <div class="form-section">
  <div class="form-header">
    <i class="fas fa-user"></i>
    INFORMACIÓN DEL COMPRADOR
  </div>
  <div class="form-content">
    <div class="form-group">
      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su nombre completo" required>
    </div>
    <div class="form-group">
      <label for="telefono">Teléfono</label>
      <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Ingrese su número de teléfono" required>
    </div>
    <div class="form-group">
      <label for="email">Correo electrónico</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico" required>
    </div>
    <div class="form-group">
      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese su dirección" required>
    </div>
    <button id="enviarDatos" class="btn btn-primary mt-3">Enviar información</button>
  </div>
</div>

<script>
  document.getElementById('enviarDatos').addEventListener('click', function() {
    // Validar campos antes de enviar
    const campos = ['nombre', 'telefono', 'email', 'direccion'];
    let camposValidos = true;

    campos.forEach(campo => {
      const valor = document.getElementById(campo).value.trim();
      if (!valor) {
        camposValidos = false;
        document.getElementById(campo).classList.add('is-invalid');
      } else {
        document.getElementById(campo).classList.remove('is-invalid');
      }
    });

    if (!camposValidos) {
      alert('Por favor complete todos los campos requeridos');
      return;
    }

    const datosComprador = {
      nombre: document.getElementById('nombre').value.trim(),
      telefono: document.getElementById('telefono').value.trim(),
      email: document.getElementById('email').value.trim(),
      direccion: document.getElementById('direccion').value.trim()
    };

    // Deshabilitar el botón durante el envío
    const boton = document.getElementById('enviarDatos');
    boton.disabled = true;
    boton.innerHTML = 'Enviando...';

    fetch('/TuRifadigi/guardarComprador', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(datosComprador)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Información guardada correctamente');
          // Aquí puedes redirigir o hacer algo más después de guardar
        } else {
          alert(data.error || 'Error al guardar la información');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al enviar los datos');
      })
      .finally(() => {
        // Restaurar el botón
        boton.disabled = false;
        boton.innerHTML = 'Enviar información';
      });
  });
</script> -->