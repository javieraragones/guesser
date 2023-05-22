<?php include '../../Guesser/main/header.php'; ?> <!-- Incluir el contenido del header -->


<div class="game-cont">
    <div class="game-box">

        <div class="peliculas-menu">
            <div class="peliculas-menu-elem1 peliculas-menu-elementos">
                <a href="" id="btn-infinito" class="btn-menu-peliculas"><i class="fas fa-infinity"></i></a>
            </div>
            <div class="peliculas-menu-elem2 peliculas-menu-elementos">
                <select id="btn-modo-pelicula" class="btn-menu-peliculas despl-modo-pelicula">
                    <?php
                    // Obtener el nombre de la página actual
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    ?>
                    <?php if ($currentPage == "fotogramaPeliculas.php") : ?>
                        <option value="/Guesser/peliculas/fotogramaPeliculas.php" selected>Fotograma</option>
                        <option value="/Guesser/peliculas/emojiPeliculas.php">Emoji</option>
                        <option value="/Guesser/peliculas/personajePeliculas.php">Personaje</option>
                    <?php elseif ($currentPage == "emojiPeliculas.php") : ?>
                        <option value="/Guesser/peliculas/fotogramaPeliculas.php">Fotograma</option>
                        <option value="/Guesser/peliculas/emojiPeliculas.php" selected>Emoji</option>
                        <option value="/Guesser/peliculas/personajePeliculas.php">Personaje</option>
                    <?php elseif ($currentPage == "personajePeliculas.php") : ?>
                        <option value="/Guesser/peliculas/fotogramaPeliculas.php">Fotograma</option>
                        <option value="/Guesser/peliculas/emojiPeliculas.php">Emoji</option>
                        <option value="/Guesser/peliculas/personajePeliculas.php" selected>Personaje</option>

                    <?php else : ?>
                        <option value="/Guesser/peliculas/fotogramaPeliculas.php">Fotograma</option>
                        <option value="/Guesser/peliculas/emojiPeliculas.php">Emoji</option>
                        <option value="/Guesser/peliculas/personajePeliculas.php">Personaje</option>

                    <?php endif; ?>
                </select>
                <script>
                    // Obtener el elemento select
                    var selectElement = document.getElementById('btn-modo-pelicula');
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
            <div class="peliculas-menu-elem3 peliculas-menu-elementos">
                <a href="#" id="btn-calendario" class="btn-menu-peliculas"><i class="fas fa-calendar"></i></a>
            </div>
        </div>