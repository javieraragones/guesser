<?php
require_once('series.php');

class GuesserAPI
{
    public function API()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/JSON');
        $method = $_SERVER['REQUEST_METHOD'];
        $routes = $_SERVER['REQUEST_URI'];

        switch ($method) {
            case 'GET': //consulta
                switch ($routes) {
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
                    default:
                        $this->response(400, "error", "NO EXISTE ENDPOINT");
                }
                break;
            case 'POST': //consulta
                switch ($routes) {
                    case '/serieEmojis':
                        $this->postSerieEmojis();
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


    /*------Funciones para modo de juego Fotograma Serie------*/
    function getSerieFotogramas()
    {
        try {
            $series = new Series();
            $response = $series->getAllSeriesFotogramas();
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
}
