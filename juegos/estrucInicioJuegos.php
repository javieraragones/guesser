<?php include '../../Guesser/main/header.php'; ?> <!-- Incluir el contenido del header -->


<div class="game-cont">
    <div class="game-box">

        <div class="juegos-menu">
            <div class="juegos-menu-elem1 juegos-menu-elementos">
                <a href="" id="btn-infinito" class="btn-menu-juegos"><i class="fas fa-infinity"></i></a>
            </div>
            <div class="juegos-menu-elem2 juegos-menu-elementos">
                <select id="btn-modo-juego" class="btn-menu-juegos despl-modo-juego">
                    <?php
                    // Obtener el nombre de la página actual
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    ?>
                    <?php if ($currentPage == "fotogramaJuegos.php") : ?>
                        <option value="/Guesser/juegos/fotogramaJuegos.php" selected>Fotograma</option>
                        <option value="/Guesser/juegos/emojiJuegos.php">Emoji</option>
                        <option value="/Guesser/juegos/personajeJuegos.php">Personaje</option>
                    <?php elseif ($currentPage == "emojiJuegos.php") : ?>
                        <option value="/Guesser/juegos/fotogramaJuegos.php">Fotograma</option>
                        <option value="/Guesser/juegos/emojiJuegos.php" selected>Emoji</option>
                        <option value="/Guesser/juegos/personajeJuegos.php">Personaje</option>
                    <?php elseif ($currentPage == "personajeJuegos.php") : ?>
                        <option value="/Guesser/juegos/fotogramaJuegos.php">Fotograma</option>
                        <option value="/Guesser/juegos/emojiJuegos.php">Emoji</option>
                        <option value="/Guesser/juegos/personajeJuegos.php" selected>Personaje</option>

                    <?php else : ?>
                        <option value="/Guesser/juegos/fotogramaJuegos.php">Fotograma</option>
                        <option value="/Guesser/juegos/emojiJuegos.php">Emoji</option>
                        <option value="/Guesser/juegos/personajeJuegos.php">Personaje</option>

                    <?php endif; ?>
                </select>
                <script>
                    // Obtener el elemento select
                    var selectElement = document.getElementById('btn-modo-juego');
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
            <div class="juegos-menu-elem3 juegos-menu-elementos">
                <a href="#" id="btn-calendario" class="btn-menu-juegos"><i class="fas fa-calendar"></i></a>
            </div>
        </div>