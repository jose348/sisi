<?php 
session_start();
    class Conectar{
        protected $dbh;

        protected function Conexion(){

    $host="localhost";
    $dbname="prueba";
    $username="postgresql";
    $password="postgresql";

    try{
        $conectar=$this->dbh=new PDO("pgsql:host=$host; dbname=$dbname", $username,$password);
        return $conectar;
            }catch(Exception $e){
        print "No se Conecto A la base de Datos".$e->getMessage()."</br>";
            die();
        }
           
        }

        public function set_name(){
            return $this->dbh->query("SET NAME 'utf8");
        }

        public static function ruta(){
            return "http://localhost/sisi/";
            //cambiamos por el url del servidor a correr
        }
    }

?>