<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->


<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">
    <div id="imagen">
        <!-- Agregar imagen por defecto -->
        <img id="imagen-fallo" src="">
    </div>
</div>
<script>
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
</script>

<div class="mensaje-envio-respuesta" id="mensaje-envio-respuesta-series-fotogramas">
    <p class="zona-invisible">Texto invisible</p>
    <p></p>
</div>

<div class="historial-pistas">
    <button id="btn-img" class="zona-invisible"></button>
    <button id="btn-img1" class="boton-navegacion">Imagen 1</button>
    <button id="btn-img2" class="boton-navegacion">Imagen 2</button>
    <button id="btn-img3" class="boton-navegacion">Imagen 3</button>
    <button id="btn-img4" class="boton-navegacion">Imagen 4</button>
    <button id="btn-img5" class="boton-navegacion">Imagen 5</button>
    <button id="btn-img6" class="boton-navegacion">Imagen 6</button>
</div>

<script>
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
</script>

<div class="cuadro-busqueda">
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar..." onkeyup="buscarTitulo(this.value)">
        <div id="resultados-busqueda"></div>
    </div>
    <button class="boton-buscar" onclick="comprobarRespuesta()">Enviar</button>
</div>

<!-- Agregar el input hidden con la respuesta correcta -->
<input type="hidden" id="respuesta-correcta" value="">

<script>
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
</script>

<script>
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
            document.getElementById('imagen-fallo').src = 'https://thumbs.dreamstime.com/b/error-109026446.jpg'; // cambia la ruta a la imagen que quieras mostrar
        }
    }
    //función para poner la primera letra mayúscula
    function primeraLetraMayus(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
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
            //Si el usuario ha acertado, muestra un mensaje de éxito y oculta el input de texto
            mensaje.innerHTML = "¡Respuesta correcta!";
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
            mensaje.innerHTML = "Respuesta incorrecta";
            mensaje.style.color = "red"; // establecer color rojo para fallo
            cantidadFallos++;
            mostrarBotonDesbloqueado(cantidadFallos);
            mostrarFotograma();
            // Añade la respuesta al historial
            var historialIntentos = document.getElementById("historial-intentos");
            historialIntentos.innerHTML += `<p>Intento ${cantidadFallos}: ${primeraLetraMayus(respuestaUsuario)}</p>`;

            // Actualiza los intentos restantes
            cuentaIntentosRestantes--;
        }
        if (cuentaIntentosRestantes == 0) {
            //alert("Ya has alcanzado el límite de intentos. ¡Inténtalo de nuevo más tarde!");
            mensaje.innerHTML = "Respuesta correcta: " + primeraLetraMayus(respuestaCorrecta);
            mensaje.style.color = "white"; // establecer color 
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
</script>
<div class="historial-intentos" id="historial-intentos">

</div>

<div class="intentos-restantes">
    <p>Intentos restantes: <span id="num-intentos-restantes">
            <script>
                mostrarIntentosRestantes(6);
            </script>
        </span></p>
</div>
</div>
</div>
</body>

</html>
<script>
    //envío de respuesta al presionar enter(no funciona)
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.getElementById("input-buscador");
        input.addEventListener("keydown", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                comprobarRespuesta();
            }
        });
    });
</script>