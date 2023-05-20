
let retoId; // Variable para almacenar los objetos retos
let arrRetos = [];

async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/serieRandomFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        console.log(data)
        const ID = array[0].id;
        if (ID && !arrRetos.includes(ID)) {
            retoId = ID;
            console.log(ID);
            arrRetos.push(retoId);
            console.log(arrRetos);
        } else {
            console.error(`Error: No se encontró un reto con el ID especificado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
async function ejecutar() {
    await obtenerReto();
    console.log(retoId);
    arrRetos.push(retoId);
    console.log(arrRetos);
    selectorFotograma('img1', retoId);
}

ejecutar();

/* función que muestra la imagen 1 del reto diario */
async function selectorFotograma(columna, retoId) {
    try {
        const response = await fetch('http://localhost:81/serieFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-series-fotogramas');
        const retoSeleccionado = array.find(prop => prop.id === retoId); // Buscar el objeto con el id especificado
        //guardar respuesta correcta
        const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
        const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
        respuestaInput.value = nombre; // Establecer el valor del input
        if (retoSeleccionado && retoSeleccionado.hasOwnProperty(columna)) {
            const imgURL = retoSeleccionado[columna]; // Obtener URL de la imagen desde la columna del reto seleccionado
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
        } else {
            cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
            console.error(`Error: la columna ${columna} no existe en el objeto reto seleccionado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
//selectorFotograma('img1'); //Muestro la primera imagen


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
    selectorFotograma(nombresColumnasImagenes[0], retoId);
});
btnImg2.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[1], retoId);
});
btnImg3.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[2], retoId);
});
btnImg4.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[3], retoId);
});
btnImg5.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[4], retoId);
});
btnImg6.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[5], retoId);
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
        await selectorFotograma(`img${cantidadFallos + 1}`, retoId);
    } catch (error) {
        console.error(error);
        document.getElementById('imagen-fallo').src = 'https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg'; // cambia la ruta a la imagen que quieras mostrar
    }
}

//función que pasa al siguietne reto
function mostrarRetoSiguiente() {
    retoId++;
    ejecutar();
}

function mostrarPaginaAnterior() {
    // Restaurar los cambios realizados al acertar el reto

    // Restablecer el estilo de la caja del reto
    const cajaReto = document.getElementById('caja-reto-series-fotogramas');
    cajaReto.style.backgroundImage = 'none';
    cajaReto.style.backgroundColor = 'transparent';

    // Restablecer el estilo y contenido de los mensajes
    const mensaje = document.querySelector('.mensaje-envio-respuesta');
    mensaje.style.display = 'none';
    mensaje.innerHTML = '';

    // Ocultar los botones de las imágenes
    const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
    for (let i = 0; i < botones.length; i++) {
        botones[i].style.display = 'none';
    }

    // Ocultar el botón de "Mostrar Reto Siguiente"
    const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
    botonSiguiente.style.display = 'none';

    // Habilitar el campo de entrada de texto
    document.querySelector(".input-buscador").disabled = false;

    //limpiar historial
    var historial = document.getElementById("historial-intentos");
    historial.innerHTML = "";
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
        //document.querySelector('.cuadro-busqueda').style.display = 'none';
        //alert("¡Respuesta correcta!");
        //Recorrer todos los botones y mostrarlos
        const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
        for (let i = 0; i < botones.length; i++) {
            botones[i].style.display = 'inline-block';
        }
        //reinicio la cantidad de fallos y los intentos restantes
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        //mostrar siguiente reto
        const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
        botonSiguiente.style.display = 'inline-block';
        //se muestra la página inicial de adivinar reto
        const btnRetoSiguiente = document.getElementById('btn-reto-siguiente-infinito');
        btnRetoSiguiente.addEventListener('click', mostrarPaginaAnterior);

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
        if (respuestaUsuario === "") {
            historialIntentos.innerHTML += "<p>Respuesta vacía</p>";
        } else {
            historialIntentos.innerHTML += `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        }
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

//Código funcional de reto aleatorio 
/*
async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/serieRandomFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        console.log(data)
        const ID = array[0].id;
        if (ID) {
            retoId = ID;
            console.log(ID)
        } else {
            console.error(`Error: No se encontró un reto con el ID especificado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/serieRandomFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        console.log(data)
        const ID = array[0].id;
        if (ID) {
            retoId = ID;
            console.log(ID)
        } else {
            console.error(`Error: No se encontró un reto con el ID especificado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

async function ejecutar() {
    await obtenerReto();
    console.log(retoId);
    selectorFotograma('img1', retoId);
}

ejecutar();

//función que muestra la imagen 1 del reto diario 
async function selectorFotograma(columna, retoId) {
    try {
        const response = await fetch('http://localhost:81/serieFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-series-fotogramas');

        const retoSeleccionado = array.find(prop => prop.id === retoId); // Buscar el objeto con el id especificado
        //guardar respuesta correcta
        const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
        const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
        respuestaInput.value = nombre; // Establecer el valor del input


        if (retoSeleccionado && retoSeleccionado.hasOwnProperty(columna)) {
            const imgURL = retoSeleccionado[columna]; // Obtener URL de la imagen desde la columna del reto seleccionado
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
        } else {
            cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
            console.error(`Error: la columna ${columna} no existe en el objeto reto seleccionado.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
*/