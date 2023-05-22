<?php
require_once './header.php';
?>

<h1>Personajes Pelicula</h1>
<div class="add-button">
    <button onclick="location.href='agregarPersonajePelicula.php';" id="btn-agregar">Agregar Personaje</button>
</div>
<div class="search-container">
    <input type="text" id="search-input" placeholder="Buscar por nombre" oninput="searchPersonajes()">
</div>
<div class="table-container">
    <table id="personajes-table" class="tabla-listado">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nombre Pelicula</th>
                <th>Imagen</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    const tableBody = document.querySelector('#personajes-table tbody');
    const searchInput = document.querySelector('#search-input');

    // Función para filtrar los personajes en función del nombre
    function searchPersonajes() {
        const searchTerm = searchInput.value.toLowerCase();
        const personajes = document.querySelectorAll('#personajes-table tbody tr');

        personajes.forEach(personaje => {
            const nombre = personaje.querySelector('td:nth-child(1)').textContent.toLowerCase();

            if (nombre.includes(searchTerm)) {
                personaje.style.display = 'table-row';
            } else {
                personaje.style.display = 'none';
            }
        });
    }

    // Función para ordenar los personajes por fecha descendente
    function sortPersonajesByDate() {
        const personajes = Array.from(document.querySelectorAll('#personajes-table tbody tr'));

        personajes.sort((a, b) => {
            const fechaA = new Date(a.querySelector('td:nth-child(4)').textContent);
            const fechaB = new Date(b.querySelector('td:nth-child(4)').textContent);

            return fechaB - fechaA; // Orden descendente
        });

        tableBody.innerHTML = '';
        personajes.forEach(personaje => tableBody.appendChild(personaje));
    }

    fetch('http://localhost:81/peliculaPersonaje', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const personajes = data.message;

            personajes.forEach(personaje => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${personaje.nombre}</td>
                    <td>${personaje.nombre_pelicula}</td>
                    <td><img src="${personaje.img}" class="small-image" alt="Imagen"></td>
                    <td>${personaje.fecha}</td>
                `;
                tableBody.appendChild(row);
            });

            sortPersonajesByDate(); // Ordenar los personajes por fecha descendente
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>
</body>

</html>