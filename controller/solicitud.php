<?php

require_once("../config/conexion.php");
require_once("../models/Solicitud.php");

$solicitud = new Solicitud();

switch ($_GET["op"]) {
    case "mostrarSolicitud":
        $datos = $solicitud->detalle_soli_x_id($_POST["deso_id"]);
        if (is_array($datos) == true and ($datos) > 0) {
            foreach ($datos as $row) {
                $output["deso_id"] = $row["deso_id"];
                $output["sore_id"] = $row["sore_id"];
                $output["sore_titulo"] = $row["sore_titulo"];


                /*    if ($row["sore_estado"] == 1) {
                        $output["sore_estado"]='<button class="btn btn-oblong btn-success" id="lblestado">Solicitud Abierta</button>';
                    } else if ($row["sore_estado"] == 2) {
                        $output["sore_estado"]='<button class="btn btn-oblong btn-warning" id="lblestado">Solicitud En Proceso</button>';
                    } else if ($row["sore_estado"] == 3) {
                        $output["sore_estado"]='<button class="btn btn-oblong btn-secondary" id="lblestado">Solicitud Terminado</button>';
                    } else {
                        $output["sore_estado"]='<button class="btn btn-oblong btn-danger" id="lblestado">Solicitud Cerrado</button>';
                    }   */

                $output["repu_id"] = $row["repu_id"];
                $output["repu_descripcion"] = $row["repu_descripcion"];
                $output["sore_fecha"] = date('d/m/yy', strtotime($row["sore_fecha"]));
                $output["deso_cantidad"] = $row["deso_cantidad"];
                if ($row["deso_estado"] == 1) {
                    $output["deso_estado"] = '<button class="btn btn-oblong btn-success" >Solicitud Abierta</button>';
                } else {
                    $output["deso_estado"] = '<button class="btn btn-oblong btn-danger" >Solicitud Cerrada</button>';
                }

                $output["deso_cantidad_text"] = $row["deso_estado"];

            }
            echo json_encode($output);
        }
        break;

    case "comboRepuesto":
        $datos = $solicitud->combo_repuesto();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['repu_id'] . "'>" . $row['repu_descripcion'] ." /   " . $row['repu_stock']."</option>";
            }
            echo $html;
        }
        break;

        case "rechazar":
            $solicitud->rechazarSolicitud($_POST["deso_id"]);
            break;
}
