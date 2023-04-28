/*Función para mostrar desplegable de idiomas al darle click al icono*/

$(document).ready(function() {
  // Oculta la lista de idiomas inicialmente
  $(".lang-menu ul").hide();
  // Agrega un evento de clic al elemento de selección de idioma
  $(".selected-lang").click(function() {
    // Muestra la lista de idiomas al hacer clic en el elemento de selección de idioma
    $(".lang-menu ul").slideToggle();
  });
  // Agrega un evento de clic a los elementos de idioma
  $(".lang-menu ul li a").click(function() {
    // Obtiene el valor del atributo class para determinar el idioma seleccionado
    var lang = $(this).attr("class");
    // Ejecuta la lógica para cambiar el idioma en función del valor del atributo class
    if (lang === "es") {
      // Lógica para cambiar a Español
      console.log("Español seleccionado");
      // Agrega aquí el código para cambiar el idioma a Español
    } else if (lang === "us") {
      // Lógica para cambiar a Inglés
      console.log("Inglés seleccionado");
      // Agrega aquí el código para cambiar el idioma a Inglés
    }
    // Oculta la lista de idiomas después de seleccionar un idioma
    $(".lang-menu ul").slideUp();
  });
  // Agrega un evento de clic al objeto document para cerrar el dropdown al hacer clic fuera de él
  $(document).on("click", function(event) {
    // Verifica si el clic se realizó fuera del dropdown
    if (!$(event.target).closest(".lang-menu").length) {
      // Cierra el dropdown si se hizo clic fuera de él
      $(".lang-menu ul").slideUp();
    }
  });
});

/*Función desplegar al poner el cursor encima
const languageDropdown = document.querySelector(".lang-menu");
const languageSelected = document.querySelector(".selected-lang");
const languageOptions = document.querySelectorAll(".lang-menu li a");

languageSelected.addEventListener("click", () => {
  languageDropdown.classList.toggle("active");
});

languageOptions.forEach((option) => {
  option.addEventListener("click", () => {
    languageSelected.querySelector("span").textContent = option.textContent;
    languageDropdown.classList.remove("active");
  });
});
*/