<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->


<div class="caja-reto caja-reto-personaje" id="caja-reto-series-personaje" style="font-size: 80px">
</div>

<div class="mensaje-envio-respuesta" id="mensaje-envio-respuesta-series-personaje">
</div>

<div class="cuadro-busqueda">
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar..." onkeyup="buscarTitulo(this.value)">
        <div id="resultados-busqueda"></div>
    </div>
    <button class="boton-buscar" onclick="comprobarRespuesta()">Enviar</button>
</div>

<!-- Input hidden con la respuesta correcta -->
<input type="hidden" id="respuesta-correcta" value="">

<script src="./personajeSeries.js"></script>

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