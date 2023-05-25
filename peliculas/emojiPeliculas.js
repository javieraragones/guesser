//Iniciamos las variables cantidadFallos y cuentaIntentosRestantes
let cantidadFallos = 0; // Contador para llevar el registro de la cantidad de fallos ocurridos
let cuentaIntentosRestantes = 6; // Cantidad de intentos restantes para el usuario

//Función para obtener el día actual
function getDiaActual() {
    const today = new Date();
    const month = (today.getMonth() + 1).toString().padStart(2, '0');
    const day = today.getDate().toString().padStart(2, '0');
    const year = today.getFullYear();
    const date = `${year}-${month}-${day}`;
    return date;
}
// Función para cambiar el valor de href del enlace con id "btn-infinito" para que al darle click al botón lleve a este modo de juego en infinito
function cambiarHref() {
    var enlace = document.getElementById("btn-infinito");
    enlace.href = "/Guesser/peliculas/emojiPeliculasInfinito.php";
}
cambiarHref();


// Muestra los emojis desde el inicial hasta el que corresponda con la cantidad de fallos.
// Cada vez que el usuario falle, se mostrará el siguiente emoji y los anteriores.
async function mostrarEmojis(fallos) {
    try {
        const dia = getDiaActual();
        const response = await fetch('http://localhost:81/peliculaEmojis');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-peliculas-emojis');
        const emojisPeliculasHoy = array.find(prop => prop.fecha === dia); // Encuentra el objeto con fecha igual al día de hoy
        // Guardar respuesta correcta
        const nombre = emojisPeliculasHoy.nombre; // Obtener valor de la columna "nombre" del objeto encontrado
        const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
        respuestaInput.value = nombre; // Establecer el valor del input
        // Si hay alguna pelicula...
        if (emojisPeliculasHoy) {
            const emojis = emojisPeliculasHoy.emoji; // Obtener los emojis del objeto encontrado
            const regex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g; // Expresión regular para buscar pares de sustitutos que representan emojis en una cadena Unicode
            const emojiArray = emojis.match(regex); // Extrae todos los emojis presentes en la cadena 'emojis' y los guarda en un array
            console.log(emojiArray); // Muestra en la consola el array de emojis encontrados ['\ud83e\udd91', '\ud83c\udfae']
            cajaReto.innerHTML = emojiArray.splice(0, fallos).join(''); // Asigna el contenido HTML al elemento con el id "cajaReto"
        } else {
            //Si no hay reto disponible, se muestra una imagen de error
            cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
            console.error(`Error: No se encontró un objeto con la fecha ${dia}.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
mostrarEmojis(cantidadFallos + 1); //Se llama a la función para mostrar la primera pista

//Función para poner la primera letra mayúscula
function primeraLetraMayus(str) {
    return str.replace(
        /\w\S*/g,
        function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}
//Función con la que se comprueba la respuesta introducida por el usuario
function comprobarRespuesta() {
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes <= 0) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto en caso de que no queden más intentos
        return;
    }
    var respuestaUsuario = document.querySelector(".input-buscador").value.toLowerCase(); // Obtener la respuesta del usuario
    var respuestaCorrecta = document.getElementById("respuesta-correcta").value.toLowerCase(); // Obtener la respuesta correcta
    // Mensaje que se muestra al usuario cuando acierta o se han agotado los intentos
    var mensaje = document.querySelector(".mensaje-envio-respuesta");
    mensaje.style.fontSize = "24px";

    // Comparar las respuestas
    if (respuestaUsuario === respuestaCorrecta) {
        // El elemento que contiene el mensaje se muestra
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        //Si el usuario ha acertado, muestra un mensaje de éxito y oculta el input de texto
        mensaje.innerHTML = "¡Respuesta correcta! <br> <span class='respuesta-acertada-mensaje'>" + primeraLetraMayus(respuestaCorrecta) + "</span>"; //Mensaje de respuesta correcta
        mensaje.style.color = "#5ad16e"; // establecer color verde para acierto 
        mensaje.style.fontSize = "22px"; // establecer tamaño fuente 
        document.querySelector('.cuadro-busqueda').style.display = 'none'; //Desactivamos cuadro de búsqueda
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes
        mostrarEmojis(6);
    } else {
        cantidadFallos++; //Aumentamos la cuenta de fallos
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        var respuestaHTML = "";
        if (respuestaUsuario === "") {
            respuestaHTML = "<p>Respuesta vacía</p>"; // En caso de que el usuario no introduzca texto, se muestra "Respuesta vacía" en el historial
        } else {
            respuestaHTML = `<p>${primeraLetraMayus(respuestaUsuario)}</p>`; // Respuesta introducida errónea
        }
        historialIntentos.insertAdjacentHTML("afterbegin", respuestaHTML); // Inserta la respuesta al principio del historial
        mostrarEmojis(cantidadFallos + 1); // Cada vez que se falla, se muestra desde el principio hasta cantidad de fallos +1
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
        document.querySelector('.cuadro-busqueda').style.display = 'none'; // Desactivamos cuadro de búsqueda
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes
        mostrarEmojis(6);
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
    if (textoBusqueda.length >= 1) {
        const response = await fetch('http://localhost:81/peliculaEmojis');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        let nombres = []
        array.map(x => {
            nombres.push(x.nombre)
        })
        mostrarResultados(nombres, textoBusqueda);
    } else {
        document.getElementById("resultados-busqueda").innerHTML = "";
    }
}

//FUNCIÓN QUE MUESTRA LOS RESULTADOS DE LOS TÍTULOS QUE COINCIDEN EN UN DESPLEGABLE
function mostrarResultados(textoRespuesta, textoBusqueda) {
    const resultados = textoRespuesta.filter(res => res.toLowerCase().includes(textoBusqueda.toLowerCase()));
    let htmlResultados = "";
    if (resultados.length > 0) {
        htmlResultados += "<ul>";
        for (let i = 0; i < resultados.length; i++) {
            //htmlResultados += "<li><a href=\"#\" onclick=\"seleccionarResultado('" + resultados[i] + "')\">" + resultados[i] + "</a></li>";
            htmlResultados += "<li onclick=\"seleccionarResultado('" + resultados[i] + "')\"><span>" + resultados[i] + "</span></li>";
        }
        htmlResultados += "</ul>";
    } else {
        htmlResultados += "<p>No se encontraron resultados.</p>";
    }
    document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
}

//FUNCIÓN QUE SE EJECUTA AL SELECCIONAR UN RESULTADO
function seleccionarResultado(tituloSeleccionado) {
    document.querySelector(".input-buscador").value = tituloSeleccionado;
    document.getElementById("resultados-busqueda").innerHTML = "";
}

//Para que se cierre el desplegable al hacer click fuera de él
let contenedorSelector = document.getElementById("resultados-busqueda");
// Agregar listener para cerrar selector al hacer clic fuera de él
document.addEventListener("click", function (event) {
    let clicDentroSelector = contenedorSelector.contains(event.target);
    if (!clicDentroSelector) {
        contenedorSelector.innerHTML = "";
    }
});
