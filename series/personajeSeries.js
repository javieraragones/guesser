let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
let cuentaIntentosRestantes = 6; //inicio la cantidad de intentos que le quedan al usuario
/*Función para obtener el día actual*/
function getDiaActual() {
    const today = new Date();
    const month = (today.getMonth() + 1).toString().padStart(2, '0');
    const day = today.getDate().toString().padStart(2, '0');
    const year = today.getFullYear();
    const date = `${year}-${month}-${day}`;
    return date;
}
// Función para cambiar el valor de href del enlace con id "btn-infinito"
function cambiarHref() {
    var enlace = document.getElementById("btn-infinito");
    enlace.href = "/Guesser/series/personajeSeriesInfinito.php";
}
cambiarHref();
//FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
async function getRespuestaCorrecta() {
    try {
        const dia = getDiaActual();
        //const response = await fetch(API_URL + '/series');
        const response = await fetch('http://localhost:81/seriePersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;

        const respuestaCorrectaHoy = array.find(prop => prop.fecha === dia); // Encuentra el objeto con fecha igual al día de hoy
        if (respuestaCorrectaHoy) {
            const nombre = respuestaCorrectaHoy.nombre; // Obtener valor de la columna "nombre" del objeto encontrado
            const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
            respuestaInput.value = nombre; // Establecer el valor del input
        } else {
            console.error(`Error: No se encontró un objeto con la fecha ${dia}.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
getRespuestaCorrecta();

async function mostrarPersonaje() {
    try {
        const dia = getDiaActual();
        const response = await fetch('http://localhost:81/seriePersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;

        const personajeHoy = array.find(prop => prop.fecha === dia); // Encuentra el objeto con fecha igual al día de hoy
        if (personajeHoy) {
            const cajaReto = document.getElementById('caja-reto-series-personaje');
            const imgURL = personajeHoy.img; // Obtener URL de la imagen desde la columna "img"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja

            const x = Math.floor(Math.random() * (cajaReto.offsetWidth - cajaReto.offsetWidth * 0.5));
            const y = Math.floor(Math.random() * (cajaReto.offsetHeight - cajaReto.offsetHeight * 0.5));
            cajaReto.style.backgroundPosition = `-${x}px -${y}px`; // Establecer una posición aleatoria para la imagen de fondo

            cajaReto.style.backgroundSize = '850%'; // Aumentar el zoom
        } else {
            console.error(`Error: No se encontró un objeto con la fecha ${dia}.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}


mostrarPersonaje();

function zoomImagen() {
    const cajaReto = $('#caja-reto-series-personaje');
    const img = cajaReto.css('background-image');

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
const factorReduccion = 0.7;

function reducirZoom() {
    const zoomActual = parseInt($('#caja-reto-series-personaje').css('background-size'));
    const zoomNuevo = (zoomActual * factorReduccion);
    /*
    $('#caja-reto-series-personaje').animate({
        'background-size': `${zoomNuevo}%`,
    }, 1000, 'swing');
    */
    $('#caja-reto-series-personaje').css(
        'background-size', `${zoomNuevo}%`);
}
function imagenCompleta() {
    $('#caja-reto-series-personaje').css('background-size', '100%');
}

//función para poner la primera letra mayúscula
function primeraLetraMayus(str) {
    return str.replace(
        /\w\S*/g,
        function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}


function comprobarRespuesta() {
    // Verificar si se han agotado los intentos

    if (cuentaIntentosRestantes <= 0) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        cajaReto.style.backgroundImage = `url('${imgURL}')`;
        return;
    }
    // Obtener la respuesta del usuario
    var respuestaUsuario = document.querySelector(".input-buscador").value.toLowerCase();
    // Obtener la respuesta correcta
    var respuestaCorrecta = document.getElementById("respuesta-correcta").value.toLowerCase();
    // Comparar las respuestas
    var mensaje = document.querySelector(".mensaje-envio-respuesta");
    mensaje.style.fontSize = "24px";
    if (respuestaUsuario === respuestaCorrecta) {
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        //Si el usuario ha acertado, muestra un mensaje de éxito y oculta el input de texto
        mensaje.innerHTML = "¡Respuesta correcta! : " + primeraLetraMayus(respuestaCorrecta);
        mensaje.style.color = "green"; // establecer color verde para acierto            
        document.querySelector('.cuadro-busqueda').style.display = 'none';
        //alert("¡Respuesta correcta!");
        //muestra la imagen completa
        imagenCompleta();

    } else {
        //alert("Respuesta incorrecta. Inténtalo de nuevo.");
        //mensaje.innerHTML = "Respuesta incorrecta";
        //mensaje.style.color = "var(--color-fallo)"; // establecer color rojo para fallo
        cantidadFallos++;
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        //historialIntentos.innerHTML += `<p>Intento ${cantidadFallos}: ${primeraLetraMayus(respuestaUsuario)}</p>`;
        //historialIntentos.innerHTML += `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        //cada vez que se falla, se muestra desde el principio hasta cantidad de fallos +1
        // Actualiza los intentos restantes
        if (respuestaUsuario === "") {
            historialIntentos.innerHTML += "<p>Respuesta vacía</p>";
        } else {
            historialIntentos.innerHTML += `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        }
        cuentaIntentosRestantes--;
        //se reduce el zoom
        reducirZoom();
    }
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes == 0) {
        //alert("Ya has alcanzado el límite de intentos. ¡Inténtalo de nuevo más tarde!");
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Respuesta correcta: " + primeraLetraMayus(respuestaCorrecta);
        mensaje.style.color = "white"; // establecer color 
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        //muestra la imagen completa
        imagenCompleta();
    }
    var intentosRestantes = document.getElementById("num-intentos-restantes");
    intentosRestantes.innerHTML = cuentaIntentosRestantes.toString();
    //Deja el cuadro de respuesta vacío
    document.querySelector(".input-buscador").value = "";
}
function mostrarIntentosRestantes(cuentaIntentosRestantes) {
    // Muestra los intentos restantes al cargar la página
    var intentosRestantes = document.getElementById("num-intentos-restantes");
    intentosRestantes.innerHTML = cuentaIntentosRestantes.toString();
}
/*----------------Funciones para buscar títulos que coinciden con la entrada y mostrarlos en un desplegable----------------*/
//FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
async function buscarTitulo(textoBusqueda) {
    if (textoBusqueda.length >= 1) {
        const response = await fetch('http://localhost:81/seriePersonaje');
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


//funciones antes de incremento 3
/*
async function getRespuestaCorrecta() {
    try {
        //const response = await fetch(API_URL + '/series');
        const response = await fetch('http://localhost:81/seriePersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const nombre = array[0].nombre; // Obtener valor de la columna "nombre"
        const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
        respuestaInput.value = nombre; // Establecer el valor del input
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
getRespuestaCorrecta();
async function mostrarPersonaje() {
    try {
        const response = await fetch('http://localhost:81/seriePersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-series-personaje');
        const imgURL = array[0].img; // Obtener URL de la imagen desde la columna "img1"
        cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
        cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
        //cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
        // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
        cajaReto.style.backgroundColor = 'black';
        cajaReto.style.backgroundFilter = 'blur(7px)'; // Aplicar filtro
        const x = Math.floor(Math.random() * (cajaReto.offsetWidth - cajaReto.offsetWidth * 0.5));
        const y = Math.floor(Math.random() * (cajaReto.offsetHeight - cajaReto.offsetHeight * 0.5));
        cajaReto.style.backgroundPosition = `-${x}px -${y}px`;
        cajaReto.style.backgroundSize = '850%'; // Aumentar el zoom
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
 */