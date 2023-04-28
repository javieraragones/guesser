
  <?php include '../Guesser/main/header.php'; ?> <!-- Incluir el contenido del header -->
  
  <div class="cont-container" id="contenedoresmodosjuego">
    <div class="container">
      
      <div class="box box-series">
        <h2>Series</h2>
        <div class="secciones">

            <a href="../Guesser/series/fotogramaSeries.php">
            <button class="modo-juego-btn btn-series" id="gotoseriesfotograma" type="button" name="Serie-Fotograma">
              <i class="fa fa-camera-retro"></i>
              &nbsp; Fotograma
              <br/>
              <span class="descrip-juego">Adivina la serie dado un fotograma.</span>
            </button>
            </a>

            <a href="../Guesser/series/emojiSeries.php">
              <button class="modo-juego-btn btn-series" id="gotoseriesemoji" type="button" name="Serie-Emojis">
                <i class="fas fa-face-grin"></i>
                &nbsp; Emoji
                <br/>
                <span class="descrip-juego">Adivina la serie por emojis.</span>
              </button>
            </a>
              
            <a href="../Guesser/series/personajeSeries.php">
              <button class="modo-juego-btn btn-series" id="gotoseriespersonaje" type="button" name="Serie-Personaje">
                <i class="fas fa-user"></i>
                &nbsp; Personaje
                <br/>
                <span class="descrip-juego">Adivina un personaje de series.</span>
              </button>
            </a>
            <!--<a href="#">Ver más</a>-->

        </div>
      </div>
      <div class="box box-peliculas">
        
        <h2>Películas</h2>
        <div class="secciones">
          
            <a href="/pelicula-fotograma">
            <button class="modo-juego-btn btn-pelicula" id="gotopeliculafotograma" type="button" name="Pelicula-Fotograma">
              <i class="fa fa-camera-retro"></i>
              &nbsp; Fotograma
              <br/>
              <span class="descrip-juego">Adivina la película dado un fotograma.</span>
            </button>
            </a>

            <a href="/pelicula-emojis">
              <button class="modo-juego-btn btn-pelicula" id="gotopeliculaemoji" type="button" name="Serie-Emojis">
                <i class="fas fa-face-grin"></i>
                &nbsp; Emoji
                <br/>
                <span class="descrip-juego">Adivina la película por emojis.</span>
              </button>
            </a>
              
            <a href="/pelicula-personaje">
              <button class="modo-juego-btn btn-pelicula" id="gotopeliculapersonaje" type="button" name="Serie-Personaje">
                <i class="fas fa-user"></i>
                &nbsp; Personaje
                <br/>
                <span class="descrip-juego">Adivina un personaje de películas.</span>
              </button>
            </a>
            <!--<a href="#">Ver más</a>-->

      </div>
      
      </div>
      <div class="box box-juegos">

        <h2>Juegos</h2>
        <div class="secciones">
          
            <a href="/juego-fotograma">
            <button class="modo-juego-btn btn-juego" id="gotojuegofotograma" type="button" name="juego-Fotograma">
              <i class="fa fa-camera-retro"></i>
              &nbsp; Fotograma
              <br/>
              <span class="descrip-juego">Adivina el juego dado un fotograma.</span>
            </button>
            </a>

            <a href="/juego-emojis">
              <button class="modo-juego-btn btn-juego" id="gotojuegoemoji" type="button" name="Serie-Emojis">
                <i class="fas fa-face-grin"></i>
                &nbsp; Emoji
                <br/>
                <span class="descrip-juego">Adivina el juego por emojis.</span>
              </button>
            </a>
              
            <a href="/juego-personaje">
              <button class="modo-juego-btn btn-juego" id="gotojuegopersonaje" type="button" name="Serie-Personaje">
                <i class="fas fa-user"></i>
                &nbsp; Personaje
                <br/>
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