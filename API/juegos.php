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
