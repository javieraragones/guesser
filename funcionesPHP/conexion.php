<?php
    class conectarDB{
        private $server = "mysql: host=localhost; dbname=guesser;";
        private $user = "root";
        private $password = "";
        //array de opciones para conectarse a la base de datos.
        //PDO-> interfaz ligera para poder acceder a bases de datos en PHP.
        //(ATTR_ERRMODE-> informa de los errores--si obtenemos errores, podemos acceder a otros atributos).
        //::-> para la resolución de alcance .
        //ERRMODE_EXCEPTION-> este valor lanza excepciones.
        //ATTR_DEFAULT_FETCH_MODE-> establecer el modo de recuperación predeterminado. Luego accedemos a la parte del PDO
        //FETCH_ASSOC-> devuelve una matriz indexada por nombre de columna como se muestra en su conjunto de resultados

        private $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        protected $conn;

        //Función para conectarse a la base de datos.
        public function conectar(){
            try {
                $this->conn = new PDO($this->server, $this->user, $this->password, $this->opciones);
                return $this -> conn;
            } catch (PDOException $e) {
                echo "Error al conectar: ".$e->getMessage();
            }
        }
        //Función para desconectarse de la base de datos.
        public function cerrar(){
            $this->conn = null;
        }
    }
?>