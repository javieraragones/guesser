<?php
session_start();

// Verificar si el formulario de inicio de sesión ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar las credenciales ingresadas
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aquí debes realizar la verificación de las credenciales según tu lógica de autenticación
    // Por ejemplo, podrías comparar las credenciales con valores almacenados en una base de datos

    // Ejemplo de verificación básica (reemplaza esto con tu propia lógica de autenticación)
    if ($username === 'admin' && $password === 'guess123') {
        // Credenciales válidas, crear una sesión para el administrador
        $_SESSION['admin'] = true;

        // Redirigir al índice de categorías (index.php) u otra página relevante
        header('Location: index.php');
        exit;
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        $error = 'Credenciales inválidas, por favor intenta nuevamente';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>

<body>
    <h1>Iniciar sesión</h1>

    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Iniciar sesión</button>
    </form>
</body>

</html>