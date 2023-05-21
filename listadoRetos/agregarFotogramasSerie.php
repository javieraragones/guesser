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
                    window.location.href = 'index.php';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al agregar el fotograma');
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
    <form id="formulario-agregar-fotograma-serie" class="formulario-agregar-reto">
        <div class="form-column">
            <div class="form-group">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="img1">Imagen 1:</label><br>
                <input type="text" id="img1" required>
            </div>
            <div class="form-group">
                <label for="img3">Imagen 3:</label><br>
                <input type="text" id="img3">
            </div>
            <div class="form-group">
                <label for="img5">Imagen 5:</label><br>
                <input type="text" id="img5">
            </div>

        </div>
        <div class="form-column">
            <div class="form-group">
                <label for="fecha">Fecha:</label><br>
                <input type="text" id="fecha" required>
            </div>
            <div class="form-group">
                <label for="img2">Imagen 2:</label><br>
                <input type="text" id="img2">
            </div>
            <div class="form-group">
                <label for="img4">Imagen 4:</label><br>
                <input type="text" id="img4">
            </div>
            <div class="form-group">
                <label for="img6">Imagen 6:</label><br>
                <input type="text" id="img6">
            </div>
        </div>
        <button type="button" onclick="agregarFotograma()" class="btn-agregar-reto">Agregar Fotograma</button>
        <button type="button" onclick="resetForm()" class="btn-limpiar-form">Limpiar Formulario</button>
    </form>


</body>

</html>