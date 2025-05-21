<!-- Botón de WhatsApp -->
<div class="chat">
  <a href="https://wa.me/14074287580"
    id="whatsappLink"
    target="_blank"
    class="whatsapp-button"
    style="background-color: #25D366; 
              color: white; 
              padding: 15px 30px; 
              border-radius: 50px; 
              text-decoration: none; 
              display: inline-block; 
              margin-top: 20px; 
              transition: all 0.3s ease; 
              box-shadow: 0 4px 6px rgba(37, 211, 102, 0.2);">
    <i class="bi bi-whatsapp" style="margin-right: 10px; font-size: 20px;"></i>
    Contactar por WhatsApp
  </a>
</div>

<style>
  .whatsapp-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(37, 211, 102, 0.3);
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar el enlace de WhatsApp
    function updateWhatsAppLink() {
      const selectedNumbers = Array.from(document.querySelectorAll('.selected-number'))
        .map(div => div.textContent.trim().replace('×', '').trim())
        .join(',');

      const message = `Gracias por comunicarte con CEGARIFAS. ¿Quieres ganarte una impecable joya por tan solo 3,34$?😮‍💨🍀\n\n` +
        `Hola, soy Yorsin cruz, con mi celular, +1 407 4287580, registre estos numeros: ${selectedNumbers} en la rifa LA OLLA DE PRESIONNN 😮️🔮\n\n` +
        `Si ya realizaste el pago.\n` +
        `En un lapso no mayor a 24horas las asesoras verificarán tus boletos y serán enviados los originales✅\n\n` +
        `¡UN PLACER PARA NOSOTROS QUE FORMES PARTE DE NUESTROS GANADORES, GRACIAS POR CONFIAR EN NOSOTROS!\n\n` +
        `Si necesitas algun metodo de pago, o tienes alguna duda, dejame saber, quedo atento para validar tu soporte de pago y verificar tus números ganadores ✅`;

      const encodedMessage = encodeURIComponent(message);
      const whatsappLink = document.getElementById('whatsappLink');
      whatsappLink.href = `https://wa.me/14074287580?text=${encodedMessage}`;
    }

    // Observar cambios en el contenedor de números seleccionados
    const selectedNumbersContainer = document.getElementById('selectedNumbers');
    if (selectedNumbersContainer) {
      const observer = new MutationObserver(updateWhatsAppLink);
      observer.observe(selectedNumbersContainer, {
        childList: true,
        subtree: true
      });
    }
  });
</script>