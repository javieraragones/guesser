
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
