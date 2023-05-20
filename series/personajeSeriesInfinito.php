<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->
<?php /*include '../constantes/constantesJS.php'*/ ?>


<div class="caja-reto caja-reto-personaje" id="caja-reto-series-personaje" style="font-size: 80px">

</div>
<div class="mensaje-envio-respuesta" id="mensaje-envio-respuesta-series-personaje">

</div>

<!--div class="historial-pistas">
</!--div-->
<button id="btn-reto-siguiente-infinito" style="display:none" onclick="mostrarRetoSiguiente()">Mostrar Reto Siguiente</button>
<button id="btn-reiniciar-modo-infinito" style="display:none">Reiniciar</button>

<div class="cuadro-busqueda">
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar..." onkeyup="buscarTitulo(this.value)">
        <div id="resultados-busqueda"></div>
    </div>
    <button class="boton-buscar" onclick="comprobarRespuesta()">Enviar</button>
</div>

<!-- Agregar el input hidden con la respuesta correcta -->
<input type="hidden" id="respuesta-correcta" value="">

<script src="./personajeSeriesInfinito.js"></script>
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
    /*
    async function getPersonaje() {
        try {
            const response = await fetch('http://localhost:81/seriePersonaje');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            const array = data.message;
            const cajaReto = document.getElementById('caja-reto-series-fotogramas');
            const imgURL = array[0].img; // Obtener URL de la imagen desde la columna "img1"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getPersonaje();
    */
</script>