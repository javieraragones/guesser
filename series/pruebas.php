<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->


<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">
</div>

<div class="historial-pistas">
</div>

<div class="cuadro-busqueda">
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar..." onkeyup="buscarTitulo(this.value)">
        <div id="resultados-busqueda"></div>
    </div>
    <button onclick="comprobarRespuesta()">Enviar</button>
</div>


<!-- Agregar el input hidden con la respuesta correcta -->
<input type="hidden" id="respuesta-correcta" value="">

<script>
    //FUNCIÓN QUE INTRODUCE LA RESPUESTA CORRECTA EN EL INPUT HIDDEN PARA COMPARAR CON LA RESPUESTA DEL USUARIO
    async function getFotogramas() {
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
    getFotogramas();
</script>



<script>
    //FUNCIÓN PARA COMPROBAR RESPUESTA-COMPARA LA INTRODUCIDA CON LA QUE TIENE EL INPT HIDDEN
    //FUNCIÓN PARA ENVIAR LA RESPUESTA ESCRITA
    function comprobarRespuesta() {
        // Obtener la respuesta del usuario
        var respuestaUsuario = document.querySelector(".input-buscador").value.toLowerCase();

        // Obtener la respuesta correcta
        var respuestaCorrecta = document.getElementById("respuesta-correcta").value.toLowerCase();

        // Comparar las respuestas
        if (respuestaUsuario === respuestaCorrecta) {
            alert("¡Respuesta correcta!");
        } else {
            alert("Respuesta incorrecta. Inténtalo de nuevo.");
        }
    }

    //FUNCIÓN PARA BUSCAR TÍTULO (SE VA BUSCANDO EL TÍTULO QUE COINCIDA CON LO QUE INTRODUCE EL USUARIO)
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

    //FUNCIÓN QUE MUESTRA LOS RESULTADOS DE LOS TÍTULOS QUE COINCIDEN EN UN DESPLEGABLE
    function mostrarResultados(textoRespuesta) {
        const resultados = JSON.parse(textoRespuesta);
        let htmlResultados = "";
        if (resultados.length > 0) {
            htmlResultados += "<ul>";
            for (let i = 0; i < resultados.length; i++) {
                htmlResultados += "<li><a href=\"#\" onclick=\"enviarRespuesta('" + resultados[i] + "')\">" + resultados[i] + "</a></li>";
            }
            htmlResultados += "</ul>";
        } else {
            htmlResultados += "<p>No se encontraron resultados.</p>";
        }
        document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
    }

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
</script>
<div class="historial-intentos">
    Aquí se muestran los inputs de los intentos fallidos.
</div>
<div class="intentos-restantes">
    <p>Intentos restantes: <span>3</span></p>
</div>
</div>
</div>
</body>

</html>
<script>
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
</script>