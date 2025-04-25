<?php require_once 'views/layouts/header.php'; ?>

<div class="container py-5">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Configuración de la Rifa</h3>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
              <?php echo $_SESSION['success'];
              unset($_SESSION['success']); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['error'];
              unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>

          <form action="/admin/raffle-config/update" method="POST">
            <div class="mb-3">
              <label for="title" class="form-label">Título de la Rifa</label>
              <input type="text" class="form-control" id="title" name="title"
                value="<?php echo htmlspecialchars($config['title'] ?? ''); ?>" required>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="ticket_price" class="form-label">Precio del Boleto ($)</label>
                  <input type="number" class="form-control" id="ticket_price" name="ticket_price"
                    value="<?php echo htmlspecialchars($config['ticket_price'] ?? ''); ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="min_tickets" class="form-label">Compra Mínima de Boletos</label>
                  <input type="number" class="form-control" id="min_tickets" name="min_tickets"
                    value="<?php echo htmlspecialchars($config['min_tickets'] ?? ''); ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="third_prize_min_tickets" class="form-label">Boletos Mínimos para Tercer Premio</label>
                  <input type="number" class="form-control" id="third_prize_min_tickets" name="third_prize_min_tickets"
                    value="<?php echo htmlspecialchars($config['third_prize_min_tickets'] ?? ''); ?>" required>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="major_prize_description" class="form-label">Descripción Premio Mayor</label>
              <textarea class="form-control" id="major_prize_description" name="major_prize_description" rows="3" required><?php echo htmlspecialchars($config['major_prize_description'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
              <label for="second_prize_description" class="form-label">Descripción Segundo Premio</label>
              <textarea class="form-control" id="second_prize_description" name="second_prize_description" rows="3" required><?php echo htmlspecialchars($config['second_prize_description'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
              <label for="third_prize_description" class="form-label">Descripción Tercer Premio</label>
              <textarea class="form-control" id="third_prize_description" name="third_prize_description" rows="3" required><?php echo htmlspecialchars($config['third_prize_description'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
              <label for="contact_number" class="form-label">Número de Contacto</label>
              <input type="text" class="form-control" id="contact_number" name="contact_number"
                value="<?php echo htmlspecialchars($config['contact_number'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
              <label for="lottery_url" class="form-label">URL de la Lotería</label>
              <input type="url" class="form-control" id="lottery_url" name="lottery_url"
                value="<?php echo htmlspecialchars($config['lottery_url'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
              <label for="example_text" class="form-label">Texto de Ejemplo</label>
              <textarea class="form-control" id="example_text" name="example_text" rows="3" required><?php echo htmlspecialchars($config['example_text'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>