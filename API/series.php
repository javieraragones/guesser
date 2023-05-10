<?php
require_once 'conexion.php';

class Series
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
    /* FUNCIÓN QUE AUMENTA EL VALOR DE ID EN 1 CADA DÍA

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

    /*------Funciones para modo de juego Fotograma Serie------*/
    public function getAllSeriesFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_serie"; // WHERE id = :id"
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getSerieRandomFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_serie ORDER BY RAND() LIMIT 1"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch();
        return $resultado;
    }

    public function postSerieFotogramas($datos)
    {
        $sql = "INSERT INTO fotogramas_serie (nombre, img1, img2, img3, img4, img5, img6) VALUES (:nombre, :img1, :img2, :img3, :img4, :img5, :img6)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':img1', $datos->img1);
        $stmt->bindParam(':img1', $datos->img2);
        $stmt->bindParam(':img1', $datos->img3);
        $stmt->bindParam(':img1', $datos->img4);
        $stmt->bindParam(':img1', $datos->img5);
        $stmt->bindParam(':img1', $datos->img6);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            throw new Exception("Ha ocurrido un error al insertar los datos");
        }
    }


    /*------Funciones para modo de juego Emoji Serie------*/
    public function getAllSeriesEmojis()
    {
        $sql = "SELECT * FROM emojis_serie";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getSerieRandomEmojis()
    {
        $sql = "SELECT * FROM emojis_serie ORDER BY RAND() LIMIT 1"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch();
        return $resultado;
    }

    public function postSerieEmojis($datos)
    {
        $sql = "INSERT INTO emojis_serie (nombre, emoji) VALUES (:nombre, :emoji)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':emoji', $datos->emoji);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            throw new Exception("Ha ocurrido un error al insertar los datos");
        }
    }


    /*------Funciones para modo de juego Personaje Serie------*/

    public function getAllSeriesPersonaje()
    {
        $sql = "SELECT * FROM personajes_serie";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getSerieRandomPersonaje()
    {
        $sql = "SELECT * FROM personajes_serie ORDER BY RAND() LIMIT 1"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch();
        return $resultado;
    }

    public function postSeriePersonaje($datos)
    {
        $sql = "INSERT INTO personajes_serie (nombre, nombre_serie, img) VALUES (:nombre, :nombre_serie, :img)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':nombre_serie', $datos->nombre_serie);
        $stmt->bindParam(':img', $datos->img);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            throw new Exception("Ha ocurrido un error al insertar los datos");
        }
    }
}
