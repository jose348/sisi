<?php 
    require_once("../config/conexion.php");
    require_once("../models/Rutas.php");

    $rutas=new Rutas();

switch($_GET["op"]){

    case "obtenerHorarios":
        $datos=$rutas->obtenerHorarios();
        echo json_encode($datos);
        break;
        
    

    case "guardarRuta":
        $data = json_decode(file_get_contents("php://input"), true);

        $nombre = $data['nombre'];
        $estado = $data['estado'];
        $geojson = $data['geojson'];
        $horarioId = $data['horarioId'];
        $ubicaciones = $data['ubicaciones'];

        $resultado = $rutaModel->guardarRuta($nombre, $estado, $geojson, $horarioId, $ubicaciones);

        echo json_encode(['success' => $resultado]);
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
    }
?>