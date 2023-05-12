<?php
//VERSION FUNCIONAL EMOJIS Y FOTOGRAMAS
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
    public function getAllSeriesFotogramas()
    {
        $sql = "SELECT * FROM fotogramas_serie";
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

    public function postSerieFotograma($datos)
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
}





/* VERSION 1
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

    public function getAllSeries()
    {
        $sql = "SELECT * FROM emojis_serie";
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function getSerieRandom()
    {
        $sql = "SELECT * FROM emojis_serie ORDER BY RAND() LIMIT 1"; // Seleccionar un elemento aleatorio de la tabla
        $stmt = $this->db->query($sql);
        $resultado = $stmt->fetch();
        return $resultado;
    }

    public function postSerie($datos)
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
}
*/