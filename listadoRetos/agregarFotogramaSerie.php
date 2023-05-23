<?php
require_once './header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Agregar Fotograma de Serie</title>
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

        function agregarFotograma() {
            // Validar el formulario antes de enviar los datos
            if (!validarFormulario()) {
                return;
            }
            const nombre = document.getElementById('nombre').value;
            const img1 = document.getElementById('img1').value;
            const img2 = document.getElementById('img2').value;
            const img3 = document.getElementById('img3').value;
            const img4 = document.getElementById('img4').value;
            const img5 = document.getElementById('img5').value;
            const img6 = document.getElementById('img6').value;
            const fecha = document.getElementById('fecha').value;

            const fotograma = {
                nombre: nombre,
                img1: img1,
                img2: img2,
                img3: img3,
                img4: img4,
                img5: img5,
                img6: img6,
                fecha: fecha
            };

            fetch('http://localhost:81/serieFotogramas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(fotograma)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Fotograma agregado correctamente');
                    resetForm();
                    window.location.href = 'listadoFotogramasSeries.php';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al agregar el fotograma');
                });
        }

        function validarFormulario() {
            var formulario = document.getElementById("formulario-agregar-fotograma-serie");
            if (!formulario.checkValidity()) {
                // Si el formulario no es válido, se muestra un mensaje de error o se realiza alguna acción.
                alert("Por favor, completa todos los campos requeridos.");
                return false; // Evita el envío del formulario.
            }
            // Ejecuta la comprobación de existencia de nombre después de obtener los retos guardados
            ejecutarComprobacionNombre();
            return false; // Evita el envío del formulario hasta que se complete la comprobación del nombre en la base de datos.
        }

        //Comprobar nombre introducido con los que se encuentran en la tabla

        let arrayEmojis = []; // Array que contendrá los retos de emojis

        // Obtiene los retos guardados de la base de datos mediante una solicitud a la API
        async function obtenerRetosGuardados() {
            try {
                const response = await fetch('http://localhost:81/serieFotogramas');
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
            document.getElementById('img1').value = '';
            document.getElementById('img2').value = '';
            document.getElementById('img3').value = '';
            document.getElementById('img4').value = '';
            document.getElementById('img5').value = '';
            document.getElementById('img6').value = '';
            document.getElementById('fecha').value = '';
        }
    </script>
</head>

<body>
    <h1>Agregar Fotograma de Serie</h1>
    <form id="formulario-agregar-fotograma-serie" class="formulario-agregar-reto" onsubmit="return validarFormulario()">
        <div class="form-column">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" required onblur="ejecutarComprobacionNombre()">
            </div>

            <div class="form-group">
                <label for="img1">Imagen 1:</label>
                <input type="text" id="img1" required>
            </div>
            <div class="form-group">
                <label for="img3">Imagen 3:</label>
                <input type="text" id="img3">
            </div>
            <div class="form-group">
                <label for="img5">Imagen 5:</label>
                <input type="text" id="img5">
            </div>

        </div>

        <div class="form-column">
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="text" id="fecha" required>
            </div>
            <div class="form-group">
                <label for="img2">Imagen 2:</label>
                <input type="text" id="img2">
            </div>
            <div class="form-group">
                <label for="img4">Imagen 4:</label>
                <input type="text" id="img4">
            </div>
            <div class="form-group">
                <label for="img6">Imagen 6:</label>
                <input type="text" id="img6">
            </div>
        </div>
        <button type="button" onclick="resetForm()" class="btn-limpiar-form">Limpiar Formulario</button>
        <button type="button" onclick="agregarFotograma()" class="btn-agregar-reto">Agregar Fotograma</button>
    </form>

    <div id="tabla-previsualizacion-fotogramas-serie" class="tabla-previsualizacion tabla-previsualizacion-fotograma">
        <table id="table-tabla-previsualizacion-fotogramas-serie" class="table-tabla-previsualizacion">
            <thead>
                <tr>
                    <h2>Previsualización</h2>
                    <th>Imagen 1</th>
                    <th>Imagen 2</th>
                    <th>Imagen 3</th>
                    <th>Imagen 4</th>
                    <th>Imagen 5</th>
                    <th>Imagen 6</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="preview-img1"></td>
                    <td id="preview-img2"></td>
                    <td id="preview-img3"></td>
                    <td id="preview-img4"></td>
                    <td id="preview-img5"></td>
                    <td id="preview-img6"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        // Actualizar previsualización de las imágenes
        updateImagePreview('img1', 'preview-img1');
        updateImagePreview('img2', 'preview-img2');
        updateImagePreview('img3', 'preview-img3');
        updateImagePreview('img4', 'preview-img4');
        updateImagePreview('img5', 'preview-img5');
        updateImagePreview('img6', 'preview-img6');
    </script>

</body>

</html>