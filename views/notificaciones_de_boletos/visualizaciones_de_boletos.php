<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo - Gestión de Boletos</title>
  <link rel="stylesheet" href="assets/css/admin.css">
  <!-- Semantic UI -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
</head>

<body>
  <div class="container">
    <h1 class="admin-title">Panel de Administración de Boletos</h1>

    <!-- Filtros -->
    <div class="filters-section">
      <div class="ui form">
        <div class="three fields">
          <div class="field">
            <label>Estado del Pago</label>
            <select class="ui dropdown" id="estadoPago">
              <option value="">Todos</option>
              <option value="pendiente">Pendiente</option>
              <option value="verificando">En Verificación</option>
              <option value="aprobado">Aprobado</option>
              <option value="rechazado">Rechazado</option>
            </select>
          </div>
          <div class="field">
            <label>Método de Pago</label>
            <select class="ui dropdown" id="metodoPago">
              <option value="">Todos</option>
              <option value="zelle">Zelle</option>
              <option value="paypal">PayPal</option>
              <option value="banco_venezuela">Banco de Venezuela</option>
            </select>
          </div>
          <div class="field">
            <label>Buscar por Número de Boleto</label>
            <input type="text" id="buscarBoleto" placeholder="Ej: 0001">
          </div>
        </div>
      </div>
    </div>

    <!-- Tabla de Boletos -->
    <table class="ui celled table">
      <thead>
        <tr>
          <th>Nº Boleto</th>
          <th>Comprador</th>
          <th>Fecha de Compra</th>
          <th>Método de Pago</th>
          <th>Monto</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tablaBoletos">
        <!-- Los datos se cargarán dinámicamente -->
      </tbody>
    </table>

    <!-- Modal de Detalles -->
    <div class="ui modal" id="detallesModal">
      <i class="close icon"></i>
      <div class="header">
        Detalles del Boleto
      </div>
      <div class="content">
        <div class="ui form">
          <div class="field">
            <label>Información del Comprador</label>
            <div id="infoComprador"></div>
          </div>
          <div class="field">
            <label>Comprobante de Pago</label>
            <div id="comprobantePago"></div>
          </div>
          <div class="field">
            <label>Cambiar Estado</label>
            <select class="ui dropdown" id="cambiarEstado">
              <option value="pendiente">Pendiente</option>
              <option value="verificando">En Verificación</option>
              <option value="aprobado">Aprobado</option>
              <option value="rechazado">Rechazado</option>
            </select>
          </div>
          <div class="field">
            <label>Notas Administrativas</label>
            <textarea id="notasAdmin"></textarea>
          </div>
        </div>
      </div>
      <div class="actions">
        <div class="ui approve button">Guardar Cambios</div>
        <div class="ui cancel button">Cerrar</div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
  <script>
    $(document).ready(function() {
      // Inicializar dropdowns
      $('.ui.dropdown').dropdown();

      // Función para cargar los boletos
      function cargarBoletos(filtros = {}) {
        $.ajax({
          url: '/TuRifadigi/obtenerBoletos',
          method: 'POST',
          data: filtros,
          success: function(response) {
            const boletos = JSON.parse(response);
            actualizarTablaBoletos(boletos);
          },
          error: function(error) {
            console.error('Error al cargar boletos:', error);
          }
        });
      }

      // Función para actualizar la tabla
      function actualizarTablaBoletos(boletos) {
        const tabla = $('#tablaBoletos');
        tabla.empty();

        boletos.forEach(boleto => {
          const fila = `
                        <tr>
                            <td>${boleto.numero}</td>
                            <td>${boleto.nombre_comprador}</td>
                            <td>${boleto.fecha_compra}</td>
                            <td>${boleto.metodo_pago}</td>
                            <td>${boleto.monto} ${boleto.moneda}</td>
                            <td>
                                <div class="ui label ${getEstadoClass(boleto.estado)}">
                                    ${boleto.estado}
                                </div>
                            </td>
                            <td>
                                <button class="ui button primary tiny" onclick="verDetalles(${boleto.id})">
                                    Ver Detalles
                                </button>
                            </td>
                        </tr>
                    `;
          tabla.append(fila);
        });
      }

      // Función para obtener la clase CSS según el estado
      function getEstadoClass(estado) {
        const clases = {
          'pendiente': 'yellow',
          'verificando': 'blue',
          'aprobado': 'green',
          'rechazado': 'red'
        };
        return clases[estado] || '';
      }

      // Función para ver detalles
      window.verDetalles = function(boletoId) {
        $.ajax({
          url: '/TuRifadigi/obtenerDetalleBoleto',
          method: 'POST',
          data: {
            id: boletoId
          },
          success: function(response) {
            const detalle = JSON.parse(response);
            mostrarModal(detalle);
          },
          error: function(error) {
            console.error('Error al obtener detalles:', error);
          }
        });
      }

      // Función para mostrar el modal
      function mostrarModal(detalle) {
        $('#infoComprador').html(`
                    <p><strong>Nombre:</strong> ${detalle.nombre_comprador}</p>
                    <p><strong>Cédula:</strong> ${detalle.cedula}</p>
                    <p><strong>Teléfono:</strong> ${detalle.telefono}</p>
                    <p><strong>Ubicación:</strong> ${detalle.ubicacion}</p>
                `);

        $('#comprobantePago').html(`
                    <img src="${detalle.comprobante_url}" alt="Comprobante" style="max-width: 100%;">
                `);

        $('#cambiarEstado').val(detalle.estado);
        $('#notasAdmin').val(detalle.notas_admin);

        $('#detallesModal')
          .modal({
            onApprove: function() {
              guardarCambios(detalle.id);
            }
          })
          .modal('show');
      }

      // Función para guardar cambios
      function guardarCambios(boletoId) {
        const datos = {
          id: boletoId,
          estado: $('#cambiarEstado').val(),
          notas: $('#notasAdmin').val()
        };

        $.ajax({
          url: '/TuRifadigi/actualizarBoleto',
          method: 'POST',
          data: datos,
          success: function(response) {
            cargarBoletos();
          },
          error: function(error) {
            console.error('Error al guardar cambios:', error);
          }
        });
      }

      // Event listeners para filtros
      $('#estadoPago, #metodoPago').change(function() {
        const filtros = {
          estado: $('#estadoPago').val(),
          metodo: $('#metodoPago').val(),
          busqueda: $('#buscarBoleto').val()
        };
        cargarBoletos(filtros);
      });

      $('#buscarBoleto').on('input', function() {
        const filtros = {
          estado: $('#estadoPago').val(),
          metodo: $('#metodoPago').val(),
          busqueda: $(this).val()
        };
        cargarBoletos(filtros);
      });

      // Cargar boletos inicialmente
      cargarBoletos();
    });
  </script>

  <style>
    .container {
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .admin-title {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .filters-section {
      margin-bottom: 20px;
      padding: 20px;
      background: #f9f9f9;
      border-radius: 8px;
    }

    .ui.table {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .ui.label {
      margin: 0;
    }

    .ui.modal {
      max-width: 600px;
    }
  </style>
</body>

</html>