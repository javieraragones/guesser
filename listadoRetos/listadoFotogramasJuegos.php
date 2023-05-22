<?php
require_once './header.php';
?>

<h1>Fotogramas Juego</h1>
<div class="add-button">
    <button onclick="location.href='agregarFotogramaJuego.php';" id="btn-agregar">Agregar Fotograma</button>
</div>
<div class="search-container">
    <input type="text" id="search-input" placeholder="Buscar por nombre" oninput="searchFotogramas()">
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
    const tableBody = document.querySelector('#fotogramas-table tbody');
    const searchInput = document.querySelector('#search-input');

    // Función para filtrar los fotogramas en función del nombre
    function searchFotogramas() {
        const searchTerm = searchInput.value.toLowerCase();
        const fotogramas = document.querySelectorAll('#fotogramas-table tbody tr');

        fotogramas.forEach(fotograma => {
            const nombre = fotograma.querySelector('td:nth-child(1)').textContent.toLowerCase();

            if (nombre.includes(searchTerm)) {
                fotograma.style.display = 'table-row';
            } else {
                fotograma.style.display = 'none';
            }
        });
    }

    // Función para ordenar los fotogramas por fecha descendente
    function sortFotogramasByDate() {
        const fotogramas = Array.from(document.querySelectorAll('#fotogramas-table tbody tr'));

        fotogramas.sort((a, b) => {
            const fechaA = new Date(a.querySelector('td:nth-child(8)').textContent);
            const fechaB = new Date(b.querySelector('td:nth-child(8)').textContent);

            return fechaB - fechaA; // Orden descendente
        });

        tableBody.innerHTML = '';
        fotogramas.forEach(fotograma => tableBody.appendChild(fotograma));
    }

    fetch('http://localhost:81/juegoFotogramas', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
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

            sortFotogramasByDate(); // Ordenar los fotogramas por fecha descendente
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>
</body>

</html>