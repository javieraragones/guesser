<?php
require_once './header.php';
?>

<h1>Emojis Pelicula</h1>
<div class="add-button">
    <button onclick="location.href='agregarEmojiPelicula.php';" id="btn-agregar">Agregar Emoji</button>
</div>
<div class="search-container">
    <input type="text" id="search-input" placeholder="Buscar por nombre" oninput="searchEmojis()">
</div>
<div class="table-container">
    <table id="emojis-table" class="tabla-listado">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Emoji</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    const tableBody = document.querySelector('#emojis-table tbody');
    const searchInput = document.querySelector('#search-input');

    // Función para filtrar los emojis en función del nombre
    function searchEmojis() {
        const searchTerm = searchInput.value.toLowerCase();
        const emojis = document.querySelectorAll('#emojis-table tbody tr');

        emojis.forEach(emoji => {
            const nombre = emoji.querySelector('td:nth-child(1)').textContent.toLowerCase();

            if (nombre.includes(searchTerm)) {
                emoji.style.display = 'table-row';
            } else {
                emoji.style.display = 'none';
            }
        });
    }

    // Función para ordenar los emojis por fecha descendente
    function sortEmojisByDate() {
        const emojis = Array.from(document.querySelectorAll('#emojis-table tbody tr'));

        emojis.sort((a, b) => {
            const fechaA = new Date(a.querySelector('td:nth-child(3)').textContent);
            const fechaB = new Date(b.querySelector('td:nth-child(3)').textContent);

            return fechaB - fechaA; // Orden descendente
        });

        tableBody.innerHTML = '';
        emojis.forEach(emoji => tableBody.appendChild(emoji));
    }

    fetch('http://localhost:81/peliculaEmojis', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const emojis = data.message;

            emojis.forEach(emoji => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${emoji.nombre}</td>
                    <td>${emoji.emoji}</td>
                    <td>${emoji.fecha}</td>
                `;
                tableBody.appendChild(row);
            });

            sortEmojisByDate(); // Ordenar los emojis por fecha descendente
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>
</body>

</html>