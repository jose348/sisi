<?php
require_once("../config/conexion.php");
require_once("../models/Asignacionrutachofer.php");

$asignacionrutachofer = new Asignacionrutachofer();

switch ($_GET["op"]) {

    case "buscar_chofer":
        $term = isset($_POST["searchTerm"]) ? $_POST["searchTerm"] : "";
        $personas = $asignacionrutachofer->buscarchofer($term);
        echo json_encode($personas);
        break;


    case "buscar_ayudante":
        $term = isset($_POST["searchTerm"]) ? $_POST["searchTerm"] : "";
        $personas = $asignacionrutachofer->buscarAyudantes($term);
        echo json_encode($personas);
        break;


    case "listar_rutas":
        $data = $asignacionrutachofer->listarRutasDisponibles();
        echo json_encode($data);
        break;


    case "obtenerRutaGeoJSON":
        if (!isset($_POST['ubic_id'])) {
            echo json_encode(["success" => false, "message" => "ID de ruta no proporcionado."]);
            exit;
        }

        $ubic_id = $_POST['ubic_id'];
        $rutaData = $asignacionrutachofer->obtenerGeoJSONPorId($ubic_id);

        if ($rutaData) {
            echo json_encode(["success" => true, "data" => json_decode($rutaData['ubic_geojson'])]);
        } else {
            echo json_encode(["success" => false, "message" => "Ruta no encontrada."]);
        }
        break;


        case "listar_unidades":
            $datos = $asignacionrutachofer->listarUnidades(); // Ahora $unidadMovil está definido
            echo json_encode($datos);
            break;
    
        default:
            echo json_encode(["error" => "Operación no válida"]);
            break;
}
