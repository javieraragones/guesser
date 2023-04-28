/*Función para mostrar el tiempo que queda para el próximo reto*/

// Establecer la fecha del siguiente día
var now = new Date();
var tomorrow = new Date(now.getFullYear(), now.getMonth(), now.getDate()+1);

// Establecer la fecha de cuenta regresiva
var countdownDate = tomorrow.getTime();

// Actualizar el contador cada segundo
var countdown = setInterval(function() {

  // Obtener la fecha y hora actual
  var now = new Date().getTime();

  // Calcular la diferencia en tiempo entre ahora y la cuenta regresiva
  var difference = countdownDate - now;

  // Calcular horas, minutos y segundos restantes
  var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((difference % (1000 * 60)) / 1000);

  // Mostrar el contador en la página
  document.getElementById("countdown-timer").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s";

  // Cuando se alcanza la cuenta regresiva, detener el contador y mostrar un mensaje
  if (difference < 0) {
    clearInterval(countdown);
    document.getElementById("countdown-timer").innerHTML = "¡Nuevo reto!";
  }
}, 1000);
