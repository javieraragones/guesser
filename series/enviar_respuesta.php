<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $textoBusqueda = $_POST['textoBusqueda'];
    $respuesta = $_POST['respuesta'];

    // Procesar los datos y enviar la respuesta al cliente
    // Aquí deberías escribir el código para procesar los datos y enviar la respuesta al cliente.
    // según las necesidades de tu aplicación.

    // En este ejemplo, simplemente se imprimirá la respuesta por pantalla
    echo "Respuesta para \"$textoBusqueda\": \"$respuesta\"";
}
