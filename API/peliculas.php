<?php
require_once 'conexion.php';

class Peliculas
{
    private $db;

    function __construct()
    {
        $db = new conectarDB();
        $this->db = $db->conectar();
    }

    function __destruct()
    {
        $this->db = null;
    }


    /*------Funciones para modo de juego Fotograma Pelicula------*/
    public function getPeliculaFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_pelicula"; // WHERE id = :id"
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getPeliculaRandomFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_pelicula  ORDER BY RAND() /* LIMIT 1*/"; //
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postPeliculaFotogramas($datos)
    {
        $sql = "INSERT INTO fotogramas_pelicula (nombre, img1, img2, img3, img4, img5, img6, fecha) VALUES (:nombre, :img1, :img2, :img3, :img4, :img5, :img6, :fecha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':img1', $datos->img1);
        $stmt->bindParam(':img2', $datos->img2);
        $stmt->bindParam(':img3', $datos->img3);
        $stmt->bindParam(':img4', $datos->img4);
        $stmt->bindParam(':img5', $datos->img5);
        $stmt->bindParam(':img6', $datos->img6);
        $stmt->bindParam(':fecha', $datos->fecha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            throw new Exception("Ha ocurrido un error al insertar los datos");
        }
    }


    /*------Funciones para modo de juego Emoji Pelicula------*/
    public function getAllPeliculasEmojis()
    {
        $sql = "SELECT * FROM emojis_pelicula";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getPeliculaRandomEmojis()
    {
        $sql = "SELECT * FROM emojis_pelicula ORDER BY RAND() /* LIMIT 1*/"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postPeliculaEmojis($datos)
    {
        $sql = "INSERT INTO emojis_pelicula (nombre, emoji, fecha) VALUES (:nombre, :emoji, :fecha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':emoji', $datos->emoji);
        $stmt->bindParam(':fecha', $datos->fecha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            throw new Exception("Ha ocurrido un error al insertar los datos");
        }
    }


    /*------Funciones para modo de juego Personaje Pelicula------*/

    public function getAllPeliculasPersonaje()
    {
        $sql = "SELECT * FROM personajes_pelicula";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getPeliculaRandomPersonaje()
    {
        $sql = "SELECT * FROM personajes_pelicula ORDER BY RAND() /* LIMIT 1*/"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postPeliculaPersonaje($datos)
    {
        $sql = "INSERT INTO personajes_pelicula (nombre, nombre_pelicula, img, fecha) VALUES (:nombre, :nombre_pelicula, :img, :fecha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':nombre_pelicula', $datos->nombre_pelicula);
        $stmt->bindParam(':img', $datos->img);
        $stmt->bindParam(':fecha', $datos->fecha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            throw new Exception("Ha ocurrido un error al insertar los datos");
        }
    }
}



    /* FUNCIÓN QUE AUMENTA EL VALOR DE ID EN 1 CADA DÍA (falta implementar correctamente)

    function generarIdDiario() {
  var fecha = new Date();
  var dia = fecha.getDate();

  var idCookie = getCookie("idDiario");
  if (idCookie != null && idCookie == dia) {
    // La cookie existe y corresponde al día actual, se recupera el valor del id
    var id = parseInt(getCookie("id"));
  } else {
    // La cookie no existe o no corresponde al día actual, se genera un nuevo id
    var id = 1;
    setCookie("id", id, 1); // Se almacena el valor del id en una cookie con duración de un día
    setCookie("idDiario", dia, 1); // Se almacena el valor del día actual en otra cookie con duración de un día
  }

  // Se incrementa el valor del id y se actualiza la cookie correspondiente
  id++;
  setCookie("id", id, 1);

  return id;
}

function setCookie(nombre, valor, dias) {
  var fecha = new Date();
  fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
  var expira = "expires=" + fecha.toUTCString();
  document.cookie = nombre + "=" + valor + "; " + expira + "; path=/";
}

function getCookie(nombre) {
  var nombreEQ = nombre + "=";
  var cookies = document.cookie.split(';');
  for(var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i];
    while (cookie.charAt(0)==' ') cookie = cookie.substring(1,cookie.length);
    if (cookie.indexOf(nombreEQ) == 0) return cookie.substring(nombreEQ.length,cookie.length);
  }
  return null;
}
    */