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
            <!--i class="fa fa-camera-retro"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 16L7.49619 12.5067C8.2749 11.5161 9.76453 11.4837 10.5856 12.4395L13 15.25M10.915 12.823C11.9522 11.5037 13.3973 9.63455 13.4914 9.51294C13.4947 9.50859 13.4979 9.50448 13.5013 9.50017C14.2815 8.51598 15.7663 8.48581 16.5856 9.43947L19 12.25M6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25V6.75C19.25 5.64543 18.3546 4.75 17.25 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25Z"></path>
            </svg>
            Fotograma
            <br />
            <span class="descrip-juego">Adivina la serie con fotogramas</span>
          </button>
        </a>

        <a href="./series/emojiSeries.php">
          <button class="modo-juego-btn btn-series" id="gotoseriesemoji" type="button" name="Serie-Emojis">
            <!--i class="fas fa-face-grin"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.75 4.75H15.25C17.4591 4.75 19.25 6.54086 19.25 8.75V15.25C19.25 17.4591 17.4591 19.25 15.25 19.25H8.75C6.54086 19.25 4.75 17.4591 4.75 15.25V8.75C4.75 6.54086 6.54086 4.75 8.75 4.75Z"></path>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 12.75C7.75 12.75 9 15.25 12 15.25C15 15.25 16.25 12.75 16.25 12.75"></path>
              <circle cx="14" cy="10" r="1" fill="currentColor"></circle>
              <circle cx="10" cy="10" r="1" fill="currentColor"></circle>
            </svg>
            Emoji
            <br />
            <span class="descrip-juego">Adivina la serie por emojis</span>
          </button>
        </a>

        <a href="./series/personajeSeries.php">
          <button class="modo-juego-btn btn-series" id="gotoseriespersonaje" type="button" name="Serie-Personaje">
            <!--i class="fas fa-user"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
            </svg>
            Personaje
            <br />
            <span class="descrip-juego">Adivina un personaje de series</span>
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
            <!--i class="fa fa-camera-retro"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 16L7.49619 12.5067C8.2749 11.5161 9.76453 11.4837 10.5856 12.4395L13 15.25M10.915 12.823C11.9522 11.5037 13.3973 9.63455 13.4914 9.51294C13.4947 9.50859 13.4979 9.50448 13.5013 9.50017C14.2815 8.51598 15.7663 8.48581 16.5856 9.43947L19 12.25M6.75 19.25H17.25C18.3546 19.25 19.25 18.3546 19.25 17.25V6.75C19.25 5.64543 18.3546 4.75 17.25 4.75H6.75C5.64543 4.75 4.75 5.64543 4.75 6.75V17.25C4.75 18.3546 5.64543 19.25 6.75 19.25Z"></path>
            </svg>
            Fotograma
            <br />
            <span class="descrip-juego">Adivina la película con fotogramas</span>
          </button>
        </a>

        <a href="./peliculas/emojiPeliculas.php">
          <button class="modo-juego-btn btn-pelicula" id="gotopeliculaemoji" type="button" name="Serie-Emojis">
            <!--i class="fas fa-face-grin"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.75 4.75H15.25C17.4591 4.75 19.25 6.54086 19.25 8.75V15.25C19.25 17.4591 17.4591 19.25 15.25 19.25H8.75C6.54086 19.25 4.75 17.4591 4.75 15.25V8.75C4.75 6.54086 6.54086 4.75 8.75 4.75Z"></path>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 12.75C7.75 12.75 9 15.25 12 15.25C15 15.25 16.25 12.75 16.25 12.75"></path>
              <circle cx="14" cy="10" r="1" fill="currentColor"></circle>
              <circle cx="10" cy="10" r="1" fill="currentColor"></circle>
            </svg>
            Emoji
            <br />
            <span class="descrip-juego">Adivina la película por emojis</span>
          </button>
        </a>

        <a href="./peliculas/personajePeliculas.php">
          <button class="modo-juego-btn btn-pelicula" id="gotopeliculapersonaje" type="button" name="Serie-Personaje">
            <!--i class="fas fa-user"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
            </svg>
            Personaje
            <br />
            <span class="descrip-juego">Adivina un personaje de películas</span>
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
            <!--i class="fas fa-face-grin"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.75 4.75H15.25C17.4591 4.75 19.25 6.54086 19.25 8.75V15.25C19.25 17.4591 17.4591 19.25 15.25 19.25H8.75C6.54086 19.25 4.75 17.4591 4.75 15.25V8.75C4.75 6.54086 6.54086 4.75 8.75 4.75Z"></path>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 12.75C7.75 12.75 9 15.25 12 15.25C15 15.25 16.25 12.75 16.25 12.75"></path>
              <circle cx="14" cy="10" r="1" fill="currentColor"></circle>
              <circle cx="10" cy="10" r="1" fill="currentColor"></circle>
            </svg>
            Fotograma
            <br />
            <span class="descrip-juego">Adivina el juego con fotogramas</span>
          </button>
        </a>

        <a href="./juegos/emojiJuegos.php">
          <button class="modo-juego-btn btn-juego" id="gotojuegoemoji" type="button" name="Serie-Emojis">
            <!--i class="fas fa-face-grin"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.75 4.75H15.25C17.4591 4.75 19.25 6.54086 19.25 8.75V15.25C19.25 17.4591 17.4591 19.25 15.25 19.25H8.75C6.54086 19.25 4.75 17.4591 4.75 15.25V8.75C4.75 6.54086 6.54086 4.75 8.75 4.75Z"></path>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 12.75C7.75 12.75 9 15.25 12 15.25C15 15.25 16.25 12.75 16.25 12.75"></path>
              <circle cx="14" cy="10" r="1" fill="currentColor"></circle>
              <circle cx="10" cy="10" r="1" fill="currentColor"></circle>
            </svg>
            Emoji
            <br />
            <span class="descrip-juego">Adivina el juego por emojis</span>
          </button>
        </a>

        <a href="./juegos/personajeJuegos.php">
          <button class="modo-juego-btn btn-juego" id="gotojuegopersonaje" type="button" name="Serie-Personaje">
            <!--i class="fas fa-user"></!--i-->
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24">
              <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z"></path>
            </svg>
            Personaje
            <br />
            <span class="descrip-juego">Adivina un personaje de juegos</span>
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