/*Función que muestra un cuadro de texto al darle click al icono de pregunta*/

$(document).ready(function () {
  // Oculta el cuadro de texto inicialmente
  $("#cuadroTextoPreg").hide();
  // Agrega un evento de clic al botón de icono
  $("#btn-question").click(function () {
    // Muestra el cuadro de texto al hacer clic en el botón de icono
    $("#cuadroTextoPreg").fadeIn();
  });
  // Agrega un evento de clic al botón de cerrar
  $("#btn-cerrar-question").click(function () {
    // Oculta el cuadro de texto al hacer clic en el botón de cerrar
    $("#cuadroTextoPreg").fadeOut();
  });
  // Agrega un evento de clic fuera del cuadro de texto para cerrarlo
  $(document).click(function (event) {
    if (!$(event.target).closest('#cuadroTextoPreg, #btn-question').length) {
      // Oculta el cuadro de texto al hacer clic fuera del cuadro de texto y del botón de icono
      $("#cuadroTextoPreg").fadeOut();
    }
  });
}); 