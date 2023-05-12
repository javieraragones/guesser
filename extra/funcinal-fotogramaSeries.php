<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->



<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">

</div>

<div class="historial-pistas">

</div>

<div class="cuadro-busqueda"> <!-- Input text para buscador-->
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar...">
        <button class="search__btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
                <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z" fill="#efeff1"></path>
            </svg>
        </button>
    </div>
</div>

<div class="historial-intentos">
    Aquí se muestran los inputs de los intentos fallidos.
</div>

<div class="intentos-restantes">
    <p>Intentos restantes:</p>
</div>

</div>

</div>
</body>

</html>



<script>
    async function getFotogramas() {
        try {
            const response = await fetch('http://localhost:81/serieFotogramas');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            const array = data.message;
            const cajaReto = document.getElementById('caja-reto-series-fotogramas');
            const imgURL = array[0].img1; // Obtener URL de la imagen desde la columna "img1"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getFotogramas();
</script>


<script>
    //barra de búsqueda sugerencias de títulos
    function buscarTitulo(textoBusqueda) {
        if (textoBusqueda.length >= 2) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_titulo.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    mostrarResultados(this.responseText);
                }
            };
            xhr.send("textoBusqueda=" + textoBusqueda);
        } else {
            document.getElementById("resultados-busqueda").innerHTML = "";
        }
    }

    function mostrarResultados(textoRespuesta) {
        const resultados = JSON.parse(textoRespuesta);
        let htmlResultados = "";
        if (resultados.length > 0) {
            htmlResultados += "<ul>";
            for (let i = 0; i < resultados.length; i++) {
                htmlResultados += "<li>" + resultados[i] + "</li>";
            }
            htmlResultados += "</ul>";
        } else {
            htmlResultados += "<p>No se encontraron resultados.</p>";
        }
        document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
    }
</script>




<?php /*Funciones emojiseries
    exit(var_dump(API_URL));
    include_once('../funcionesPHP/conexion.php');
    // Crear una instancia de la clase ConectarDB
    $conexion = new ConectarDB();
    $conn = $conexion->conectar();
    // Realizar la consulta para obtener un elemento aleatorio de la tabla "emojis_serie"
    $sql = "SELECT * FROM emojis_serie ORDER BY RAND() LIMIT 1"; // Seleccionar un elemento aleatorio de la tabla
    $stmt = $conn->query($sql);
    $resultado = $stmt->fetch();
    if ($resultado) : ?>
        <h1><?php echo $resultado['emoji']; ?></h1> <!-- Muestra el elemento -->
    <?php else : ?>
        <p>No se encontraron elementos</p>
        <?php endif; ?><?php
                        // Cerrar la conexión a la base de datos
                        $conexion->cerrar();
                        */ ?>
/*async function getEmojis() {
try {
const response = await fetch(API_URL + '/series')
if (!response.ok) {
throw new Error(`HTTP error! Status: ${response.status}`);
}
const data = await response.json();
// console.log(data)
for (let a of data.message) {
console.log(a.emoji)
}
} catch (error) {
console.error(`Error fetching data: ${error}`);
}
}
getEmojis()



/*
----------------------------------------------funciones iniciales serieEmojis----------------------------------------------

async function getEmojis() {
try {
// ARREGLAR RUTAS, PARA QUE LUEGO ESTÉ ASÍ
// const response = await fetch(API_URL + '/series')
const response = await fetch('http://localhost:81/serieEmojis')
if (!response.ok) {
throw new Error(`HTTP error! Status: ${response.status}`);
}
const data = await response.json();
const array = data.message;
const cajaReto = document.getElementById('caja-reto-series-emojis');
// const serieRandom = getSerieRandom(data.series);
let emojis = array[0].emoji; // cadena con dos emojis
// regex es un formateo de datos
const regex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g;
const emojiArray = emojis.match(regex);
console.log(emojiArray); // ['\ud83e\udd91', '\ud83c\udfae']
cajaReto.innerHTML = emojiArray.join('');
} catch (error) {
console.error(`Error fetching data: ${error}`);
}
}

//getEmojis()

//Función funcional inicial emojis
async function selectorEmojis(posicion) {
try {
// ARREGLAR RUTAS, PARA QUE LUEGO ESTÉ ASÍ
// const response = await fetch(API_URL + '/series')
const response = await fetch('http://localhost:81/serieEmojis')
if (!response.ok) {
throw new Error(`HTTP error! Status: ${response.status}`);
}
const data = await response.json();
const array = data.message;
const cajaReto = document.getElementById('caja-reto-series-emojis');
// const serieRandom = getSerieRandom(data.series);
let emojis = array[0].emoji; // cadena con dos emojis
// regex es un formateo de datos
const regex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g;
const emojiArray = emojis.match(regex);
console.log(emojiArray); // ['\ud83e\udd91', '\ud83c\udfae']
cajaReto.innerHTML = emojiArray[posicion];
} catch (error) {
console.error(`Error fetching data: ${error}`);
}
}
//selectorEmojis(0);
/*COMPROBAR RESPUESTA FUNCIONAL

function comprobarRespuesta() {

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
//Recorrer todos los botones y mostrarlos
const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
for (let i = 0; i < botones.length; i++) { botones[i].style.display='inline-block' ; } } else { //alert("Respuesta incorrecta. Inténtalo de nuevo."); mensaje.innerHTML="Respuesta incorrecta" ; mensaje.style.color="red" ; // establecer color rojo para fallo cantidadFallos++; mostrarEmoji(); // Añade la respuesta al historial var historialIntentos=document.getElementById("historial-intentos"); historialIntentos.innerHTML +=`<p>Intento ${cantidadFallos}: ${primeraLetraMayus(respuestaUsuario)}</p>`;

    // Actualiza los intentos restantes
    cuentaIntentosRestantes--;
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
    */
    */



    <?php /* ----------------------------------------------Funciones fotogramaSeries----------------------------------------------
include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->

<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">
</div>

<div class="historial-pistas">
</div>

<div class="cuadro-busqueda">
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar..." onkeyup="buscarTitulo(this.value)">
        <div id="resultados-busqueda"></div>
    </div>
</div>

<script>

    function buscarTitulo(textoBusqueda, inputText) {
        if (textoBusqueda.length >= 2) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_titulo.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    mostrarResultados(this.responseText);
                }
            };
            xhr.send("textoBusqueda=" + textoBusqueda + "&inputText=" + inputText);
        } else {
            document.getElementById("resultados-busqueda").innerHTML = "";
        }
    }


    /*
    function buscarTitulo(textoBusqueda) {
        if (textoBusqueda.length >= 2) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_titulo.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    mostrarResultados(this.responseText);
                }
            };
            xhr.send("textoBusqueda=" + textoBusqueda);
        } else {
            document.getElementById("resultados-busqueda").innerHTML = "";
        }
    }
    

    function mostrarResultados(textoRespuesta) {
        const resultados = JSON.parse(textoRespuesta);
        let htmlResultados = "";
        if (resultados.length > 0) {
            htmlResultados += "<ul>";
            for (let i = 0; i < resultados.length; i++) {
                htmlResultados += "<li>" + resultados[i] + "</li>";
            }
            htmlResultados += "</ul>";
        } else {
            htmlResultados += "<p>No se encontraron resultados.</p>";
        }
        document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
    }
</script>

<div class="historial-intentos">
    Aquí se muestran los inputs de los intentos fallidos.
</div>

<div class="intentos-restantes">
    <p>Intentos restantes:</p>
</div>

</div>

</div>
</body>

</html>

<>
    async function getFotogramas() {
        try {
            const response = await fetch('http://localhost:81/serieFotogramas');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            const array = data.message;
            const cajaReto = document.getElementById('caja-reto-series-fotogramas');
            const imgURL = array[0].img1; // Obtener URL de la imagen desde la columna "img1"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getFotogramas();
</script>
;?>






    /*
    
    //----TRABAJAR EN ESTA FUNCIÓN PARA FINALIZARLA Y QUE FUNCIONE CORRECTAMENTE----
    function enviarRespuesta(respuesta) {
        const inputText = document.querySelector('.input-buscador');
        const respuestaTrim = respuesta.trim().toLowerCase();

        if (respuestaTrim === '') {
            alert('Debe ingresar una respuesta');
            return;
        }

        // Obtener el valor de la respuesta correcta del input hidden
        const respuestaCorrecta = document.getElementById('respuesta-correcta').value.trim().toLowerCase();

        if (respuestaTrim === respuestaCorrecta) {
            inputText.value = '';
            mostrarMensaje('¡Correcto!', 'mensaje-exito');
        } else {
            inputText.value = '';
            mostrarMensaje('¡Incorrecto!', 'mensaje-error');
        }

        const historialIntentos = document.querySelector('.historial-intentos');
        const nuevoIntento = document.createElement('div');
        nuevoIntento.classList.add('intento-fallido');
        nuevoIntento.innerText = respuestaTrim;
        historialIntentos.appendChild(nuevoIntento);

        const intentosRestantes = document.querySelector('.intentos-restantes');
        const numeroIntentos = intentosRestantes.querySelector('span');
        const intentosRestantesValor = parseInt(numeroIntentos.innerText);
        numeroIntentos.innerText = intentosRestantesValor - 1;

        if (intentosRestantesValor - 1 === 0) {
            inputText.disabled = true;
            mostrarMensaje('¡Lo siento, has agotado tus intentos!', 'mensaje - error ');
        }
    }

    function mostrarMensaje(texto, clase) {
        const mensaje = document.createElement('div');
        mensaje.classList.add('mensaje');
        mensaje.classList.add(clase);
        mensaje.innerText = texto;

        const cajaReto = document.getElementById('caja-reto-series-fotogramas');
        cajaReto.appendChild(mensaje);

        setTimeout(() => {
            cajaReto.removeChild(mensaje);
        }, 3000);
    }
    */


    /*---------Función con la que muestro en el elemento caja reto la imagen del reto---------
    //Función con la que muestro en el elemento caja reto la imagen del reto
    async function getFotogramas() {
        try {
            //Llamo a la API que está activa en el puerto 81 de mi ordenador gracias XAMPP
            const response = await fetch('http://localhost:81/serieFotogramas');
            //const response = await fetch(API_URL + '/serieFotogramas');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            const array = data.message;
            const cajaReto = document.getElementById('caja-reto-series-fotogramas');
            const imgURL = array[0].img1; // Obtener URL de la imagen desde la columna "img1"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getFotogramas();
    */
/*


----------------------------------------------PERSONAJE----------------------------------------------

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
async function getPersonaje() {
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
        cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
        // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
        cajaReto.style.backgroundColor = 'black';
        cajaReto.style.filter = 'blur(7px)'; // Aplicar filtro
        const x = Math.floor(Math.random() * (cajaReto.offsetWidth - cajaReto.offsetWidth * 0.5));
        const y = Math.floor(Math.random() * (cajaReto.offsetHeight - cajaReto.offsetHeight * 0.5));
        cajaReto.style.backgroundPosition = `-${x}px -${y}px`;
        cajaReto.style.backgroundSize = '150%'; // Aumentar el zoom
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

getPersonaje();

function zoomImagen() {
    const cajaReto = $('#caja-reto-series-personaje');
    const img = cajaReto.css('background-image');

    // Calcular un valor aleatorio para el zoom
    const maxZoom = 2;
    const zoom = Math.floor(Math.random() * maxZoom) + 1;

    // Animar el tamaño de la imagen
    cajaReto.animate({
        'background-size': `${zoom * 100}%`,
    }, 1000, 'swing');
}

let fallos = 0;
const factorReduccion = 0.8;

function comprobarRespuesta() {
    // Lógica para comprobar respuesta
    if (respuestaCorrecta) {
        // Lógica para respuesta correcta
    } else {
        fallos++;
        const zoomActual = parseInt($('#caja-reto-series-personaje').css('background-size'));
        const zoomNuevo = Math.floor(zoomActual * factorReduccion);
        $('#caja-reto-series-personaje').animate({
            'background-size': `${zoomNuevo}%`,
        }, 1000, 'swing');
    }
}

*/
//función para poner la primera letra mayúscula
function primeraLetraMayus(str) {
    return str.replace(
        /\w\S*/g,
        function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}
/*


function comprobarRespuesta() {
    // Verificar si se han agotado los intentos

    if (cuentaIntentosRestantes <= 0) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
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
    if (textoBusqueda.length >= 2) {
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



*/ 
