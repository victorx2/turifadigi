<?php

use App\Controllers\SorteoController;
$sorteoController = new SorteoController();
$sorteo = $sorteoController->obtenerSorteoActivo();
?>
<link rel="stylesheet" href="assets/css/premio.css">

<main class="supergana-section" role="main">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <article class="supergana-content text-center">
          <h1 class="section-title__title"><?php echo htmlspecialchars((string)$titulo); ?></h1>
          <div class="prize-details">
            <div class="alert alert-info mb-4" role="alert">
              <strong>Al completarse el 80% juega nuestra rifa</strong>
            </div>

            <section class="lottery-info mb-4" aria-label="Información básica">
              <p>📍 Juega por la lotería de SuperGana</p>
              <p>🎟️ Valor del boleto: <span class="price">$<?php echo htmlspecialchars((string)$precioBoleto); ?></span></p>
              <p>🎟️ Compra mínima: <span class="min-tickets"><?php echo htmlspecialchars((string)$boletosMinimos); ?> boletos</span> en adelante</p>
            </section>

            <section class="prize-list mb-4" aria-label="Lista de premios">
              <?php foreach ($premios as $premio): ?>
                <div class="prize-item" role="article">
                  <h2><?php echo htmlspecialchars($premio['nombre']); ?></h2>
                  <div class="premio-descripcion">
                    <?php echo nl2br(htmlspecialchars($premio['descripcion'])); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </section>

            <section class="date-info mb-4" aria-label="Fecha del sorteo">
              <h2>🗓️ ¿Cuándo se juega la rifa?</h2>
              <p>La fecha del sorteo será anunciada una vez se alcance el 80% de los boletos vendidos</p>
            </section>

            <section class="official-link mb-4" aria-label="Enlace oficial">
              <h2>🔗 Enlace oficial para seguir el sorteo:</h2>
              <a href="<?php echo htmlspecialchars((string)$urlRifa); ?>" target="_blank" class="thm-btn" rel="noopener">
                LOTERIA OFICIAL <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                <span class="sr-only">(se abre en una nueva ventana)</span>
              </a>
            </section>

            <section class="contact-info mb-4" aria-label="Información de contacto">
              <h2>📞 Número de contacto:</h2>
              <p><a href="tel:<?php echo htmlspecialchars((string)$numeroContacto); ?>" class="phone-number">
                  <strong>+1 <?php echo htmlspecialchars((string)$numeroContacto); ?></strong>
                </a></p>
            </section>
            <!--
             <aside class="example-box" role="complementary">
              <h2>Información importante</h2>
              <p class="example-text"><?php echo $sorteo['data']['texto_importante']; ?></p>
            </aside> 
            -->
          </div>
        </article>
      </div>
    </div>
  </div>
</main>