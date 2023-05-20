<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Fotogramas de Serie</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .small-image {
            max-width: 100px;
            max-height: 100px;
        }

        .add-button {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Listado de Fotogramas de Serie</h1>
    <div class="add-button">
        <button onclick="location.href='agregarFotogramasSerie.php';">Agregar Fotograma</button>
    </div>
    <div class="table-container">
        <table id="fotogramas-table">
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