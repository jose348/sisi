<?php
require_once("../config/conexion.php");
require_once("../models/Area.php");

$area = new Area();

switch ($_GET["op"]) {

    case "guardaryeditarArea":
        if (empty($_POST["depe_id"])) {
            $area->insert_area(strtoupper($_POST["depe_codigo"]),
            strtoupper($_POST["depe_denominacion"]), strtoupper($_POST["depe_abreviatura"]),
             strtoupper($_POST["depe_siglasdoc"]), strtoupper($_POST["depe_representante"]),
              strtoupper($_POST["depe_cargo"]),strtoupper($_POST["depe_direccion"]),
               strtoupper($_POST["depe_telefono"]), strtoupper($_POST["depe_anexo"]),
                strtoupper($_POST["depe_codrof"]), $_POST["depe_superior"],
                 strtoupper($_POST["nior_id"]), strtoupper($_POST["tpor_id"]),
                  strtoupper($_POST["tpde_id"]), strtoupper($_POST["lomu_id"]));
        } else {
            $area->update_area(strtoupper($_POST["depe_id"]),
            strtoupper($_POST["depe_codigo"]), strtoupper($_POST["depe_denominacion"]),
             strtoupper($_POST["depe_abreviatura"]), strtoupper($_POST["depe_siglasdoc"]),
              strtoupper($_POST["depe_representante"]), strtoupper($_POST["depe_cargo"]),
              strtoupper($_POST["depe_direccion"]), strtoupper($_POST["depe_telefono"]),
               strtoupper($_POST["depe_anexo"]), strtoupper($_POST["depe_codrof"]),
                $_POST["depe_superior"], strtoupper($_POST["nior_id"]),
                 strtoupper($_POST["tpor_id"]), strtoupper($_POST["tpde_id"]), 
                 strtoupper($_POST["lomu_id"]));
        }
        break;


        /* TODO ELIMNAMOS LA AREA */
    case "eliminarArea":
        $area->delete_area($_POST["depe_id"]);
        break;



        /* TODO LISTANDO TABLA AREA */
        /* TODO LISTANDO TABLA AREA */
        /* TODO LISTANDO TABLA AREA */

    case "listaArea":
        $datos = $area->get_areaLista();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["depe_id"];
            $sub_array[] = $row["depe_codigo"];
            $sub_array[] = $row["depe_denominacion"];
            $sub_array[] = $row["depe_representante"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["depe_id"] . ');"  id="' . $row["depe_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["depe_id"] . ');"  id="' . $row["depe_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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

        /* TODO LLENADO COMBOX */
        /* TODO LLENADO COMBOX */
        /* TODO LLENADO COMBOX */
    case "combo_unidad":
        $datos = $area->combo_unidad();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tpde_id'] . "'>" . $row['tpde_denominacion'] . "</option>";
            }
            echo $html;
        }
        break;


    case "combo_nivel_organizacional":
        $datos = $area->combo_nivel_organizacional();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['nior_id'] . "'>" . $row['nior_denominacion'] . "</option>";
            }
            echo $html;
        }
        break;


    case "combo_organo":
        $datos = $area->combo_organo();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tpor_id'] . "'>" . $row['tpor_denominacion'] . "</option>";
            }
            echo $html;
        }
        break;


    case "combo_local_muni":
        $datos = $area->comobo_local_municipal();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['lomu_id'] . "'>" . $row['lomu_denominacion'] . " - " . $row['lomu_direccion'] . "</option>";
            }
            echo $html;
        }
        break;
        /* TODO LLENADO COMBOX */
        /* TODO LLENADO COMBOX */
        /* TODO LLENADO COMBOX */
        /* TODO LLENADO COMBOX */



        case "mostrarArea":
            $datos = $area->get_area_id($_POST["depe_id"]);
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["depe_id"] = $row["depe_id"];
                    $output["depe_codigo"] = $row["depe_codigo"];
                    $output["depe_denominacion"] = $row["depe_denominacion"];
                    $output["depe_abreviatura"] = $row["depe_abreviatura"];
                    $output["depe_siglasdoc"] = $row["depe_siglasdoc"];
                    $output["depe_representante"] = $row["depe_representante"];
                    $output["depe_cargo"] = $row["depe_cargo"];
                    $output["depe_direccion"] = $row["depe_direccion"];
                    $output["depe_telefono"] = $row["depe_telefono"];
                    $output["depe_anexo"] = $row["depe_anexo"];
                    $output["depe_codrof"] = $row["depe_codrof"];
                    $output["depe_superior"] = $row["depe_superior"];
                    $output["depe_estado"] = $row["depe_estado"];
                    $output["nior_id"] = $row["nior_id"];
                    $output["tpor_id"] = $row["tpor_id"];
                    $output["tpde_id"] = $row["tpde_id"];
                    $output["lomu_id"] = $row["lomu_id"];
    
                }
                echo json_encode($output);
            }
            break;

}
