<?php 
session_start();
    class Conectar{
        protected $dbh;

        protected function Conexion(){


 $host="localhost";
 $dbname="mpch";
 $username="postgres";
 $password="postgres";



    //$host="192.168.12.77"; // pruebas 
    // $host="10.10.10.9"; // produccion
    //$dbname="dbsimcix";
    //$username="postgres";
    //$password="sgd*2024";

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