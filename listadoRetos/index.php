<?php
require_once './header.php';

session_start();

// Verificar si el administrador está logueado
if (!isset($_SESSION['admin'])) {
    // Si no está logueado, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

// Función para desloguearse
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<div id="categorias-indice">
    <a href="listadoFotogramasSeries.php" class="category-box">
        Fotogramas Series
    </a>

    <a href="listadoEmojisSeries.php" class="category-box">
        Emojis Series
    </a>

    <a href="listadoPersonajesSeries.php" class="category-box">
        Personajes Series
    </a>

    <a href="listadoFotogramasPeliculas.php" class="category-box">
        Fotogramas Películas
    </a>

    <a href="listadoEmojisPeliculas.php" class="category-box">
        Emojis Películas
    </a>

    <a href="listadoPersonajesPeliculas.php" class="category-box">
        Personajes Películas
    </a>

    <a href="listadoFotogramasJuegos.php" class="category-box">
        Fotogramas Juegos
    </a>

    <a href="listadoEmojisJuegos.php" class="category-box">
        Emojis Juegos
    </a>

    <a href="listadoPersonajesJuegos.php" class="category-box">
        Personajes Juegos
    </a>
</div>

</body>

</html>