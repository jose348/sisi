<?php

require_once("../config/conexion.php");
require_once("../models/Modelo.php");

$modelo = new Modelo();

switch ($_GET["op"]) {

    case "guardaryeditarModelo":
        if (empty($_POST["mode_id"])) {
            $modelo->insert_modelo(strtoupper($_POST["mode_descripcion"]), $_POST["marc_id"]) ;
        } else {
            $modelo->update_modelo($_POST["mode_id"], strtoupper($_POST["mode_descripcion"]), $_POST["marc_id"]);
        }
        break;


      /* TODO LISTANDO TABLA MODELO */
        /* TODO LISTANDO TABLA MODELO */
        /* TODO LISTANDO TABLA MODELO */

        case "listaModelo":
            $datos = $modelo->get_modelotabla();
    
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["mode_id"];
                $sub_array[] = $row["mode_descripcion"];
                $sub_array[] = $row["mode_estado"];
                $sub_array[] = $row["marc_descripcion"];
                $sub_array[] = '<button type="button" onClick="editar(' . $row["mode_id"] . ');"  id="' . $row["mode_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["mode_id"] . ');"  id="' . $row["mode_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
    echo json_encode($results);
            break;



            case "combo_marca":
                $datos = $modelo->combo_marca();
                if (is_array($datos) == true and count($datos) > 0) {
                    $html = "<option label='Seleccione'></option>";
                    foreach ($datos as $row) {
                        $html .= "<option value='" . $row['marc_id'] . "'>" . strtoupper($row['marc_descripcion']) . "</option>";
                    }
                    echo $html;
                }
                break;


                case "mostrarModelo":
                    $datos = $modelo->get_modelo_id($_POST["mode_id"]);
                    if (is_array($datos) == true and count($datos) <> 0) {
                        foreach ($datos as $row) {
                            $output["mode_id"] = $row["mode_id"];
                            $output["mode_descripcion"] = $row["mode_descripcion"];                        
                            $output["marc_id"] = $row["marc_id"];
            
                        }
                        echo json_encode($output);
                    }
                    break;

                    case "eliminar":
                        $modelo->delete_modelo($_POST["mode_id"]);
                        break;
        
}