<?php
require_once './header.php';
?>

<h1>Fotogramas Serie</h1>
<div class="add-button">
    <button onclick="location.href='agregarFotogramasSerie.php';" id="btn-agregar">Agregar Fotograma</button>
</div>
<div class="table-container">
    <table id="fotogramas-table" class="tabla-listado">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Imagen 1</th>
                <th>Imagen 2</th>
                <th>Imagen 3</th>
                <th>Imagen 4</th>
                <th>Imagen 5</th>
                <th>Imagen 6</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    fetch('http://localhost:81/serieFotogramas', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#fotogramas-table tbody');
            const fotogramas = data.message;
            fotogramas.forEach(fotograma => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${fotograma.nombre}</td>
                    <td><img src="${fotograma.img1}" class="small-image" alt="Imagen 1"></td>
                    <td><img src="${fotograma.img2}" class="small-image" alt="Imagen 2"></td>
                    <td><img src="${fotograma.img3}" class="small-image" alt="Imagen 3"></td>
                    <td><img src="${fotograma.img4}" class="small-image" alt="Imagen 4"></td>
                    <td><img src="${fotograma.img5}" class="small-image" alt="Imagen 5"></td>
                    <td><img src="${fotograma.img6}" class="small-image" alt="Imagen 6"></td>
                    <td>${fotograma.fecha}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>
</body>

</html>