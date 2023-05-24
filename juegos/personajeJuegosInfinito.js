//Iniciamos las variables cantidadFallos y cuentaIntentosRestantes
let cantidadFallos = 0; // Contador para llevar el registro de la cantidad de fallos ocurridos
let cuentaIntentosRestantes = 6; // Cantidad de intentos restantes para el usuario

let arrayPersonajes = []; // Array que contendrá los retos de emojis en un orden aleatorio
let retoCount = 0; // Contador de retos actualmente mostrados, inicia en 0


// Función asíncrona para llenar el arrayPersonajes de retos. Se obtienen todos los retos ordenados aleatoriamente de la API
async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/juegoRandomPersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;

        array.forEach((personaje) => {
            arrayPersonajes.push(personaje);
        });
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

// Función asincrónica que coordina la ejecución de otras funciones
// Como trabajamos con funciones asíncronas, en esta función se espera a que se ejecute la función obtenerReto() y después de ejecuta mostrarEmojis()
async function ejecutar() {
    await obtenerReto();
    console.log(arrayPersonajes);
    selectorFotograma(retoCount);
}
ejecutar(); // Llamamos a la función para que se muestre la primera pista

// Función que muestra una imagen de un personaje con aumento realizado
async function selectorFotograma(retoCount) {
    const retoSeleccionado = arrayPersonajes[retoCount];
    console.log(retoCount);
    const cajaReto = document.getElementById('caja-reto-juegos-personaje');
    // Guardar respuesta correcta
    const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
    const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
    respuestaInput.value = nombre; // Establecer el valor del input
    // Si hay alguna juego y el reto seleccionado tiene la propiedad 'img'...
    if (retoSeleccionado && retoSeleccionado.hasOwnProperty('img')) {
        const imgURL = retoSeleccionado.img; // Obtener URL de la imagen desde la columna del reto seleccionado
        cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
        cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
        cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja
        // Genera coordenadas aleatorias dentro de los límites de la caja de reto
        const x = Math.floor(Math.random() * (cajaReto.offsetWidth - cajaReto.offsetWidth * 0.5));
        const y = Math.floor(Math.random() * (cajaReto.offsetHeight - cajaReto.offsetHeight * 0.5));
        cajaReto.style.backgroundPosition = `-${x}px -${y}px`; // Establecer una posición aleatoria para la imagen de fondo
        cajaReto.style.backgroundSize = '850%'; // Aumentar el zoom
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
    if (retoCount >= arrayPersonajes.length) {
        mostrarPaginaAnterior();
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        document.querySelector('.boton-buscar').disabled = true; // Deshabilitar el botón de envio de respuesta
        const cajaReto = document.getElementById('caja-reto-juegos-personaje');
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        cajaReto.style.backgroundSize = 'contain';
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Has realizado todos los retos disponibles";
        mensaje.style.color = "white";
        const mensaje2 = document.querySelector('.intentos-restantes');
        mensaje2.style.display = 'none';
    } else {
        // Mientras queden retos disponibles, se muestra el siguiente reto
        selectorFotograma(retoCount);
        console.log(retoCount)
        $('#caja-reto-juegos-personaje').css('background-size', '850%');
    }
}

// Función que restaura los cambios realizados para cuando mostramos un nuevo reto
function mostrarPaginaAnterior() {

    // Restablecer el estilo y contenido de los mensajes
    const mensaje = document.querySelector('.mensaje-envio-respuesta');
    mensaje.style.display = 'none';

    // Restablecer el estilo de la caja del reto
    const cajaReto = document.getElementById('caja-reto-juegos-personaje');
    cajaReto.style.backgroundImage = 'none';
    cajaReto.style.backgroundColor = 'transparent';

    // Ocultar el botón de "Mostrar Reto Siguiente"
    const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
    botonSiguiente.style.display = 'none';

    // Habilitar el campo de entrada de texto
    document.querySelector(".input-buscador").disabled = false;
    document.querySelector('.boton-buscar').disabled = false; // Deshabilitar el botón de envio de respuesta 
    document.querySelector('.cuadro-busqueda').style.display = 'flex'; //Volvemos a mostrar el cuadro de búsqueda

    // Limpiar historial
    var historial = document.getElementById("historial-intentos");
    historial.innerHTML = "";
}

// Función con la que aplicamos modificaciones a la imagen del reto
function zoomImagen() {
    const cajaReto = $('#caja-reto-juegos-personaje');
    //const img = cajaReto.css('background-image');

    // Calcular un valor aleatorio para el zoom
    const maxZoom = 10;
    const zoom = maxZoom;
    // Aplicar el tamaño de la imagen
    cajaReto.css({
        'background-size': `${zoom * 100}%`,
        'background-filter': 'blur(57px)',
        "background-position-x": `50%`,
        "background-position-y": `50%`
    });
    // Agregar propiedad image-rendering a la imagen
    cajaReto.css('image-rendering', 'pixelated');
    // Animar el tamaño de la imagen
    cajaReto.animate({
        "background-size": `${zoom * 100}%`,
        "background-filter": "blur(7px)",
        "background-position-x": `50%`,
        "background-position-y": `50%`
    }, function () {
        // Eliminar la propiedad image-rendering al terminar la animación
        cajaReto.css('image-rendering', '');
    });
}
zoomImagen();

const factorReduccion = 0.7; // Indicamos el factor de reducción
// Función con la que reducimos el zoom 
function reducirZoom() {
    const zoomActual = parseInt($('#caja-reto-juegos-personaje').css('background-size'));
    const zoomNuevo = (zoomActual * factorReduccion);
    $('#caja-reto-juegos-personaje').css(
        'background-size', `${zoomNuevo}%`);
}

// Función con la que hacemos que la imagen se ajuste al cuadro para verla lo mejor posible, manteniendo la relación de aspecto
function imagenCompleta() {
    const cajaReto = $('#caja-reto-juegos-personaje');

    // Establecer el tamaño del contenedor al 100% del tamaño disponible
    cajaReto.css({
        'width': '100%',
        'height': '100%'
    });

    // Establecer el tamaño de la imagen de fondo para que cubra completamente el contenedor
    cajaReto.css({
        'background-size': 'contain',
        'background-position': 'center' // Centrar la imagen
    });
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

//Función con la que se comprueba la respuesta introducida por el usuario
function comprobarRespuesta() {
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes <= 0) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        cajaReto.style.backgroundImage = `url('${imgURL}')`;
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
        mensaje.style.color = "#5ad16e"; // establecer color verde para acierto 
        mensaje.style.fontSize = "22px"; // establecer tamaño fuente   
        imagenCompleta(); // Una vez terminado el intento, se muestra la imagen completa
        document.querySelector('.cuadro-busqueda').style.display = 'none'; //Desactivamos cuadro de búsqueda

        //Reinicio la cantidad de fallos y los intentos restantes
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        //mostrar siguiente reto
        const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
        botonSiguiente.style.display = 'inline-block';
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes
    } else {
        cantidadFallos++; // Aumento el contador de cantidad de fallos
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        var respuestaHTML = "";
        if (respuestaUsuario === "") {
            respuestaHTML = "<p>Respuesta vacía</p>"; // En caso de que el usuario no introduzca texto, se muestra "Respuesta vacía" en el historial
        } else {
            respuestaHTML = `<p>${primeraLetraMayus(respuestaUsuario)}</p>`; // Respuesta introducida errónea
        }
        historialIntentos.insertAdjacentHTML("afterbegin", respuestaHTML); // Inserta la respuesta al principio del historial
        cuentaIntentosRestantes--;
        reducirZoom(); // Se reduce el zoom
    }
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes == 0) {
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Respuesta correcta: <br> <span class='respuesta-correcta-mensaje'>" + primeraLetraMayus(respuestaCorrecta) + "</span>"; //Mensaje que indica la respuesta correcta
        mensaje.style.color = "white"; // establecer color 
        mensaje.style.fontSize = "22px"; // establecer tamaño fuente 
        document.querySelector('.cuadro-busqueda').style.display = 'none'; //Desactivamos cuadro de búsqueda
        imagenCompleta(); // Una vez terminado el intento, se muestra la imagen completa

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
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes
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
        const response = await fetch('http://localhost:81/juegoRandomPersonaje');
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
