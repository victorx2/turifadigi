<div class="form-container">
  <h2>Formulario de Venta</h2>
  <form id="ventaForm" method="POST" action="/procesarVenta">
    <div class="form-group">
      <label for="nombre">Nombre del Comprador:</label>
      <input type="text" id="nombre" name="nombre" required>
    </div>

    <div class="form-group">
      <label for="cedula">Cédula de Identidad:</label>
      <input type="text" id="cedula" name="cedula" required>
    </div>

    <div class="form-group">
      <label for="telefono">Número de Teléfono:</label>
      <input type="tel" id="telefono" name="telefono" required>
    </div>

    <div class="form-group">
      <label for="email">Correo Electrónico:</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="metodoPago">Método de Pago:</label>
      <select id="metodoPago" name="metodoPago" required>
        <option value="">Seleccione un método</option>
        <option value="pagoMovil">Pago Móvil</option>
        <option value="transferencia">Transferencia Bancaria</option>
        <option value="efectivo">Efectivo</option>
      </select>
    </div>

    <div class="form-group">
      <label for="boletos">Números de Boletos:</label>
      <input type="text" id="boletos" name="boletos" required>
    </div>

    <div class="form-group">
      <label for="monto">Monto Total:</label>
      <input type="number" id="monto" name="monto" step="0.01" required>
    </div>

    <div class="form-group">
      <label for="comentarios">Comentarios:</label>
      <textarea id="comentarios" name="comentarios" rows="4"></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn-primary">Registrar Venta</button>
      <button type="reset" class="btn-secondary">Limpiar Formulario</button>
    </div>
  </form>
</div>

<style>
  .form-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
  }

  input, select, textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
  }

  .form-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
  }

  .btn-primary, .btn-secondary {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }
</style>
