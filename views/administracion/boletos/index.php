<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración de Boletos - TuRifadigi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
  <style>
    .admin-container {
      padding: 20px;
      max-width: 1400px;
      margin: 0 auto;
    }

    .header-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .filters-section {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .filter-group {
      flex: 1;
      min-width: 200px;
    }

    .filter-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #333;
    }

    .filter-group select,
    .filter-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .boletos-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .boletos-table th,
    .boletos-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    .boletos-table th {
      background: #f8f9fa;
      font-weight: 600;
    }

    .status-badge {
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.85em;
      font-weight: 500;
    }

    .status-pendiente {
      background: #fff3cd;
      color: #856404;
    }

    .status-pagado {
      background: #d4edda;
      color: #155724;
    }

    .status-cancelado {
      background: #f8d7da;
      color: #721c24;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .btn-action {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.9em;
      transition: all 0.3s ease;
    }

    .btn-verificar {
      background: #28a745;
      color: white;
    }

    .btn-cancelar {
      background: #dc3545;
      color: white;
    }

    .btn-verificar:hover {
      background: #218838;
    }

    .btn-cancelar:hover {
      background: #c82333;
    }

    .timer {
      font-size: 0.9em;
      color: #666;
    }

    .timer.warning {
      color: #dc3545;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
    }

    .pagination button {
      padding: 8px 15px;
      border: 1px solid #ddd;
      background: white;
      border-radius: 4px;
      cursor: pointer;
    }

    .pagination button.active {
      background: #007bff;
      color: white;
      border-color: #007bff;
    }

    .search-box {
      position: relative;
      flex: 1;
      max-width: 300px;
    }

    .search-box input {
      width: 100%;
      padding: 8px 35px 8px 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .search-box i {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
    }
  </style>
</head>

<body>
  <div class="admin-container">
    <div class="header-section">
      <h1><i class="fas fa-ticket-alt"></i> Administración de Boletos</h1>
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Buscar boleto...">
        <i class="fas fa-search"></i>
      </div>
    </div>

    <div class="filters-section">
      <div class="filter-group">
        <label>Estado</label>
        <select id="estadoFilter">
          <option value="">Todos</option>
          <option value="pendiente">Pendiente</option>
          <option value="pagado">Pagado</option>
          <option value="cancelado">Cancelado</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Fecha</label>
        <input type="date" id="fechaFilter">
      </div>
      <div class="filter-group">
        <label>Método de Pago</label>
        <select id="metodoPagoFilter">
          <option value="">Todos</option>
          <option value="zelle">Zelle</option>
          <option value="paypal">PayPal</option>
          <option value="banco_venezuela">Banco de Venezuela</option>
        </select>
      </div>
    </div>

    <table class="boletos-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Número Boleto</th>
          <th>Cliente</th>
          <th>Método de Pago</th>
          <th>Total</th>
          <th>Estado</th>
          <th>Tiempo Restante</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="boletosTableBody">
        <!-- Los datos se cargarán dinámicamente -->
      </tbody>
    </table>

    <div class="pagination">
      <button id="prevPage"><i class="fas fa-chevron-left"></i></button>
      <button class="active">1</button>
      <button>2</button>
      <button>3</button>
      <button id="nextPage"><i class="fas fa-chevron-right"></i></button>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Inicializar los dropdowns de Semantic UI
      $('.ui.dropdown').dropdown();

      // Función para cargar los datos
      function cargarDatos() {
        fetch('/TuRifadigi/procesarCompra')
          .then(response => response.json())
          .then(data => {
            const tbody = document.getElementById('boletosTableBody');
            tbody.innerHTML = '';

            data.forEach(compra => {
              const row = document.createElement('tr');

              // Crear el contenido de la fila
              const tiempoRestante = compra.tiempo_restante.expirado ?
                '<span class="timer warning">Expirado</span>' :
                `<span class="timer">${compra.tiempo_restante.horas}h ${compra.tiempo_restante.minutos}m</span>`;

              row.innerHTML = `
                <td>${compra.id_compra}</td>
                <td>${compra.boletos.join(', ')}</td>
                <td>${compra.cliente}</td>
                <td>${compra.metodo_pago}</td>
                <td>${compra.total} BS</td>
                <td>
                  <span class="status-badge status-${compra.estado_pago}">
                    ${compra.estado_pago}
                  </span>
                </td>
                <td>${tiempoRestante}</td>
                <td class="action-buttons">
                  <button class="btn-action btn-verificar" onclick="verificarPago(${compra.id_compra})">
                    <i class="fas fa-check"></i> Verificar
                  </button>
                  <button class="btn-action btn-cancelar" onclick="cancelarCompra(${compra.id_compra})">
                    <i class="fas fa-times"></i> Cancelar
                  </button>
                </td>
              `;

              tbody.appendChild(row);
            });
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los datos');
          });
      }

      // Función para verificar pago
      window.verificarPago = function(idCompra) {
        if (confirm('¿Está seguro de verificar este pago?')) {
          // Aquí irá la lógica para verificar el pago
          console.log('Verificando pago:', idCompra);
        }
      };

      // Función para cancelar compra
      window.cancelarCompra = function(idCompra) {
        if (confirm('¿Está seguro de cancelar esta compra?')) {
          // Aquí irá la lógica para cancelar la compra
          console.log('Cancelando compra:', idCompra);
        }
      };

      // Cargar datos inicialmente
      cargarDatos();

      // Actualizar datos cada minuto
      setInterval(cargarDatos, 60000);

      // Eventos de filtrado
      document.getElementById('estadoFilter').addEventListener('change', cargarDatos);
      document.getElementById('fechaFilter').addEventListener('change', cargarDatos);
      document.getElementById('metodoPagoFilter').addEventListener('change', cargarDatos);

      // Búsqueda en tiempo real
      document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#boletosTableBody tr');

        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
      });
    });
  </script>
</body>

</html>