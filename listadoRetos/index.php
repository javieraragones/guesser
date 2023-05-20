<?php
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

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Índice de Categorías</title>
    <style>
        .category-box {
            width: 200px;
            height: 200px;
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            display: inline-block;
            margin: 10px;
            text-align: center;
            padding: 20px;
        }

        .category-box a {
            color: #333;
            text-decoration: none;
        }

        .logout-button {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Índice de Categorías</h1>

    <div class="category-box">
        <a href="listadoFotogramasSeries.php">Listado Fotogramas Series</a>
    </div>

    <div class="category-box">
        <a href="series.php">Series</a>
    </div>

    <div class="category-box">
        <a href="peliculas.php">Películas</a>
    </div>

    <div class="category-box">
        <a href="documentales.php">Documentales</a>
    </div>

    <div class="category-box">
        <a href="musica.php">Música</a>
    </div>

    <div class="category-box">
        <a href="libros.php">Libros</a>
    </div>

    <div class="category-box">
        <a href="videojuegos.php">Videojuegos</a>
    </div>

    <div class="category-box">
        <a href="teatro.php">Teatro</a>
    </div>

    <div class="category-box">
        <a href="arte.php">Arte</a>
    </div>

    <div class="logout-button">
        <a href="?logout=true">Desloguearse</a>
    </div>
</body>

</html>