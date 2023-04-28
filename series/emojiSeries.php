<?php include '../../Guesser/main/header.php'; ?> <!-- Incluir el contenido del header -->
<?php include '../series/estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->


<div class="caja-reto">
<?php
        include_once('../funcionesPHP/conexion.php');
        // Crear una instancia de la clase ConectarDB
        $conexion = new ConectarDB();
        $conn = $conexion->conectar();
        // Realizar la consulta para obtener un elemento aleatorio de la tabla "emojis_serie"
        $sql = "SELECT * FROM emojis_serie ORDER BY RAND() LIMIT 1"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $conn->query($sql);
        $resultado = $stmt->fetch();
        if($resultado): ?>
            <h1><?php echo $resultado['emoji']; ?></h1> <!-- Muestra el elemento -->
        <?php else: ?>
            <p>No se encontraron elementos</p>
        <?php endif; ?><?php
        // Cerrar la conexión a la base de datos
        $conexion->cerrar();
?>
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






















<!--<?php// include '../series/estrucFinalSeries.php'; ?> Incluir el contenido final -->