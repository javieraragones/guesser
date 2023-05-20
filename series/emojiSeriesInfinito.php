<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->
<?php /*include '../constantes/constantesJS.php'*/ ?>


<div class="caja-reto reto-emojis" id="caja-reto-series-emojis" style="font-size: 80px">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<div class="mensaje-envio-respuesta" id="mensaje-envio-respuesta-series-emojis">

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

<script src="./emojiSeriesInfinito.js"></script>
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
</script>