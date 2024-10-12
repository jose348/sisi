<?php

require_once("../config/conexion.php");
require_once("../models/Solicitud.php");

$solicitud = new Solicitud();

switch ($_GET["op"]) {
    case "mostrarSolicitud":

        if (isset($_POST["sore_id"])) {
            $datos = $solicitud->detalle_soli_x_id($_POST["sore_id"]);
            if (is_array($datos) == true and ($datos) > 0) {
                foreach ($datos as $row) {

                    $output["sore_id"] = $row["sore_id"];
                    $output["sore_titulo"] = $row["sore_titulo"];

 
                    $output["repu_id"] = $row["repu_id"];
                    $output["repu_descripcion"] = $row["repu_descripcion"];
                    $output["sore_fecha"] = date('d/m/yy', strtotime($row["sore_fecha"]));
                    $output["sore_cantidad"] = $row["sore_cantidad"];
                    if ($row["sore_estado"] == 1) {
                        $output["sore_estado"] = '<button class="btn btn-oblong btn-success" >Solicitud Abierta</button>';
                    } else {
                        $output["sore_estado"] = '<button class="btn btn-oblong btn-danger" >Solicitud Cerrada</button>';
                    }

                    $output["sore_cantidad_text"] = $row["sore_estado"];
                }
                echo json_encode($output);
            }else{
                echo "ID no encontrada";
            }
        }
        break;



    case "comboRepuesto":
        $datos = $solicitud->combo_repuesto();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['repu_id'] . "'>" . $row['repu_descripcion'] . " /   " . $row['repu_stock'] . "</option>";
            }
            echo $html;
        }
        break;

    case "rechazar":
        $solicitud->rechazarSolicitud($_POST["sore_id"]);
        break;
}
