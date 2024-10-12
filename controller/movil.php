<?php

require_once("../config/conexion.php");
require_once("../models/Movil.php");

$movil = new Movil();

switch ($_GET["op"]) {

    case "guardarEditarMovil" :
        if(empty($_POST["unid_id"])){
            $movil->insert_movil($_POST["unid_anio"],strtoupper($_POST["unid_placa"]),strtoupper($_POST["unid_motor"]),strtoupper($_POST["unid_adquisicion"]),
            strtoupper($_POST["unid_observacion"]),$_POST["tiun_id"],$_POST["depe_id"],$_POST["mode_id"],strtoupper($_POST["unid_codigo"]),
                                $_POST["colo_id"],$_POST["comb_id"]);
            
        }else{
            $movil->update_movil($_POST["unid_id"],strtoupper($_POST["unid_anio"]),strtoupper($_POST["unid_placa"]),strtoupper($_POST["unid_motor"]),strtoupper($_POST["unid_adquisicion"]),
            strtoupper($_POST["unid_observacion"]),$_POST["tiun_id"],$_POST["depe_id"],$_POST["mode_id"],strtoupper($_POST["unid_codigo"]),
                                 $_POST["colo_id"],$_POST["comb_id"] );
        }
        break;


  /*   case "guardaryeditarMovil":
        if (empty($_POST["unid_id"])) {
            $new_id = $movil->insert_movil(
                $_POST["unid_anio"], $_POST["unid_placa"], $_POST["unid_motor"], 
                $_POST["unid_adquisicion"], $_POST["unid_observacion"], $_POST["tiun_id"], 
                $_POST["depe_id"], $_POST["mode_id"], $_POST["unid_codigo"], 
                $_POST["comb_id"]
            );

            if ($new_id) {
                // Actualizar color usando el ID generado
                $result = $movil->actualizarColor($new_id, $_POST["colo_id"]);
             }
        } else {
            $movil->update_movil($_POST["unid_id"],$_POST["unid_anio"], $_POST["unid_placa"], $_POST["unid_motor"], $_POST["unid_adquisicion"],
                                $_POST["unid_observacion"], $_POST["tiun_id"], $_POST["depe_id"], $_POST["mode_id"], $_POST["unid_codigo"],
                                $_POST["unco_id"], $_POST["comb_id"]);
        }
        break;*/
    

     case "combo_area":
        $datos = $movil->get_area();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Area de destino'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['depe_id'] . "'>" . $row['depe_denominacion'] . "</option>";
            }
            echo $html;
        }
        break; 


    case "combo_marca":
        $datos = $movil->get_marca();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Marca'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['marc_id'] . "'>" . $row['marc_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;







    case "combo_modelo":
        $datos = $movil->get_modelo($_POST["marc_id"]);

        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Modelo'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['mode_id'] . "'>" . $row['mode_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;



        case "combo_combustible":
            $datos = $movil->get_combustible( );
    
            if (is_array($datos) == true and count($datos) > 0) {
                $html = "<option label='Seleccione Combustible'></option>";
                foreach ($datos as $row) {
                    $html .= "<option value='" . $row['comb_id'] . "'>" . $row['comb_descripcion'] . "</option>";
                }
                echo $html;
            }
            break;
    

    case "guardaryeditarmarca":
        if (empty($_POST["marc_id"])) {
            $movil->insert_marca(strtoupper($_POST["marc_descripcion"]));
        } else {
            $movil->update_marca($_POST["marc_id"], strtoupper($_POST["marc_descripcion"]));
        }
        break;






    case "combo_tipo":
        $datos = $movil->get_tipo();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Tipo de Unidad'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tiun_id'] . "'>" . $row['tiun_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;



    case "combo_color":
        $datos = $movil->get_color();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Color'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['colo_id'] . "'>" . $row['colo_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;


    case "modelo_por_id":
        $datos = $movil->get_modelo($_POST["marc_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Modelo'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['marc_id'] . "'>" . $row['mode_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;





        /* TODO LISTANDO LA TABLA PRINCPAL */

    case "listar":
        $datos = $movil->get_lista_movil();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["unid_id"];
            $sub_array[] = $row["unid_codigo"];
            $sub_array[] = $row["depe_denominacion"];
            $sub_array[] = $row["tiun_descripcion"];
            $sub_array[] = $row["marc_descripcion"];
            $sub_array[] = $row["mode_descripcion"];
            $sub_array[] = $row["unid_adquisicion"];
            if ($row["unid_estado"] == "1") {
                $sub_array[] = '<button  class="btn btn-oblong btn-warning ">Activo</button>';
            } else {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger  ">InActivo</button>';
            }


            /* $sub_array[] = $row["colo_descripcion"]; */
            $sub_array[] = $row["colo_descripcion"];
            $sub_array[] = $row["comb_descripcion"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["unid_id"] . ');"  id="' . $row["unid_id"] . '" class="btn btn-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["unid_id"] . ');"  id="' . $row["unid_id"] . '" class="btn btn-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
          
                
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

 /* ELIMINAR SEGUN ID */
 case "eliminarmovil":
    $movil->delete_unidad($_POST["unid_id"]);
    break;


    case "mostrarMovil":
        $datos = $movil->get_movil_id($_POST["unid_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["unid_id"] = $row["unid_id"];
                $output["tiun_id"] = $row["tiun_id"];
                $output["unid_codigo"] = $row["unid_codigo"];
                $output["marc_id"] = $row["marc_id"];
                $output["mode_id"] = $row["mode_id"];
                $output["depe_id"] = $row["area_id"];
                $output["unid_placa"] = $row["unid_placa"];
                $output["colo_id"] = $row["colo_id"];
                $output["unid_anio"] = $row["unid_anio"];
                $output["comb_id"] = $row["comb_id"];
                $output["unid_adquisicion"] = $row["unid_adquisicion"];
                $output["unid_motor"] = $row["unid_motor"];
                $output["unid_observacion"] = $row["unid_observacion"];
         
            }
            echo json_encode($output);
        }
        break;



}