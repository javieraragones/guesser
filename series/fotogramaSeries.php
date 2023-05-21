<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->


<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">
    <div id="imagen">
        <!-- Agregar imagen por defecto -->
        <img id="imagen-fallo" src="">
    </div>
</div>
<div class="mensaje-envio-respuesta" id="mensaje-envio-respuesta-series-fotogramas">
</div>

<div class="historial-pistas">
    <button id="btn-img1" class="boton-navegacion">1</button>
    <button id="btn-img2" class="boton-navegacion">2</button>
    <button id="btn-img3" class="boton-navegacion">3</button>
    <button id="btn-img4" class="boton-navegacion">4</button>
    <button id="btn-img5" class="boton-navegacion">5</button>
    <button id="btn-img6" class="boton-navegacion">6</button>
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

<script src="./fotogramaSeries.js"></script>

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