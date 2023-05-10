<?php include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->



<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">

</div>

<div class="historial-pistas">

</div>

<div class="cuadro-busqueda"> <!-- Input text para buscador-->
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar...">
        <button class="search__btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
                <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z" fill="#efeff1"></path>
            </svg>
        </button>
    </div>
</div>

<div class="historial-intentos">
    Aquí se muestran los inputs de los intentos fallidos.
</div>

<div class="intentos-restantes">
    <p>Intentos restantes:</p>
</div>

</div>

</div>
</body>

</html>



<script>
    async function getFotogramas() {
        try {
            const response = await fetch('http://localhost:81/serieFotogramas');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            const array = data.message;
            const cajaReto = document.getElementById('caja-reto-series-fotogramas');
            const imgURL = array[0].img1; // Obtener URL de la imagen desde la columna "img1"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getFotogramas();
</script>


<script>
    //barra de búsqueda sugerencias de títulos
    function buscarTitulo(textoBusqueda) {
        if (textoBusqueda.length >= 2) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_titulo.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    mostrarResultados(this.responseText);
                }
            };
            xhr.send("textoBusqueda=" + textoBusqueda);
        } else {
            document.getElementById("resultados-busqueda").innerHTML = "";
        }
    }

    function mostrarResultados(textoRespuesta) {
        const resultados = JSON.parse(textoRespuesta);
        let htmlResultados = "";
        if (resultados.length > 0) {
            htmlResultados += "<ul>";
            for (let i = 0; i < resultados.length; i++) {
                htmlResultados += "<li>" + resultados[i] + "</li>";
            }
            htmlResultados += "</ul>";
        } else {
            htmlResultados += "<p>No se encontraron resultados.</p>";
        }
        document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
    }
</script>






<?php /* include './estrucInicioSeries.php'; ?><!-- Incluir el contenido base -->

<div class="caja-reto caja-reto-fotogramas" id="caja-reto-series-fotogramas">
</div>

<div class="historial-pistas">
</div>

<div class="cuadro-busqueda">
    <div class="buscador-container">
        <input type="text" name="buscador" class="input-buscador" placeholder="Buscar..." onkeyup="buscarTitulo(this.value)">
        <div id="resultados-busqueda"></div>
    </div>
</div>

<script>

    function buscarTitulo(textoBusqueda, inputText) {
        if (textoBusqueda.length >= 2) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_titulo.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    mostrarResultados(this.responseText);
                }
            };
            xhr.send("textoBusqueda=" + textoBusqueda + "&inputText=" + inputText);
        } else {
            document.getElementById("resultados-busqueda").innerHTML = "";
        }
    }


    /*
    function buscarTitulo(textoBusqueda) {
        if (textoBusqueda.length >= 2) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "buscar_titulo.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    mostrarResultados(this.responseText);
                }
            };
            xhr.send("textoBusqueda=" + textoBusqueda);
        } else {
            document.getElementById("resultados-busqueda").innerHTML = "";
        }
    }
    

    function mostrarResultados(textoRespuesta) {
        const resultados = JSON.parse(textoRespuesta);
        let htmlResultados = "";
        if (resultados.length > 0) {
            htmlResultados += "<ul>";
            for (let i = 0; i < resultados.length; i++) {
                htmlResultados += "<li>" + resultados[i] + "</li>";
            }
            htmlResultados += "</ul>";
        } else {
            htmlResultados += "<p>No se encontraron resultados.</p>";
        }
        document.getElementById("resultados-busqueda").innerHTML = htmlResultados;
    }
</script>

<div class="historial-intentos">
    Aquí se muestran los inputs de los intentos fallidos.
</div>

<div class="intentos-restantes">
    <p>Intentos restantes:</p>
</div>

</div>

</div>
</body>

</html>

<script>
    async function getFotogramas() {
        try {
            const response = await fetch('http://localhost:81/serieFotogramas');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            const array = data.message;
            const cajaReto = document.getElementById('caja-reto-series-fotogramas');
            const imgURL = array[0].img1; // Obtener URL de la imagen desde la columna "img1"
            cajaReto.style.backgroundImage = `url('${imgURL}')`; // Establecer la imagen como fondo del elemento
            cajaReto.style.backgroundSize = 'contain'; // Ajustar el tamaño de la imagen sin distorsionar la relación de aspecto
            cajaReto.style.backgroundPosition = 'center'; // Centrar la imagen en la caja
            // Establecer un fondo negro para la caja si la imagen es más pequeña que la caja
            cajaReto.style.backgroundColor = 'black';
        } catch (error) {
            console.error(`Error fetching data: ${error}`);
        }
    }
    getFotogramas();
</script>
;?>