<?php 
    session_start();

    Class Connect{
        protected $dbh;

        protected function Conexion(){
            try{
                $connect = $this->dbh = new PDO("mysql:local=localhost;dbname=tec;","root","") ;       
                return $connect;
            }catch(Exception $e){
                print "Error DB: ". $e->getMessage(). "<br/>";
                die();
            }

        }

        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");

        }

        public static function ruta () {
            return "http://localhost/proyecto/";
        }
    }

?>