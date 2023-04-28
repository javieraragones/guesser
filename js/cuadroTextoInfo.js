/*Función que muestra un cuadro de texto al darle click al icono de información*/

$(document).ready(function () {
  // Oculta el cuadro de texto inicialmente
  $("#cuadroTextoInfo").hide();
  // Agrega un evento de clic al botón de icono
  $("#btn-info").click(function () {
    // Muestra el cuadro de texto al hacer clic en el botón de icono
    $("#cuadroTextoInfo").fadeIn();
  });
  // Agrega un evento de clic al botón de cerrar
  $("#btn-cerrar-info").click(function () {
    // Oculta el cuadro de texto al hacer clic en el botón de cerrar
    $("#cuadroTextoInfo").fadeOut();
  });
  // Agrega un evento de clic fuera del cuadro de texto para cerrarlo
  $(document).click(function (event) {
    if (!$(event.target).closest('#cuadroTextoInfo, #btn-info').length) {
      // Oculta el cuadro de texto al hacer clic fuera del cuadro de texto y del botón de icono
      $("#cuadroTextoInfo").fadeOut();
    }
  });
});
