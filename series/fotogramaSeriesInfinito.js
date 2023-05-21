
//Iniciamos las variables cantidadFallos y cuentaIntentosRestantes
let cantidadFallos = 0; // Contador para llevar el registro de la cantidad de fallos ocurridos
let cuentaIntentosRestantes = 6; // Cantidad de intentos restantes para el usuario

let arrayFotogramas = []; // Array que contendrá los retos de emojis en un orden aleatorio
let retoCount = 0; // Contador de retos actualmente mostrados, inicia en 0

// Función asíncrona para llenar el arrayFotogramas de retos. Se obtienen todos los retos ordenados aleatoriamente de la API
async function obtenerReto() {
    try {
        const response = await fetch('http://localhost:81/serieRandomFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        const array = data.message;

        array.forEach((fotograma) => {
            arrayFotogramas.push(fotograma);
        });
    } catch (error) {
        console.error(`Error fetching data: ${error}`);
    }
}

// Función asincrónica que coordina la ejecución de otras funciones
// Como trabajamos con funciones asíncronas, en esta función se espera a que se ejecute la función obtenerReto() y después de ejecuta selectorFotograma()
async function ejecutar() {
    await obtenerReto();
    console.log(arrayFotogramas);
    selectorFotograma('img1', retoCount);
}

ejecutar(); // Llamamos a la función para que se muestre la primera pista

// Función que muestra la imagen 1 del arrayFotogramas
async function selectorFotograma(columna, retoCount) {

    const retoSeleccionado = arrayFotogramas[retoCount];
    console.log(retoCount);
    const cajaReto = document.getElementById('caja-reto-series-fotogramas');
    // Guardar respuesta correcta
    const nombre = retoSeleccionado.nombre; // Obtener el valor de la columna "nombre" del objeto correspondiente al día actual
    const respuestaInput = document.getElementById('respuesta-correcta'); // Obtener el input
    respuestaInput.value = nombre; // Establecer el valor del input
    // Si hay alguna serie y el reto seleccionado tiene la propiedad 'columna'...
    if (retoSeleccionado && retoSeleccionado.hasOwnProperty(columna)) {
        const imgURL = retoSeleccionado[columna]; // Obtener URL de la imagen desde la columna del reto seleccionado
        cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
        cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
        cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
        cajaReto.style.backgroundColor = 'black'; // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
    } else {
        //Si no hay reto disponible, se muestra una imagen de error
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        console.error(`Error: la columna ${columna} no existe en el objeto reto seleccionado.`);
    }

}

// Función que pasa al siguiente reto
function mostrarRetoSiguiente() {
    mostrarPaginaAnterior();
    retoCount++;
    // Si ya no quedan más retos disponibles, se muestra una imagen de error y un mensaje indicando que no quedan más retos disponibles
    if (retoCount >= arrayFotogramas.length) {
        document.querySelector(".input-buscador").disabled = true; // Deshabilitar campo de entrada de texto
        document.querySelector('.boton-buscar').disabled = true; // Deshabilitar el botón de envio de respuesta
        const cajaReto = document.getElementById('caja-reto-series-fotogramas');
        cajaReto.style.backgroundImage = `url('https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg')`;
        cajaReto.style.backgroundSize = 'cover';
        const mensaje = document.querySelector('.mensaje-envio-respuesta');
        mensaje.style.display = 'inline-block';
        mensaje.innerHTML = "Has realizado todos los retos disponibles";
        mensaje.style.color = "white";
        const mensaje2 = document.querySelector('.intentos-restantes');
        mensaje2.style.display = 'none';
        const mensaje3 = document.querySelector('.historial-pistas');
        mensaje3.style.display = 'none';
    } else {
        // Mientras queden retos disponibles, se muestra el siguiente reto
        selectorFotograma('img1', retoCount);
        console.log(retoCount)
    }
}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------

//Función para realizar la navegación entre las imágenes de los retos
const nombresColumnasImagenes = ['img1', 'img2', 'img3', 'img4', 'img5', 'img6'];
let indiceImagenActual = 0;
// Obtener los botones de navegación
const btnImg1 = document.getElementById('btn-img1');
const btnImg2 = document.getElementById('btn-img2');
const btnImg3 = document.getElementById('btn-img3');
const btnImg4 = document.getElementById('btn-img4');
const btnImg5 = document.getElementById('btn-img5');
const btnImg6 = document.getElementById('btn-img6');
// Agregar evento click a cada botón de navegación
btnImg1.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[0], retoCount);
});
btnImg2.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[1], retoCount);
});
btnImg3.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[2], retoCount);
});
btnImg4.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[3], retoCount);
});
btnImg5.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[4], retoCount);
});
btnImg6.addEventListener('click', () => {
    selectorFotograma(nombresColumnasImagenes[5], retoCount);
});

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
        await selectorFotograma(`img${cantidadFallos + 1}`, retoCount);
    } catch (error) {
        console.error(error);
        document.getElementById('imagen-fallo').src = 'https://blogs.unsw.edu.au/nowideas/files/2018/11/error-no-es-fracaso.jpg';
    }
}

// Función que restaura los cambios realizados para cuando mostramos un nuevo reto
function mostrarPaginaAnterior() {

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
    document.querySelector('.boton-buscar').disabled = false; // Deshabilitar el botón de envio de respuesta 
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
    mostrarBotonDesbloqueado(cantidadFallos);
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

        //Recorrer todos los botones y mostrarlos
        const botones = [btnImg1, btnImg2, btnImg3, btnImg4, btnImg5, btnImg6];
        for (let i = 0; i < botones.length; i++) {
            botones[i].style.display = 'inline-block';
        }
        document.querySelector('.intentos-restantes').style.display = 'none'; // Ocultamos los intentos restantes
        //Reinicio la cantidad de fallos y los intentos restantes
        cantidadFallos = 0;
        cuentaIntentosRestantes = 6;
        //Mostrar botón para pasar al siguiente reto
        const botonSiguiente = document.querySelector('#btn-reto-siguiente-infinito');
        botonSiguiente.style.display = 'inline-block';
        document.querySelector('.intentos-restantes').style.display = 'none'; //Desactivamos cuadro de búsqueda
    } else {
        cantidadFallos++; // Aumentamos la cuenta de fallos
        mostrarBotonDesbloqueado(cantidadFallos); // Se muestra el botón correspondiente al número de fallo
        // Se llama a la función que pasa al siguiente fograma en caso de que queden intentos
        if (cantidadFallos < 6) {
            mostrarFotograma();
        }
        // Añade la respuesta al historial
        var historialIntentos = document.getElementById("historial-intentos");
        var respuestaHTML = "";
        if (respuestaUsuario === "") {
            respuestaHTML = "<p>Respuesta vacía</p>"; // En caso de que el usuario no introduzca texto, se muestra "Respuesta vacía" en el historial
        } else {
            respuestaHTML = `<p>${primeraLetraMayus(respuestaUsuario)}</p>`; // Respuesta introducida errónea
        }
        historialIntentos.insertAdjacentHTML("afterbegin", respuestaHTML); // Inserta la respuesta al principio del historial
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
        const response = await fetch('http://localhost:81/serieRandomFotogramas');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        // Obtener los datos de la respuesta como JSON
        const data = await response.json();
        const array = data.message;
        // Crear un nuevo array para almacenar los nombres de las series o películas
        let nombres = []
        // Recorrer el array de datos y extraer los nombres de las series o películas, agregándolos al nuevo array "nombres"
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