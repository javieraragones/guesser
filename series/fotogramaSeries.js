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
    enlace.href = "/Guesser/series/fotogramaSeriesInfinito.php";
}
cambiarHref();

/* función que muestra la imagen 1 del reto diario */
async function selectorFotograma(columna) {
    try {
        const dia = getDiaActual();
        //Llamo a la API que está activa en el puerto 81 de mi ordenador gracias XAMPP
        const response = await fetch('http://localhost:81/serieFotogramas');
        //const response = await fetch(API_URL + '/serieFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-series-fotogramas');
        // recogemos del array el que contienen la fecha de hoy
        // fotogramasSeriesHoy contendrá el objeto con la serie de hoy
        const fotogramasSeriesHoy = array.find(prop => prop.fecha === dia);
        // Si hay alguna serie
        if (fotogramasSeriesHoy) {
            const imgURL = fotogramasSeriesHoy[columna]; // Obtener URL de la imagen desde la columna
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } else {
            /*Controlar que del actual disponga de un reto*/
            cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
            console.error(`Error: la columna ${columna} no existe en el objeto array.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
selectorFotograma('img1'); //Muestro la primera imagen

//FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
async function getRespuestaCorrecta() {
    try {
        const date = getDiaActual(); // Obtener el día actual
        //const response = await fetch(API_URL + '/series');
        const response = await fetch('http://localhost:81/serieFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;

        const fotogramasSeriesHoy = array.find((prop) => prop.fecha === date);
        const nombre = fotogramasSeriesHoy.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
        const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
        respuestaInput.value = nombre; // Establecer el valor del input
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
getRespuestaCorrecta();


//Función para realizar la navegación entre las imágenes de los retos
const nombresColumnasImagenes = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6'];
let indiceImagenActual = 0;
//let cantidadFallos = 0; // Llevar registro de la cantidad de fallos
// Obtener los botones de navegación
const btnImg1 = document.getElementById('btn-img1');
const btnImg2 = document.getElementById('btn-img2');
const btnImg3 = document.getElementById('btn-img3');
const btnImg4 = document.getElementById('btn-img4');
const btnImg5 = document.getElementById('btn-img5');
const btnImg6 = document.getElementById('btn-img6');
// Agregar evento click a cada botón de navegación
btnImg1.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[0]);
});
btnImg2.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[1]);
});
btnImg3.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[2]);
});
btnImg4.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[3]);
});
btnImg5.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[4]);
});
btnImg6.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[5]);
});



let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
let cuentaIntentosRestantes = 6;

// Función para mostrar el botón correspondiente según la cantidad de fallos
function mostrarBotonDesbloqueado(fallos) {
    const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
    if (fallos >= 0 && fallos < botones.length) {
        botones[fallos].style.display = 'inline-block';
    }
}

//Función que muestra la siguiente imagen al cometer un fallo
async function mostrarFotograma() {
    try {
        await selectorFotograma(`img${cantidadFallos + 1}`);
    } catch (error) {
        console.error(error);
        document.getElementById('imagen-fallo').src = 'https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg'; // cambia la ruta a la imagen que quieras mostrar
    }
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
        return;
    }
    mostrarBotonDesbloqueado(cantidadFallos);
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
        //Recorrer todos los botones y mostrarlos
        const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
        for (let i = 0; i < botones.length; i++) {
            botones[i].style.display = 'inline-block';
        }
    } else {
        //alert("Respuesta incorrecta. Inténtalo de nuevo.");
        //mensaje.innerHTML = "Respuesta incorrecta";
        //mensaje.style.color = "var(--color-fallo)"; // establecer color rojo para fallo
        cantidadFallos++;
        mostrarBotonDesbloqueado(cantidadFallos);
        if (cantidadFallos < 6) {
            mostrarFotograma();
        }
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        //historialIntentos.innerHTML += `<p>Intento ${cantidadFallos}: ${primeraLetraMayus(respuestaUsuario)}</p>`;
        //historialIntentos.innerHTML += `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        var respuestaHTML = "";
        if (respuestaUsuario === "") {
            respuestaHTML = "<p>Respuesta vacía</p>";
        } else {
            respuestaHTML = `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        }
        // Inserta la respuesta al principio del historial
        historialIntentos.insertAdjacentHTML("afterbegin", respuestaHTML);
        // Actualiza los intentos restantes
        cuentaIntentosRestantes--;
    }
    if (cuentaIntentosRestantes == 0) {
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
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
/*----------------Funciones para buscar títulos que coinciden con la entrada y mostrarlos en un desplegable----------------*/

//FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
async function buscarTitulo(textoBusqueda) {
    if (textoBusqueda.length >= 1) {
        const response = await fetch('http://localhost:81/serieFotogramas');
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


/*
//envío de respuesta al presionar enter(no funciona-solucionar)
document.addEventListener("DOMContentLoaded", function () {
    var input = document.getElementById("input-buscador");
    input.addEventListener("keydown", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            comprobarRespuesta();
        }
    });
});
*/





/*--------------------------------------Función selectorFotograma incremento2--------------------------------------
//Función con la que muestro en el elemento caja reto la imagen del reto
async function selectorFotograma(columna) {
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
        if (array[0].hasOwnProperty(columna)) { // Verificar si la columna existe en el objeto array
            const imgURL = array[0][columna]; // Obtener URL de la imagen desde la columna
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } else {
            console.error(`Error: la columna ${columna} no existe en el objeto array.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
selectorFotograma('img1'); //Muestro la primera imagen
*/


/*--------------------------------------Función buscar títulos y mostrar en desplegable incremento2


//FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
function buscarTitulo(textoBusqueda) {
    if (textoBusqueda.length >= 1) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "buscarTituloFotograma.php", true);
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










/* -------------------Versión 1 modo de juego  series fotogramas funcional-------------------

//Función con la que muestro en el elemento caja reto la imagen del reto
async function selectorFotograma(columna) {
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
        if (array[0].hasOwnProperty(columna)) { // Verificar si la columna existe en el objeto array
            const imgURL = array[0][columna]; // Obtener URL de la imagen desde la columna
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } else {
            console.error(`Error: la columna ${columna} no existe en el objeto array.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
//Función para realizar la navegación entre las imágenes de los retos
const nombresColumnasImagenes = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6'];
// Obtener los botones de navegación
const btnImg1 = document.getElementById('btn-img1');
const btnImg2 = document.getElementById('btn-img2');
const btnImg3 = document.getElementById('btn-img3');
const btnImg4 = document.getElementById('btn-img4');
const btnImg5 = document.getElementById('btn-img5');
const btnImg6 = document.getElementById('btn-img6');
const imagenFotograma = document.getElementById("imagen-fotograma");
let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
// Agregar evento click a cada botón de navegación
btnImg1.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[0]);
});
btnImg2.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[1]);
});
btnImg3.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[2]);
});
btnImg4.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[3]);
});
btnImg5.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[4]);
});
btnImg6.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[5]);
});
// Función para mostrar la imagen correspondiente según la cantidad de fallos
function mostrarImagenBoton(fallos) {
    const imagenes = ["url('https://i.imgur.com/rP3ZI5K.png')", "url('https://i.imgur.com/70VWYjC.png')", "url('https://i.imgur.com/lmJhG6R.png')", "url('https://i.imgur.com/l4aUz3q.png')", "url('https://i.imgur.com/IRH6sOv.png')", "url('https://i.imgur.com/NzHDoJp.png')"];
    // Establecer la imagen correspondiente
    if (fallos >= 0 && fallos < imagenes.length) {
        imagenFotograma.style.backgroundImage = imagenes[fallos];
    }
}
// Función para mostrar el botón correspondiente según la cantidad de fallos
function mostrarBotonDesbloqueado(fallos) {
    const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
    if (fallos >= 0 && fallos < botones.length) {
        botones[fallos].style.display = 'inline-block';
    }
}
// Función para seleccionar el fotograma correspondiente según la cantidad de fallos
function selectorFotograma(fallos) {
    const fotogramas = document.querySelectorAll(".fotogramas");
    if (fallos >= 0 && fallos < fotogramas.length) {
        fotogramas.forEach(function (fotograma) {
            fotograma.style.display = 'none';
        });
        fotogramas[fallos].style.display = 'block';
    }
}
//FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
async function getRespuestaCorrecta() {
    try {
        //const response = await fetch(API_URL + '/series');
        const response = await fetch('http://localhost:81/serieFotogramas');
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

//let cantidadFallos = 0; // Cuento la cantidad de fallos para ir mostrando las imágenes
// Función para mostrar el botón correspondiente según la cantidad de fallos
function mostrarBotonDesbloqueado(fallos) {
    const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
    if (fallos >= 0 && fallos < botones.length) {
        botones[fallos].style.display = 'inline-block';
    }
}
function comprobarRespuesta() {
    mostrarBotonDesbloqueado(cantidadFallos);
    // Obtener la respuesta del usuario
    var respuestaUsuario = document.querySelector(".input-buscador").value.toLowerCase();
    // Obtener la respuesta correcta
    var respuestaCorrecta = document.getElementById("respuesta-correcta").value.toLowerCase();
    // Comparar las respuestas
    if (respuestaUsuario === respuestaCorrecta) {
        alert("¡Respuesta correcta!");
    } else {
        alert("Respuesta incorrecta. Inténtalo de nuevo.");
        cantidadFallos++;
        mostrarBotonDesbloqueado(cantidadFallos);
        mostrarImagenBoton(cantidadFallos);
        selectorFotograma(cantidadFallos + 1);
    }
}
//FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
function buscarTitulo(textoBusqueda) {
    if (textoBusqueda.length >= 2) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "buscar_titulo.php", true);
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
            htmlResultados += "<li><a href=\"#\" onclick=\"seleccionarResultado('" + resultados[i] + "')\">" + resultados[i] + "</a></li>";
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