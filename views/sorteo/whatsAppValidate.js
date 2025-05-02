function generarEnlaceWhatsApp(data, ticketsComprados) {

    const nombre = data.nombre; // Reemplaza con el nombre del cliente
    const cedula = data.cedula; // Reemplaza con la cédula del cliente   
    const celular = data.telefono; // Reemplaza con el número de celular del cliente
    const numeroTelefono = "14077329524"; // Numero de la empresa en WhatsApp
    const listaTickets = ticketsComprados.join(', '); // Convierte el array de tickets en una cadena separada por comas
  
    const mensaje = `FELICIDADES, ${nombre}!\n\nHas registrado exitosamente tus numeros: ${listaTickets} en la rifa "¡SUPER GANA!".\n\nEn un lapso no mayor a 24 horas las asesoras verificaran tus boletos y los podras observar en nuestro verificador.\n\nAl contrario, de no estar pagos tus boletos, tendras un lapso maximo de 120 horas para realizarlo. Pasando su tiempo estimado, saldran a disponibles nuevamente.\n\nTus datos de registro:\nNombre: ${nombre}\nCedula: ${cedula}\nCelular: ${celular}\n\nUN PLACER PARA NOSOTROS QUE FORMES PARTE DE NUESTROS GANADORES, GRACIAS POR CONFIAR EN CEGARIFAS!`;
  
    const mensajeCodificado = encodeURIComponent(mensaje);
    const enlaceWhatsApp = `https://wa.me/${numeroTelefono}?text=${mensajeCodificado}`;
    window.location.href = enlaceWhatsApp; // Redirecciona al cliente
}
  
//   // Ejemplo de cómo podrías llamar a esta función después del registro exitoso:
//   const datosRegistro = {
//     nombre: "Victor Carrillo",
//     cedula: "28187874",
//     celular: "+58 412 4578781",
//     tickets: ["006", "009", "005"]
//   };
  
//   // Llamar a la función con los datos obtenidos del registro
//   generarEnlaceWhatsAppRifa(datosRegistro.nombre, datosRegistro.cedula, datosRegistro.celular, datosRegistro.tickets);