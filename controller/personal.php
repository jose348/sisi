<?php
require_once("../config/conexion.php");
require_once("../models/Personal.php");

$personal = new Personal();

switch ($_GET["op"]) {

    case "update_personal":
        if (!empty($_POST["pers_id"])) {  // Ensure pers_id is not empty
            $result = $personal->update_personal($_POST["pers_id"], $_POST["carg_id"]);
    
            if ($result) {
                echo json_encode(["status" => "success", "message" => "Se actualizó correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID de persona vacío"]);
        }
        break;

        case "update_personal_update":
            if (!empty($_POST["pers_id"])) {  // Ensure pers_id is not empty
                $result = $personal->update_personal_perfil($_POST["pers_id"], $_POST["perf_id"]);
        
                if ($result) {
                    echo json_encode(["status" => "success", "message" => "Se actualizó correctamente"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "No se pudo actualizar"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ID de persona vacío"]);
            }
            break;

    case "listarPersonal":
        $datos = $personal->get_personal();
        if (is_array($datos) == true and ($datos) > 0) {

            foreach ($datos as $row) {
                $sub_array = array();
                //$sub_array[] = strtoupper($row["pers_id"]);
                $sub_array[] = strtoupper($row["nombre_persona"]);
                $sub_array[] = strtoupper($row["pers_dni"]);
                $sub_array[] = strtoupper($row["depe_denominacion"]);
                $sub_array[] = strtoupper($row["carg_denominacion"]);
                $sub_array[] = strtoupper($row["perf_nombre"]);
                //$sub_array[] = strtoupper($row["sist_denominacion"]);
                $sub_array[] = '<button type="button" onClick="ver(' . $row["pers_id"] . ');"  id="' . $row["pers_id"] . '" class="btn btn-success btn-icon"><div><i class="fa fa-eye"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="edit(' . $row["pers_id"] . ');"  id="' . $row["pers_id"] . '" class="btn btn-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';

                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["pers_id"] . ');"  id="' . $row["pers_id"] . '" class="btn btn-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
        }
        break;


    case "mostrarPersonal":
        $datos = $personal->get_personal_modal($_POST["pers_id"]);
        if (is_array($datos) == true and count($datos) <> 0) { //si el dato tiene valores en arrays y es diferente de cero entonces
            foreach ($datos as $row) { //recorro con un foreach los resultado de lo que viene de $datos y que fue pasado por $_POST["pers_id]
                $output["pers_id"] = $row["pers_id"]; //$output captura el resultado y lo guadar y lo sede al $row
                $output["nombre_persona"] = $row["nombre_persona"];
                $output["pers_dni"] = $row["pers_dni"];
                $output["depe_id"] = $row["depe_id"];
                $output["depe_denominacion"] = $row["depe_denominacion"];
                $output["carg_id"] = $row["carg_id"];
                $output["carg_denominacion"] = $row["carg_denominacion"];
                $output["perf_nombre"] = $row["perf_nombre"];
                $output["sist_id"] = $row["sist_id"];
                $output["sist_denominacion"] = $row["sist_denominacion"];
                $output["perm_fechacrea"] = $row["perm_fechacrea"];
            }
            echo json_encode($output); //el resultado que trae output lo imprimos en unjson 
        }
        break;


    case "mostrarPersonalEditar":
        $datos = $personal->get_personal_modal($_POST["pers_id"]);
        if (is_array($datos) == true and count($datos) <> 0) { //si el dato tiene valores en arrays y es diferente de cero entonces
            foreach ($datos as $row) { //recorro con un foreach los resultado de lo que viene de $datos y que fue pasado por $_POST["pers_id]
                $output["pers_id"] = $row["pers_id"]; //$output captura el resultado y lo guadar y lo sede al $row
                $output["nombre_persona"] = $row["nombre_persona"];
                $output["pers_dni"] = $row["pers_dni"];
                $output["depe_id"] = $row["depe_id"];
                $output["depe_denominacion"] = $row["depe_denominacion"];
                $output["carg_id"] = $row["carg_id"];
                $output["carg_denominacion"] = $row["carg_denominacion"];
                $output["perf_nombre"] = $row["perf_nombre"];
                $output["sist_id"] = $row["sist_id"];
                $output["sist_denominacion"] = $row["sist_denominacion"];
                $output["perm_fechacrea"] = $row["perm_fechacrea"];
            }
            echo json_encode($output); //el resultado que trae output lo imprimos en unjson 
        }
        break;

    case "combo_cargo":
        $datos = $personal->combo_cargo();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .=  "<option value='" . $row['carg_id'] . "'>" . $row['carg_denominacion'] .  "</option>";
            }
            echo $html;
        }
        break;


        case "combo_perfil":
        $datos = $personal->combo_perfil();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .=  "<option value='" . $row['perf_id'] . "'>" . $row['perf_nombre'] .  "</option>";
            }
            echo $html;
        }
        break;
        case "dar_baja_personal":
            $personal->dar_baja_personal($_POST["pers_id"]);            
        break;
    
}
