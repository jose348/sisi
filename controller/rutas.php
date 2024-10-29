<?php 
    require_once("../config/conexion.php");
    require_once("../models/Rutas.php");

    $rutas=new Rutas();

switch($_GET["op"]){

    case "obtenerHorarios":
        $datos=$rutas->obtenerHorarios();
        echo json_encode($datos);
        break;
        
    }

?>