<?php
require_once 'conexion.php';

class Juegos
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


    /*------Funciones para modo de juego Fotograma Juego------*/
    public function getJuegoFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_juego"; // WHERE id = :id"
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getJuegoRandomFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_juego  ORDER BY RAND() /* LIMIT 1*/"; //
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postJuegoFotogramas($datos)
    {
        $sql = "INSERT INTO fotogramas_juego (nombre, img1, img2, img3, img4, img5, img6, fecha) VALUES (:nombre, :img1, :img2, :img3, :img4, :img5, :img6, :fecha)";
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


    /*------Funciones para modo de juego Emoji Juego------*/
    public function getAllJuegosEmojis()
    {
        $sql = "SELECT * FROM emojis_juego";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getJuegoRandomEmojis()
    {
        $sql = "SELECT * FROM emojis_juego ORDER BY RAND() /* LIMIT 1*/"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postJuegoEmojis($datos)
    {
        $sql = "INSERT INTO emojis_juego (nombre, emoji, fecha) VALUES (:nombre, :emoji, :fecha)";
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


    /*------Funciones para modo de juego Personaje Juego------*/

    public function getAllJuegosPersonaje()
    {
        $sql = "SELECT * FROM personajes_juego";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getJuegoRandomPersonaje()
    {
        $sql = "SELECT * FROM personajes_juego ORDER BY RAND() /* LIMIT 1*/"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postJuegoPersonaje($datos)
    {
        $sql = "INSERT INTO personajes_juego (nombre, nombre_juego, img, fecha) VALUES (:nombre, :nombre_juego, :img, :fecha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':nombre_juego', $datos->nombre_juego);
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