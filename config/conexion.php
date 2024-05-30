<?php 
session_start();
    class Conectar{
        protected $dbh;

        protected function Conexion(){

    $host="localhost";
    $dbname="mpch";
    $username="postgres";
    $password="postgres";

    try{
        $conectar=$this->dbh=new PDO("pgsql:host=$host; dbname=$dbname", $username,$password);
        return $conectar;
            }catch(Exception $e){
        print "No se Conecto A la base de Datos".$e->getMessage()."</br>";
            die();
        }
           
        }

        public function set_names(){
            return $this->dbh->query("SET NAME 'utf8");
        }

        public static function ruta(){
            return "http://localhost/sisi/";
            //cambiamos por el url del servidor a correr
        }
    }

?>