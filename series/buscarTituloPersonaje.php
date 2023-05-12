
<?php
header('Content-Type: application/json');

// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "guesser";

// Crear conexión
$conn = mysqli_connect($host, $user, $password, $dbname);

// Comprobar conexión
if (!$conn) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el término de búsqueda desde el input
$searchTerm = $_POST['textoBusqueda'];

// Realizar la consulta a la base de datos para obtener los títulos que coinciden con el término de búsqueda
$sql = "SELECT nombre FROM personajes_serie WHERE nombre LIKE '%" . $searchTerm . "%'";
$result = mysqli_query($conn, $sql);

// Crear un array para almacenar los títulos encontrados
$titleArray = array();

// Recorrer los resultados de la consulta y almacenar los títulos en el array
while ($row = mysqli_fetch_assoc($result)) {
    $titleArray[] = $row['nombre'];
}

// Devolver los títulos encontrados como un array JSON
echo json_encode($titleArray);

// Cerrar la conexión
mysqli_close($conn);
