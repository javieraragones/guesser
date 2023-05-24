<?php
require_once './header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Agregar Personaje Pelicula</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../../Guesser/estilos/styles_listadoRetos.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#fecha").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });

        function agregarPersonaje() {
            // Validar el formulario antes de enviar los datos
            if (!validarFormulario()) {
                return;
            }
            const nombre = document.getElementById('nombre').value;
            const nombrePelicula = document.getElementById('nombre-pelicula').value;
            const img = document.getElementById('img').value;
            const fecha = document.getElementById('fecha').value;

            const personaje = {
                nombre: nombre,
                nombre_pelicula: nombrePelicula,
                img: img,
                fecha: fecha
            };

            fetch('http://localhost:81/peliculaPersonaje', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(personaje)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Personaje agregado correctamente');
                    resetForm();
                    window.location.href = 'listadoPersonajesPeliculas.php';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al agregar el personaje');
                });
        }

        function validarFormulario() {
            var formulario = document.getElementById("formulario-agregar-personaje-pelicula");
            if (!formulario.checkValidity()) {
                // Si el formulario no es válido, se muestra un mensaje de error o se realiza alguna acción.
                alert("Por favor, completa todos los campos requeridos.");
                return false; // Evita el envío del formulario.
            }
            // Ejecuta la comprobación de existencia de nombre después de obtener los retos guardados
            ejecutarComprobacionNombre();
            return true; // Evita el envío del formulario hasta que se complete la comprobación del nombre en la base de datos.
        }

        //Comprobar nombre introducido con los que se encuentran en la tabla

        let arrayEmojis = []; // Array que contendrá los retos de emojis

        // Obtiene los retos guardados de la base de datos mediante una solicitud a la API
        async function obtenerRetosGuardados() {
            try {
                const response = await fetch('http://localhost:81/peliculaPersonaje');
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                const array = data.message;

                array.forEach((emoji) => {
                    arrayEmojis.push(emoji);
                });
            } catch (error) {
                console.error(`Error fetching data: ${error}`);
            }
        }

        // Ejecuta la comprobación de existencia de nombre después de obtener los retos guardados
        async function ejecutarComprobacionNombre() {
            await obtenerRetosGuardados();
            verificarNombreExistente();
        }

        // Verifica si el nombre introducido en el campo de entrada ya existe en la base de datos
        function verificarNombreExistente() {
            var nombreInput = document.getElementById("nombre").value.toUpperCase();

            if (comprobarNombreExistente(nombreInput)) {
                alert("El nombre ya se encuentra en la base de datos.");
            }
        }

        // Comprueba si el nombre existe en el array de emojis obtenidos de la base de datos
        function comprobarNombreExistente(nombre) {
            return arrayEmojis.some(emoji => emoji.nombre.toUpperCase() === nombre);
        }

        function updateImagePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('blur', () => {
                const imageUrl = input.value;
                preview.innerHTML = `<img src="${imageUrl}" alt="Imagen">`;
            });
        }

        function resetForm() {
            document.getElementById('nombre').value = '';
            document.getElementById('nombre-pelicula').value = '';
            document.getElementById('img').value = '';
            document.getElementById('fecha').value = '';
        }
    </script>
</head>

<body>
    <h1>Agregar Personaje Pelicula</h1>
    <form id="formulario-agregar-personaje-pelicula" class="formulario-agregar-reto" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" required onblur="ejecutarComprobacionNombre()">
        </div>
        <div class="form-group">
            <label for="nombre-pelicula">Nombre Pelicula:</label>
            <input type="text" id="nombre-pelicula" required>
        </div>
        <div class="form-group">
            <label for="img">Imagen:</label>
            <input type="text" id="img" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="text" id="fecha" required>
        </div>
        <button type="button" onclick="resetForm()" class="btn-limpiar-form">Limpiar Formulario</button>
        <button type="button" onclick="agregarPersonaje()" class="btn-agregar-reto">Agregar Personaje</button>
    </form>

    <div id="tabla-previsualizacion-personaje-pelicula" class="tabla-previsualizacion tabla-previsualizacion-personaje">
        <h2>Previsualización de Personaje</h2>
        <div id="personaje-preview" class="personaje-preview"></div>
    </div>
    <script>
        // Actualizar previsualización de las imágenes
        updateImagePreview('img', 'personaje-preview');
    </script>
</body>

</html>