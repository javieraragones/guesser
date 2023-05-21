let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
let cuentaIntentosRestantes = 6; //inicio la cantidad de intentos que le quedan al usuario

let arrayPersonajes = [];
let retoCount = 0;

async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/serieRandomPersonaje');
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


async function ejecutar() {
    await obtenerReto();
    console.log(arrayPersonajes);
    selectorFotograma(retoCount);
}

ejecutar();

/* función que muestra la imagen  del reto  */
async function selectorFotograma(retoCount) {

    const retoSeleccionado = arrayPersonajes[retoCount];
    console.log(retoCount);
    const cajaReto = document.getElementById('caja-reto-series-personaje');
    //guardar respuesta correcta
    const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
    const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
    respuestaInput.value = nombre; // Establecer el valor del input

    if (retoSeleccionado && retoSeleccionado.hasOwnProperty('img')) {
        const imgURL = retoSeleccionado.img; // Obtener URL de la imagen desde la columna del reto seleccionado
        cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
        cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
        cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja
        const x = Math.floor(Math.random() * (cajaReto.offsetWidth - cajaReto.offsetWidth * 0.5));
        const y = Math.floor(Math.random() * (cajaReto.offsetHeight - cajaReto.offsetHeight * 0.5));
        cajaReto.style.backgroundPosition = `-${x}px -${y}px`; // Establecer una posición aleatoria para la imagen de fondo
        cajaReto.style.backgroundSize = '850%'; // Aumentar el zoom
    } else {
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        console.error(`Error: la columna ${columna} no existe en el objeto reto seleccionado.`);
    }
}

//función que pasa al siguietne reto
function mostrarRetoSiguiente() {
    mostrarPaginaAnterior();
    retoCount++;
    if (retoCount >= arrayPersonajes.length) {
        mostrarPaginaAnterior();
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        document.querySelector('.boton-buscar').disabled = true; // Deshabilitar el botón de envio de respuesta
        const cajaReto = document.getElementById('caja-reto-series-personaje');
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        cajaReto.style.backgroundSize = 'cover';
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Has realizado todos los retos disponibles";
        mensaje.style.color = "white"; // establecer color 
        const mensaje2 = document.querySelector('.intentos-restantes');
        mensaje2.style.display = 'none';
    } else {
        selectorFotograma(retoCount);
        console.log(retoCount)
        $('#caja-reto-series-personaje').css('background-size', '850%');
    }
}

function zoomImagen() {
    const cajaReto = $('#caja-reto-series-personaje');
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
    const cajaReto = $('#caja-reto-series-personaje');

    // Establecer el tamaño del contenedor al 100% del tamaño disponible
    cajaReto.css({
        'width': '100%',
        'height': '100%'
    });

    // Establecer el tamaño de la imagen de fondo para que cubra completamente el contenedor
    cajaReto.css({
        'background-size': 'cover',
        'background-position': 'center' // Centrar la imagen
    });
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

function mostrarPaginaAnterior() {
    // Restaurar los cambios realizados al acertar el reto
    const mensaje = document.querySelector('.mensaje-envio-respuesta');
    mensaje.style.display = 'none';

    // Restablecer el estilo de la caja del reto
    const cajaReto = document.getElementById('caja-reto-series-personaje');
    cajaReto.style.backgroundImage = 'none';
    cajaReto.style.backgroundColor = 'transparent';

    // Ocultar el botón de "Mostrar Reto Siguiente"
    const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
    botonSiguiente.style.display = 'none';

    // Habilitar el campo de entrada de texto
    document.querySelector(".input-buscador").disabled = false;
    document.querySelector('.boton-buscar').disabled = false; // Deshabilitar el botón de envio de respuesta 
    //limpiar historial
    var historial = document.getElementById("historial-intentos");
    historial.innerHTML = "";


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
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        document.querySelector('.boton-buscar').disabled = true; // Deshabilitar el botón de envio de respuesta          
        //document.querySelector('.cuadro-busqueda').style.display = 'none';
        //alert("¡Respuesta correcta!");

        //muestra la imagen completa
        imagenCompleta();

        //reinicio la cantidad de fallos y los intentos restantes
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        //mostrar siguiente reto
        const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
        botonSiguiente.style.display = 'inline-block';
    } else {
        cantidadFallos++;
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
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
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Respuesta correcta: " + primeraLetraMayus(respuestaCorrecta);
        mensaje.style.color = "white"; // establecer color 
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        document.querySelector('.boton-buscar').disabled = true; // Deshabilitar el botón de envio de respuesta
        //muestra la imagen completa
        imagenCompleta();

        //boton para reiniciar 
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        const botonReiniciar = document.querySelector('#btn-reiniciar-modo-infinito');
        botonReiniciar.style.display = 'inline-block';
        var btnReiniciar = document.getElementById("btn-reiniciar-modo-infinito");
        btnReiniciar.addEventListener("click", function () {
            location.reload();
        });
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
//Función para que se cierre el desplegable al hacer click fuera de él
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


let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
let cuentaIntentosRestantes = 6; //inicio la cantidad de intentos que le quedan al usuario

let retoId; // Variable para almacenar los objetos retos
let arrRetos = [];
// solución óptima
// Se debe traer un arr completo de todos los personajes
// let arrayPersonajes = []; el array de obj tiene que venir ordernado aleatoriamente
// let retoCount = 0; se pìlla el primero (retoCount); retoCount++
// cuando se termina

// arrayPersonajes[retoCount].image

//solución 1
async function getPersonajeRandom() {
    const response = await fetch('http://localhost:81/serieRandomPersonaje');
    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }
    const data = await response.json();
    const array = data.message;
    return array
}

async function obtenerReto() {
    try {
        let ID
        do {
            const personaje = await getPersonajeRandom()
            ID = personaje[0].id;
        } while (arrRetos.includes(ID))
        retoId = ID;
        //console.log(ID);
        arrRetos.push(retoId);
        //console.log(arrRetos);
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
/*
async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/serieRandomPersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        //console.log(data)
        const ID = array[0].id;
        if (ID && !arrRetos.includes(ID)) {
            retoId = ID;
            //console.log(ID);
            arrRetos.push(retoId);
            //console.log(arrRetos);
        } else {
            console.error(`Error: No se encontró un reto con el ID especificado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

async function ejecutar() {
    await obtenerReto();
    //console.log(retoId);
    // arrRetos.push(retoId);
    //console.log(arrRetos);
    selectorFotograma(retoId);
}

ejecutar();

/función que muestra la imagen  del reto  
async function selectorFotograma(retoId) {
    try {
        const response = await fetch('http://localhost:81/seriePersonaje');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-series-personaje');
        const retoSeleccionado = array.find(prop => prop.id === retoId); // Buscar el objeto con el id especificado
        console.log(retoSeleccionado)
        //guardar respuesta correcta
        const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
        const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
        respuestaInput.value = nombre; // Establecer el valor del input
        if (retoSeleccionado && retoSeleccionado.hasOwnProperty('img')) {
            const imgURL = retoSeleccionado.img; // Obtener URL de la imagen desde la columna del reto seleccionado
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja

            const x = Math.floor(Math.random() * (cajaReto.offsetWidth - cajaReto.offsetWidth * 0.5));
            const y = Math.floor(Math.random() * (cajaReto.offsetHeight - cajaReto.offsetHeight * 0.5));
            cajaReto.style.backgroundPosition = `-${x}px -${y}px`; // Establecer una posición aleatoria para la imagen de fondo

            cajaReto.style.backgroundSize = '850%'; // Aumentar el zoom
        } else {
            cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
            console.error(`Error: la columna ${columna} no existe en el objeto reto seleccionado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

*/
/*
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

async function mostrarPersonaje(retoId) {
    try {
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