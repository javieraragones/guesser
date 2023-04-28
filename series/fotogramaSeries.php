<?php include '../../Guesser/main/header.php'; ?> <!-- Incluir el contenido del header -->

<div class="game-cont">
    <div class="game-box">
        
        <div class="series-menu">
        <div class="series-menu-elem1 series-menu-elementos">
            <a href="#" id="btn-infinito "class="btn-menu-series"><i class="fas fa-infinity"></i></a>
        </div>
        <div class="series-menu-elem2 series-menu-elementos">
            <select id="btn-modo-serie" class="btn-menu-series despl-modo-serie">
            <option value="#" selected>Seleccionar modo</option>
                <option value="/Guesser/series/fotogramaSeries.php">Fotograma</option>
                <option value="/Guesser/series/emojiSeries.php">Emoji</option>
                <option value="/Guesser/series/personajeSeries.php">Personaje</option>
                <option value="#">Pronto...</option>
            </select>
            <script>
                    // Obtener el elemento select
                    var selectElement = document.getElementById('btn-modo-serie');
                    // Agregar un evento de cambio al select
                    selectElement.addEventListener('change', function() {
                    // Obtener la opción seleccionada
                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                    // Obtener el valor de la URL de la opción seleccionada
                    var url = selectedOption.value;
                    // Redirigir a la página correspondiente
                    window.location.href = url;
                    });
            </script>
        </div>
        <div class="series-menu-elem3 series-menu-elementos">
            <a href="#" id="btn-calendario" class="btn-menu-series"><i class="fas fa-calendar"></i></a>
        </div>
        </div>

        <div class="caja-reto">

        </div>

        <div class="historial-pistas">

        </div>

        <div class="cuadro-busqueda"> <!-- Input text para buscador-->
        <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar...">
        <button class="search__btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
            <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z" fill="#efeff1"></path>
            </svg>
        </button>
        </div>
        </div>

        <div class="historial-intentos">
            Aquí se muestran los inputs de los intentos fallidos.
        </div>

        <div class="intentos-restantes">
            <p>Intentos restantes:</p>
        </div>
    
    </div>

</div>
</body>
</html>