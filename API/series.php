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


    /*------Funciones para modo de juego Fotograma Serie------*/
    public function getSerieFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_serie"; // WHERE id = :id"
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getSerieRandomFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_serie  ORDER BY RAND() /* LIMIT 1*/"; //
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postSerieFotogramas($datos)
    {
        $sql = "INSERT INTO fotogramas_serie (nombre, img1, img2, img3, img4, img5, img6, fecha) VALUES (:nombre, :img1, :img2, :img3, :img4, :img5, :img6, :fecha)";
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
        $sql = "SELECT * FROM emojis_serie ORDER BY RAND() /* LIMIT 1*/"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postSerieEmojis($datos)
    {
        $sql = "INSERT INTO emojis_serie (nombre, emoji, fecha) VALUES (:nombre, :emoji, :fecha)";
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
        $sql = "SELECT * FROM personajes_serie ORDER BY RAND() /* LIMIT 1*/"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function postSeriePersonaje($datos)
    {
        $sql = "INSERT INTO personajes_serie (nombre, nombre_serie, img, fecha) VALUES (:nombre, :nombre_serie, :img, :fecha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos->nombre);
        $stmt->bindParam(':nombre_serie', $datos->nombre_serie);
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
