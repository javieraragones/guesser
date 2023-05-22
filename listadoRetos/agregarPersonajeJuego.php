<?php
require_once './header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Agregar Personaje Juego</title>
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
            const nombreJuego = document.getElementById('nombre-juego').value;
            const img = document.getElementById('img').value;
            const fecha = document.getElementById('fecha').value;

            const personaje = {
                nombre: nombre,
                nombre_juego: nombreJuego,
                img: img,
                fecha: fecha
            };

            fetch('http://localhost:81/juegoPersonaje', {
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
                    window.location.href = 'index.php';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al agregar el personaje');
                });
        }

        function validarFormulario() {
            var formulario = document.getElementById("formulario-agregar-personaje-juego");
            if (!formulario.checkValidity()) {
                // Si el formulario no es válido, se muestra un mensaje de error o se realiza alguna acción.
                alert("Por favor, completa todos los campos requeridos.");
                return false; // Evita el envío del formulario.
            }
            // Si el formulario es válido, se puede proceder con el envío.
            return true;
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
            document.getElementById('nombre-juego').value = '';
            document.getElementById('img').value = '';
            document.getElementById('fecha').value = '';
        }
    </script>
</head>

<body>
    <h1>Agregar Personaje Juego</h1>
    <form id="formulario-agregar-personaje-juego" class="formulario-agregar-reto" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="nombre-juego">Nombre Juego:</label>
            <input type="text" id="nombre-juego" required>
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

    <div id="tabla-previsualizacion-personaje-juego" class="tabla-previsualizacion tabla-previsualizacion-personaje">
        <h2>Previsualización de Personaje</h2>
        <div id="personaje-preview" class="personaje-preview"></div>
    </div>
    <script>
        // Actualizar previsualización de las imágenes
        updateImagePreview('img', 'personaje-preview');
    </script>
</body>

</html>