<?php

/* use App\Models\RaffleConfig;

$configModel = new RaffleConfig();
$config = $configModel->getConfig();

// Valores por defecto si no hay configuración
$premios_default = [
  [
    'nombre' => '🛵 Premio Mayor',
    'descripcion' => "Si estás en Estados Unidos, ganas una moto\nSi estás en otro país, ganas el valor de la moto al cambio de la moneda local desde donde participes"
  ],
  [
    'nombre' => '📱 Segundo Premio',
    'descripcion' => "Un iPhone 16 Pro Max\nDisponible para cualquier país participante"
  ],
  [
    'nombre' => '💵 Tercer Premio',
    'descripcion' => "$1000 en efectivo\nPara participar debes comprar 10 boletos o más\nEste premio se activa con el 50% de los boletos vendidos"
  ]
];

// Usar valores de la configuración o valores por defecto
$titulo = $config['titulo'] ?? '🎉 ¡POR EL SUPERGANA! 🎉';
$precio_boleto = $config['precio_boleto'] ?? '3';
$boletos_minimos = $config['boletos_minimos'] ?? '2';
$premios = !empty($config['premios']) ? $config['premios'] : $premios_default;
$url_rifa = $config['url_rifa'] ?? 'https://tripletachira.com/';
$numero_contacto = $config['numero_contacto'] ?? '407-428-7580';
$texto_ejemplo = $config['texto_ejemplo'] ?? 'Si compras 10 boletos, participas automáticamente en el sorteo de $1000 cuando se alcance el 50% de los números vendidos. El día se anunciará públicamente.';
?>
<link rel="stylesheet" href="assets/css/premio.css">

<main class="supergana-section" role="main">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <article class="supergana-content text-center">
          <h1 class="section-title__title"><?php echo htmlspecialchars($titulo); ?></h1>
          <div class="prize-details">
            <div class="alert alert-info mb-4" role="alert">
              <strong>Al completarse el 80% juega nuestra rifa</strong>
            </div>

            <section class="lottery-info mb-4" aria-label="Información básica">
              <p>📍 Juega por la lotería de SuperGana</p>
              <p>🎟️ Valor del boleto: <span class="price">$<?php echo htmlspecialchars($precio_boleto); ?></span></p>
              <p>🎟️ Compra mínima: <span class="min-tickets"><?php echo htmlspecialchars($boletos_minimos); ?> boletos</span> en adelante</p>
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
              <a href="<?php echo htmlspecialchars($url_rifa); ?>" target="_blank" class="thm-btn" rel="noopener">
                👉 SuperGana <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                <span class="sr-only">(se abre en una nueva ventana)</span>
              </a>
            </section>

            <section class="contact-info mb-4" aria-label="Información de contacto">
              <h2>📞 Número de contacto:</h2>
              <p><a href="tel:<?php echo htmlspecialchars($numero_contacto); ?>" class="phone-number">
                  <strong><?php echo htmlspecialchars($numero_contacto); ?></strong>
                </a></p>
            </section>

            <section class="important-info mb-4" aria-label="Información importante">
              <h2>Información importante:</h2>
              <ul class="list-unstyled">
                <li>El Premio Mayor y el Segundo Premio se juegan con el 80% de los boletos vendidos</li>
                <li>El Tercer Premio ($1000) se juega con el 50% de los boletos vendidos, exclusivo para quienes compren 10 boletos o más</li>
                <li>Todos los premios se juegan por la lotería SuperGana</li>
              </ul>
            </section>

            <aside class="example-box" role="complementary">
              <h2>💬 Ejemplo:</h2>
              <p class="example-text"><?php echo htmlspecialchars($texto_ejemplo); ?></p>
            </aside>
          </div>
        </article>
      </div>
    </div>
  </div>
</main> */