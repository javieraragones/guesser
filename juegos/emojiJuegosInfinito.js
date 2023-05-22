
//Iniciamos las variables cantidadFallos y cuentaIntentosRestantes
let cantidadFallos = 0; // Contador para llevar el registro de la cantidad de fallos ocurridos
let cuentaIntentosRestantes = 6; // Cantidad de intentos restantes para el usuario

let arrayEmojis = []; // Array que contendrá los retos de emojis en un orden aleatorio
let retoCount = 0; // Contador de retos actualmente mostrados, inicia en 0


// Función asíncrona para llenar el arrayEmojis de retos. Se obtienen todos los retos ordenados aleatoriamente de la API
async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/juegoRandomEmojis');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;

        array.forEach((emoji) => {
            arrayEmojis.push(emoji);
        });
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
// Función asincrónica que coordina la ejecución de otras funciones
// Como trabajamos con funciones asíncronas, en esta función se espera a que se ejecute la función obtenerReto() y después de ejecuta mostrarEmojis()
async function ejecutar() {
    await obtenerReto();
    mostrarEmojis(cantidadFallos + 1, retoCount);
}
ejecutar(); // Llamamos a la función para que se muestre la primera pista


// Muestra los emojis desde el inicial hasta el que corresponda con la cantidad de fallos.
// Cada vez que el usuario falle, se mostrará el siguiente emoji y los anteriores.
async function mostrarEmojis(fallos, retoCount) {
    const retoSeleccionado = arrayEmojis[retoCount];
    const cajaReto = document.getElementById('caja-reto-juegos-emojis');
    // Guardar respuesta correcta
    const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
    const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
    respuestaInput.value = nombre; // Establecer el valor del input
    // Si hay alguna juego y el reto seleccionado tiene la propiedad 'emoji'...
    if (retoSeleccionado && retoSeleccionado.hasOwnProperty('emoji')) {
        const emojis = retoSeleccionado.emoji; // Obtener los emojis del objeto
        const regex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g; // Expresión regular para buscar pares de sustitutos que representan emojis en una cadena Unicode
        const emojiArray = emojis.match(regex); // Extrae todos los emojis presentes en la cadena 'emojis' y los guarda en un array
        console.log(emojiArray); // Muestra en la consola el array de emojis encontrados ['\ud83e\udd91', '\ud83c\udfae']
        cajaReto.innerHTML = emojiArray.splice(0, fallos).join(''); // Asigna el contenido HTML al elemento con el id "cajaReto"
    } else {
        //Si no hay reto disponible, se muestra una imagen de error
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        console.error(`Error: la columna ${columna} no existe en el objeto reto seleccionado.`);
    }
}

// Función con la que se pasa al siguiente reto
function mostrarRetoSiguiente() {
    mostrarPaginaAnterior();
    retoCount++;
    // Si ya no quedan más retos disponibles, se muestra una imagen de error y un mensaje indicando que no quedan más retos disponibles
    if (retoCount >= arrayEmojis.length) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        document.querySelector('.boton-buscar').disabled = true; // Deshabilitar el botón de envio de respuesta
        const cajaReto = document.getElementById('caja-reto-juegos-emojis');
        cajaReto.innerHTML = '';
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        cajaReto.style.backgroundSize = 'cover';
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Has realizado todos los retos disponibles";
        mensaje.style.color = "white";
        const mensaje2 = document.querySelector('.intentos-restantes');
        mensaje2.style.display = 'none';
    } else {
        // Mientras queden retos disponibles, se muestra el siguiente reto
        mostrarEmojis(cantidadFallos + 1, retoCount);
        console.log(retoCount)
    }
}

// Función que restaura los cambios realizados para cuando mostramos un nuevo reto
function mostrarPaginaAnterior() {

    // Restablecer el estilo y contenido de los mensajes
    const mensaje = document.querySelector('.mensaje-envio-respuesta');
    mensaje.style.display = 'none';
    mensaje.innerHTML = '';

    // Ocultar el botón de "Mostrar Reto Siguiente"
    const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
    botonSiguiente.style.display = 'none';

    // Habilitar el campo de entrada de texto
    document.querySelector(".input-buscador").disabled = false;
    document.querySelector('.cuadro-busqueda').style.display = 'flex'; //Volvemos a mostrar el cuadro de búsqueda

    // Limpiar historial
    var historial = document.getElementById("historial-intentos");
    historial.innerHTML = "";
}


// Función para poner la primera letra mayúscula
function primeraLetraMayus(str) {
    return str.replace(
        /\w\S*/g,
        function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}
// Función con la que comprobamos si la respuesta introducida por el usuario coincide con la respuesta correcta 
function comprobarRespuesta() {
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes <= 0) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        return;
    }
    var respuestaUsuario = document.querySelector(".input-buscador").value.toLowerCase(); // Obtener la respuesta del usuario
    var respuestaCorrecta = document.getElementById("respuesta-correcta").value.toLowerCase(); // Obtener la respuesta correcta
    var mensaje = document.querySelector(".mensaje-envio-respuesta");
    mensaje.style.fontSize = "24px";

    // Comparar las respuestas
    if (respuestaUsuario === respuestaCorrecta) {
        // El elemento que contiene el mensaje se muestra
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        //Si el usuario ha acertado, muestra un mensaje de éxito y oculta el input de texto
        mensaje.innerHTML = "¡Respuesta correcta! <br> <span class='respuesta-acertada-mensaje'>" + primeraLetraMayus(respuestaCorrecta) + "</span>"; //Mensaje de respuesta correcta
        mensaje.style.color = "green"; // establecer color verde para acierto 
        mensaje.style.fontSize = "22px"; // establecer tamaño fuente 
        document.querySelector('.cuadro-busqueda').style.display = 'none'; //Desactivamos cuadro de búsqueda

        //Reinicio la cantidad de fallos y los intentos restantes
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        //Mostrar botón para pasar al siguiente reto
        const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
        botonSiguiente.style.display = 'inline-block';
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes
    } else {
        cantidadFallos++; // Aumentamos la cuenta de fallos
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        var respuestaHTML = "";
        if (respuestaUsuario === "") {
            respuestaHTML = "<p>Respuesta vacía</p>"; // En caso de que el usuario no introduzca texto, se muestra "Respuesta vacía" en el historial
        } else {
            respuestaHTML = `<p>${primeraLetraMayus(respuestaUsuario)}</p>`; // Respuesta introducida errónea
        }
        historialIntentos.insertAdjacentHTML("afterbegin", respuestaHTML); // Inserta la respuesta al principio del historial
        mostrarEmojis(cantidadFallos + 1, retoCount); // Cada vez que se falla, se muestra desde el principio hasta cantidad de fallos +1
        cuentaIntentosRestantes--; // Actualiza los intentos restantes
    }
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes == 0) {
        // El elemento que contiene el mensaje se muestra
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Respuesta correcta: <br> <span class='respuesta-correcta-mensaje'>" + primeraLetraMayus(respuestaCorrecta) + "</span>"; //Mensaje que indica la respuesta correcta
        mensaje.style.color = "white"; // establecer color 
        mensaje.style.fontSize = "22px"; // establecer tamaño fuente 
        document.querySelector('.cuadro-busqueda').style.display = 'none'; //Desactivamos cuadro de búsqueda
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes

        // Reiniciamos la cuenta de los fallos y los intentos restantes
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        // Boton para reiniciar 
        const botonReiniciar = document.querySelector('#btn-reiniciar-modo-infinito');
        botonReiniciar.style.display = 'inline-block';
        var btnReiniciar = document.getElementById("btn-reiniciar-modo-infinito");
        btnReiniciar.addEventListener("click", function () {
            location.reload();
        });
    }
    mostrarIntentosRestantes(cuentaIntentosRestantes); //Se muestran al usuario los intentos restantes
    document.querySelector(".input-buscador").value = ""; //Deja el cuadro de respuesta vacío
}

// Función que muestra al usuario los intentos restantes
function mostrarIntentosRestantes(cuentaIntentosRestantes) {
    // Muestra los intentos restantes al cargar la página
    var intentosRestantes = document.getElementById("num-intentos-restantes");
    intentosRestantes.innerHTML = cuentaIntentosRestantes.toString();
}


/*----------------Funciones para buscar títulos que coinciden con la entrada y mostrarlos en un desplegable----------------*/

//FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
async function buscarTitulo(textoBusqueda) {
    // Si la respuesta no es exitosa, lanzar un error con el estado de la respuesta HTTP
    if (textoBusqueda.length >= 1) {
        const response = await fetch('http://localhost:81/juegoRandomEmojis');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Obtener los datos de la respuesta como JSON
        const data = await response.json();
        const array = data.message;
        // Crear un nuevo array para almacenar los nombres de las juegos o películas
        let nombres = []
        // Recorrer el array de datos y extraer los nombres de las juegos o películas, agregándolos al nuevo array "nombres"
        array.map(x => {
            nombres.push(x.nombre)
        })
        // Llamar a la función "mostrarResultados" para mostrar los resultados de la búsqueda en base a los nombres obtenidos y el texto de búsqueda
        mostrarResultados(nombres, textoBusqueda);
    } else {
        // Si el texto de búsqueda tiene una longitud menor a 1, vaciar el contenido del elemento con ID "resultados-busqueda"
        document.getElementById("resultados-busqueda").innerHTML = "";
    }
}

//FUNCIÓN QUE MUESTRA LOS RESULTADOS DE LOS TÍTULOS QUE COINCIDEN EN UN DESPLEGABLE
function mostrarResultados(textoRespuesta, textoBusqueda) {
    const resultados = textoRespuesta.filter(res => res.toLowerCase().includes(textoBusqueda.toLowerCase()));
    let htmlResultados = "";
    if (resultados.length > 0) {
        // Si se encontraron resultados, generar una lista con los resultados
        htmlResultados += "<ul>";
        for (let i = 0; i < resultados.length; i++) {
            // Agregar cada resultado como un elemento de lista con un enlace que llama a la función "seleccionarResultado"
            htmlResultados += "<li onclick=\"seleccionarResultado('" + resultados[i] + "')\"><span>" + resultados[i] + "</span></li>";
        }
        htmlResultados += "</ul>";
    } else {
        // Si no se encontraron resultados, mostrar un mensaje indicando que no hay resultados disponibles
        htmlResultados += "<p>No se encontraron resultados.</p>";
    }
    // Establecer el contenido HTML generado en el elemento con ID "resultados-busqueda"
    document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
}

//FUNCIÓN QUE SE EJECUTA AL SELECCIONAR UN RESULTADO
function seleccionarResultado(tituloSeleccionado) {
    document.querySelector(".input-buscador").value = tituloSeleccionado;
    // Limpiar el contenido del elemento con ID "resultados-busqueda"
    document.getElementById("resultados-busqueda").innerHTML = "";
}

//Para que se cierre el desplegable al hacer click fuera de él
let contenedorSelector = document.getElementById("resultados-busqueda");
// Agregar listener para cerrar selector al hacer clic fuera de él
document.addEventListener("click", function (event) {
    let clicDentroSelector = contenedorSelector.contains(event.target);
    // Si el clic se realizó fuera del contenedor del selector, se procede a cerrar el desplegable
    if (!clicDentroSelector) {
        contenedorSelector.innerHTML = ""; // Limpiar el contenido del contenedor para cerrar el desplegable
    }
});
