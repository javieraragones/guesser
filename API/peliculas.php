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
