<?php
// Incluir el contenido del header
require_once './main/header.php';
?>

<div class="cont-container" id="contenedoresmodosjuego">
  <div class="container">

    <div class="box box-series">
      <h2>Series</h2>
      <div class="secciones">

        <a href="./series/fotogramaSeries.php">
          <button class="modo-juego-btn btn-series" id="gotoseriesfotograma" type="button" name="Serie-Fotograma">
            <i class="fa fa-camera-retro"></i>
            &nbsp; Fotograma
            <br />
            <span class="descrip-juego">Adivina la serie dado un fotograma.</span>
          </button>
        </a>

        <a href="./series/emojiSeries.php">
          <button class="modo-juego-btn btn-series" id="gotoseriesemoji" type="button" name="Serie-Emojis">
            <i class="fas fa-face-grin"></i>
            &nbsp; Emoji
            <br />
            <span class="descrip-juego">Adivina la serie por emojis.</span>
          </button>
        </a>

        <a href="./series/personajeSeries.php">
          <button class="modo-juego-btn btn-series" id="gotoseriespersonaje" type="button" name="Serie-Personaje">
            <i class="fas fa-user"></i>
            &nbsp; Personaje
            <br />
            <span class="descrip-juego">Adivina un personaje de series.</span>
          </button>
        </a>
        <!--<a href="#">Ver más</a>-->

      </div>
    </div>
    <div class="box box-peliculas">

      <h2>Películas</h2>
      <div class="secciones">

        <a href="./peliculas/fotogramaPeliculas.php">
          <button class="modo-juego-btn btn-pelicula" id="gotopeliculafotograma" type="button" name="Pelicula-Fotograma">
            <i class="fa fa-camera-retro"></i>
            &nbsp; Fotograma
            <br />
            <span class="descrip-juego">Adivina la película dado un fotograma.</span>
          </button>
        </a>

        <a href="./peliculas/emojiPeliculas.php">
          <button class="modo-juego-btn btn-pelicula" id="gotopeliculaemoji" type="button" name="Serie-Emojis">
            <i class="fas fa-face-grin"></i>
            &nbsp; Emoji
            <br />
            <span class="descrip-juego">Adivina la película por emojis.</span>
          </button>
        </a>

        <a href="./peliculas/personajePeliculas.php">
          <button class="modo-juego-btn btn-pelicula" id="gotopeliculapersonaje" type="button" name="Serie-Personaje">
            <i class="fas fa-user"></i>
            &nbsp; Personaje
            <br />
            <span class="descrip-juego">Adivina un personaje de películas.</span>
          </button>
        </a>
        <!--<a href="#">Ver más</a>-->

      </div>

    </div>
    <div class="box box-juegos">

      <h2>Juegos</h2>
      <div class="secciones">

        <a href="./juegos/fotogramaJuegos.php">
          <button class="modo-juego-btn btn-juego" id="gotojuegofotograma" type="button" name="juego-Fotograma">
            <i class="fa fa-camera-retro"></i>
            &nbsp; Fotograma
            <br />
            <span class="descrip-juego">Adivina el juego dado un fotograma.</span>
          </button>
        </a>

        <a href="./juegos/emojiJuegos.php">
          <button class="modo-juego-btn btn-juego" id="gotojuegoemoji" type="button" name="Serie-Emojis">
            <i class="fas fa-face-grin"></i>
            &nbsp; Emoji
            <br />
            <span class="descrip-juego">Adivina el juego por emojis.</span>
          </button>
        </a>

        <a href="./juegos/personajeJuegos.php">
          <button class="modo-juego-btn btn-juego" id="gotojuegopersonaje" type="button" name="Serie-Personaje">
            <i class="fas fa-user"></i>
            &nbsp; Personaje
            <br />
            <span class="descrip-juego">Adivina un personaje de juegos.</span>
          </button>
        </a>
        <!--<a href="#">Ver más</a>-->

      </div>
    </div>
  </div>

  <footer>

  </footer>


  </body>

  </html>