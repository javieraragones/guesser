

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
    enlace.href = "/Guesser/series/emojiSeriesInfinito.php";
}
cambiarHref();

//esta función muestra los emojis desde el inicial hasta el que corresponda con la cantidad de fallos +1 para que cada vez que 
//el usuario falle, se muestre el siguiente emoji y los anteriores
async function mostrarEmojis(fallos) {
    try {
        const dia = getDiaActual();
        const response = await fetch('http://localhost:81/serieEmojis');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;
        const cajaReto = document.getElementById('caja-reto-series-emojis');

        const emojisSeriesHoy = array.find(prop => prop.fecha === dia); // Encuentra el objeto con fecha igual al día de hoy
        if (emojisSeriesHoy) {
            const emojis = emojisSeriesHoy.emoji; // Obtén los emojis del objeto encontrado
            const regex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g;
            const emojiArray = emojis.match(regex);
            console.log(emojiArray); // ['\ud83e\udd91', '\ud83c\udfae']
            cajaReto.innerHTML = emojiArray.splice(0, fallos).join('');
        } else {
            /*Controlar que del actual disponga de un reto*/
            cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
            console.error(`Error: No se encontró un objeto con la fecha ${dia}.`);
        }
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}
mostrarEmojis(cantidadFallos + 1);

//FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
async function getRespuestaCorrecta() {
    try {
        const dia = getDiaActual();
        //const response = await fetch(API_URL + '/series');
        const response = await fetch('http://localhost:81/serieEmojis');
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
    } else {
        //alert("Respuesta incorrecta. Inténtalo de nuevo.");
        //mensaje.innerHTML = "Respuesta incorrecta";
        //mensaje.style.color = "var(--color-fallo)"; // establecer color rojo para fallo
        cantidadFallos++;
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        //historialIntentos.innerHTML += `<p>Intento ${cantidadFallos}: ${primeraLetraMayus(respuestaUsuario)}</p>`;
        //historialIntentos.innerHTML += `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        if (respuestaUsuario === "") {
            historialIntentos.innerHTML += "<p>Respuesta vacía</p>";
        } else {
            historialIntentos.innerHTML += `<p>${primeraLetraMayus(respuestaUsuario)}</p>`;
        }
        //cada vez que se falla, se muestra desde el principio hasta cantidad de fallos +1
        mostrarEmojis(cantidadFallos + 1);
        // Actualiza los intentos restantes
        cuentaIntentosRestantes--;
    }
    // Verificar si se han agotado los intentos
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
        const response = await fetch('http://localhost:81/serieEmojis');
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



//Función funcional inicial emojis
/*
FUNCIONES ANTES DE INCREMENTO 3
//esta función muestra los emojis desde el inicial hasta el que corresponda con la cantidad de fallos +1 para que cada vez que 
//el usuario falle, se muestre el siguiente emoji y los anteriores
async function mostrarEmojis(fallos) {
    try {
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
        cajaReto.innerHTML = emojiArray.splice(0, fallos).join('');
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

//FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
async function getRespuestaCorrecta() {
    try {
        //const response = await fetch(API_URL + '/series');
        const response = await fetch('http://localhost:81/serieEmojis');
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

async function getEmojis(posicion) {
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
getEmojis(1);
    /*
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
            cajaReto.innerHTML = emojiArray[0];
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getEmojis()
    */