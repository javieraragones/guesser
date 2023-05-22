<?php
require_once('series.php');
require_once('peliculas.php');
require_once('juegos.php');

class GuesserAPI
{
    public function API()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/JSON');
        //Para poder realizar POSTs
        header("Access-Control-Allow-Origin: http://localhost");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Allow-Origin: *");
        // Permitir los métodos HTTP especificados
        header("Access-Control-Allow-Methods: POST");
        // Permitir los encabezados especificados
        header("Access-Control-Allow-Headers: Content-Type");
        // Verificar si la solicitud es una solicitud OPTIONS
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            // Responder con un código de estado HTTP 200 OK
            http_response_code(200);
            exit();
        }
        $method = $_SERVER['REQUEST_METHOD'];
        $routes = $_SERVER['REQUEST_URI'];

        switch ($method) {
            case 'GET': //consulta
                switch ($routes) {
                        //Series
                    case '/serieEmojis':
                        $this->getSerieEmojis();
                        break;
                    case '/serieRandomEmojis':
                        $this->getSerieRandomEmojis();
                        break;
                    case '/serieFotogramas':
                        $this->getSerieFotogramas();
                        break;
                    case '/serieRandomFotogramas':
                        $this->getSerieRandomFotogramas();
                        break;
                    case '/seriePersonaje':
                        $this->getSeriePersonaje();
                        break;
                    case '/serieRandomPersonaje':
                        $this->getSerieRandomPersonaje();
                        break;
                        //Películas
                    case '/peliculaEmojis':
                        $this->getPeliculaEmojis();
                        break;
                    case '/peliculaRandomEmojis':
                        $this->getPeliculaRandomEmojis();
                        break;
                    case '/peliculaFotogramas':
                        $this->getPeliculaFotogramas();
                        break;
                    case '/peliculaRandomFotogramas':
                        $this->getPeliculaRandomFotogramas();
                        break;
                    case '/peliculaPersonaje':
                        $this->getPeliculaPersonaje();
                        break;
                    case '/peliculaRandomPersonaje':
                        $this->getPeliculaRandomPersonaje();
                        break;
                        //Juegos
                    case '/juegoEmojis':
                        $this->getJuegoEmojis();
                        break;
                    case '/juegoRandomEmojis':
                        $this->getJuegoRandomEmojis();
                        break;
                    case '/juegoFotogramas':
                        $this->getJuegoFotogramas();
                        break;
                    case '/juegoRandomFotogramas':
                        $this->getJuegoRandomFotogramas();
                        break;
                    case '/juegoPersonaje':
                        $this->getJuegoPersonaje();
                        break;
                    case '/juegoRandomPersonaje':
                        $this->getJuegoRandomPersonaje();
                        break;
                    default:
                        $this->response(400, "error", "NO EXISTE ENDPOINT");
                }
                break;
            case 'POST': //consulta
                switch ($routes) {
                        //Series
                    case '/serieEmojis':
                        $this->postSerieEmojis();
                        break;
                    case '/serieFotogramas':
                        $this->postSerieFotogramas();
                        break;
                    case '/seriePersonaje':
                        $this->postSeriePersonaje();
                        break;
                        //Películas
                    case '/peliculaEmojis':
                        $this->postPeliculaEmojis();
                        break;
                    case '/peliculaFotogramas':
                        $this->postPeliculaFotogramas();
                        break;
                    case '/peliculaPersonaje':
                        $this->postPeliculaPersonaje();
                        break;
                        //Juegos
                    case '/juegoEmojis':
                        $this->postJuegoEmojis();
                        break;
                    case '/juegoFotogramas':
                        $this->postJuegoFotogramas();
                        break;
                    case '/juegoPersonaje':
                        $this->postJuegoPersonaje();
                        break;
                    default:
                        $this->response(400, "error", "NO EXISTE ENDPOINT");
                }
                break;
            default:
                // metodo NO soportado
                $this->response(500, "error", "METODO NO SOPORTADO");
                break;
        }
    }

    /**
     * Respuesta al cliente
     * @param int $code Codigo de respuesta HTTP
     * @param String $status indica el estado de la respuesta puede ser "success" o "error"
     * @param String $message Descripcion de lo ocurrido
     */
    function response($code = 200, $status = "", $message = "")
    {
        http_response_code($code);
        if (!empty($status) && !empty($message)) {
            $response = array("status" => $status, "message" => $message);
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    //-------------------------------------------------------------------------Series-------------------------------------------------------------------------

    /*------Funciones para modo de juego Fotograma Serie------*/
    function getSerieFotogramas()
    {
        try {
            $series = new Series();
            $response = $series->getSerieFotogramas();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
    function getSerieRandomFotogramas()
    {
        try {
            $series = new Series();
            $response = $series->getSerieRandomFotogramas();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
    function postSerieFotogramas()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesFotogramas = new Series();
            $response = $seriesFotogramas->postSerieFotogramas($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }



    /*------Funciones para modo de juego Emoji Serie------*/
    function getSerieEmojis()
    {
        try {
            $seriesEmojis = new Series();
            $response = $seriesEmojis->getAllSeriesEmojis();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function getSerieRandomEmojis()
    {
        try {
            $seriesEmojis = new Series();
            $response = $seriesEmojis->getSerieRandomEmojis();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function postSerieEmojis()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesEmojis = new Series();
            $response = $seriesEmojis->postSerieEmojis($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }


    /*------Funciones para modo de juego Personaje Serie------*/
    function getSeriePersonaje()
    {
        try {
            $seriesPersonaje = new Series();
            $response = $seriesPersonaje->getAllSeriesPersonaje();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function getSerieRandomPersonaje()
    {
        try {
            $seriesPersonaje = new Series();
            $response = $seriesPersonaje->getSerieRandomPersonaje();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function postSeriePersonaje()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesPersonaje = new Series();
            $response = $seriesPersonaje->postSeriePersonaje($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    //-------------------------------------------------------------------------Películas-------------------------------------------------------------------------


    /*------Funciones para modo de juego Fotograma Serie------*/
    function getPeliculaFotogramas()
    {
        try {
            $series = new Peliculas();
            $response = $series->getPeliculaFotogramas();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
    function getPeliculaRandomFotogramas()
    {
        try {
            $series = new Peliculas();
            $response = $series->getPeliculaRandomFotogramas();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
    function postPeliculaFotogramas()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesFotogramas = new Peliculas();
            $response = $seriesFotogramas->postPeliculaFotogramas($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }



    /*------Funciones para modo de juego Emoji Pelicula------*/
    function getPeliculaEmojis()
    {
        try {
            $seriesEmojis = new Peliculas();
            $response = $seriesEmojis->getAllPeliculasEmojis();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function getPeliculaRandomEmojis()
    {
        try {
            $seriesEmojis = new Peliculas();
            $response = $seriesEmojis->getPeliculaRandomEmojis();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function postPeliculaEmojis()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesEmojis = new Peliculas();
            $response = $seriesEmojis->postPeliculaEmojis($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }


    /*------Funciones para modo de juego Personaje Pelicula------*/
    function getPeliculaPersonaje()
    {
        try {
            $seriesPersonaje = new Peliculas();
            $response = $seriesPersonaje->getAllPeliculasPersonaje();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function getPeliculaRandomPersonaje()
    {
        try {
            $seriesPersonaje = new Peliculas();
            $response = $seriesPersonaje->getPeliculaRandomPersonaje();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function postPeliculaPersonaje()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesPersonaje = new Peliculas();
            $response = $seriesPersonaje->postPeliculaPersonaje($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }


    //-------------------------------------------------------------------------Juegos-------------------------------------------------------------------------


    /*------Funciones para modo de juego Fotograma Serie------*/
    function getJuegoFotogramas()
    {
        try {
            $series = new Juegos();
            $response = $series->getJuegoFotogramas();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
    function getJuegoRandomFotogramas()
    {
        try {
            $series = new Juegos();
            $response = $series->getJuegoRandomFotogramas();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
    function postJuegoFotogramas()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesFotogramas = new Juegos();
            $response = $seriesFotogramas->postJuegoFotogramas($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }



    /*------Funciones para modo de juego Emoji Juego------*/
    function getJuegoEmojis()
    {
        try {
            $seriesEmojis = new Juegos();
            $response = $seriesEmojis->getAllJuegosEmojis();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function getJuegoRandomEmojis()
    {
        try {
            $seriesEmojis = new Juegos();
            $response = $seriesEmojis->getJuegoRandomEmojis();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function postJuegoEmojis()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesEmojis = new Juegos();
            $response = $seriesEmojis->postJuegoEmojis($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }


    /*------Funciones para modo de juego Personaje Juego------*/
    function getJuegoPersonaje()
    {
        try {
            $seriesPersonaje = new Juegos();
            $response = $seriesPersonaje->getAllJuegosPersonaje();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function getJuegoRandomPersonaje()
    {
        try {
            $seriesPersonaje = new Juegos();
            $response = $seriesPersonaje->getJuegoRandomPersonaje();
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }

    function postJuegoPersonaje()
    {
        try {
            // Recoger los datos JSON de la solicitud POST
            $datosJson = file_get_contents('php://input');
            // Decodificar los datos JSON en un objeto o un array de PHP
            $datos = json_decode($datosJson);
            $seriesPersonaje = new Juegos();
            $response = $seriesPersonaje->postJuegoPersonaje($datos);
            $this->response(200, "ok", $response);
        } catch (Exception $e) {
            $this->response(400, "error", $e->getMessage());
        }
    }
}
