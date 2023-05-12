let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
let cuentaIntentosRestantes = 6; //inicio la cantidad de intentos que le quedan al usuario

//FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
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


mostrarPersonaje();

function zoomImagen() {
    const cajaReto = $('#caja-reto-series-personaje');
    const img = cajaReto.css('background-image');

    // Calcular un valor aleatorio para el zoom
    const maxZoom = 10;
    const zoom = Math.floor(Math.random() * maxZoom) + 1;

    // Aplicar el tamaño de la imagen
    cajaReto.css({
        'background-size': `${zoom * 100}%`,
        'background-filter': 'blur(7px)',
    });

    // Agregar propiedad image-rendering a la imagen
    cajaReto.css('image-rendering', 'pixelated');

    // Animar el tamaño de la imagen
    cajaReto.animate({

        "background-size": `${zoom * 100}%`,
        "background-filter": "blur(7px)",
        "background-position-x": `50%`,
        "background-position-y": `50%`
    }, 1000, 'swing', function () {
        // Eliminar la propiedad image-rendering al terminar la animación
        cajaReto.css('image-rendering', '');
    });
}


zoomImagen();
const factorReduccion = 0.7;

function reducirZoom() {
    const zoomActual = parseInt($('#caja-reto-series-personaje').css('background-size'));
    const zoomNuevo = Math.floor(zoomActual * factorReduccion);
    $('#caja-reto-series-personaje').animate({
        'background-size': `${zoomNuevo}%`,
    }, 1000, 'swing');
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
        //Si el usuario ha acertado, muestra un mensaje de éxito y oculta el input de texto
        mensaje.innerHTML = "¡Respuesta correcta! : " + primeraLetraMayus(respuestaCorrecta);
        mensaje.style.color = "green"; // establecer color verde para acierto            
        document.querySelector('.cuadro-busqueda').style.display = 'none';
        //alert("¡Respuesta correcta!");
    } else {
        //alert("Respuesta incorrecta. Inténtalo de nuevo.");
        mensaje.innerHTML = "Respuesta incorrecta";
        mensaje.style.color = "red"; // establecer color rojo para fallo
        cantidadFallos++;
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        historialIntentos.innerHTML += `<p>Intento ${cantidadFallos}: ${primeraLetraMayus(respuestaUsuario)}</p>`;
        //cada vez que se falla, se muestra desde el principio hasta cantidad de fallos +1
        // Actualiza los intentos restantes
        cuentaIntentosRestantes--;
        //se reduce el zoom
        reducirZoom();
    }
    // Verificar si se han agotado los intentos
    if (cuentaIntentosRestantes == 0) {
        //alert("Ya has alcanzado el límite de intentos. ¡Inténtalo de nuevo más tarde!");
        mensaje.innerHTML = "Respuesta correcta: " + primeraLetraMayus(respuestaCorrecta);
        mensaje.style.color = "white"; // establecer color 
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
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

//FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
function buscarTitulo(textoBusqueda) {
    if (textoBusqueda.length >= 1) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "buscarTitulopersonaje.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                mostrarResultados(this.responseText);
            }
        };
        xhr.send("textoBusqueda=" + textoBusqueda);
    } else {
        document.getElementById("resultados-busqueda").innerHTML = "";
    }
}

//FUNCIÓN QUE MUESTRA LOS RESULTADOS DE LOS TÍTULOS QUE COINCIDEN EN UN DESPLEGABLE
function mostrarResultados(textoRespuesta) {
    const resultados = JSON.parse(textoRespuesta);
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
