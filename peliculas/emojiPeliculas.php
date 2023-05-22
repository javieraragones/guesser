<?php include './estrucInicioPeliculas.php'; ?><!-- Incluir el contenido base -->


<div class="caja-reto reto-emojis" id="caja-reto-peliculas-emojis" style="font-size: 80px">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<div class="mensaje-envio-respuesta" id="mensaje-envio-respuesta-peliculas-emojis">
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

<script src="./emojiPeliculas.js"></script>

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