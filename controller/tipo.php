<?php

require_once("../config/conexion.php");
require_once("../models/Tipo.php");

$tipo = new Tipo();

switch ($_GET["op"]) {

    case "guardaryeditarTipo":
        if (empty($_POST["tiun_id"])) {
            $tipo->insert_tipo($_POST["tiun_descripcion"],strtoupper( $_POST["tiun_codigo"]));
        } else {
            $tipo->update_tipo($_POST["tiun_id"],strtoupper( $_POST["tiun_descripcion"]),strtoupper( $_POST["tiun_codigo"]));
        }
        break;


        case "mostrarTipo":
            $datos = $tipo->get_tipo_id($_POST["tiun_id"]);
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["tiun_id"] = $row["tiun_id"];
                    $output["tiun_descripcion"] = $row["tiun_descripcion"];
                    $output["tiun_codigo"] = $row["tiun_codigo"];
                   
                }
                echo json_encode($output);
            }
            break;


    
    case "listaTipo":
        $datos = $tipo->get_tipoLista();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tiun_id"];
            $sub_array[] = strtoupper($row["tiun_descripcion"]);
            $sub_array[] = $row["tiun_estado"];
            $sub_array[] = strtoupper($row["tiun_codigo"]);
            $sub_array[] = '<button type="button" onClick="editar(' . $row["tiun_id"] . ');"  id="' . $row["tiun_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["tiun_id"] . ');"  id="' . $row["tiun_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
     case "eliminar":
        $tipo->delete_tipo($_POST["tiun_id"]);
        break;


}
?>