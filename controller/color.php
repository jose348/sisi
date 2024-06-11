<?php

require_once("../config/conexion.php");
require_once("../models/Color.php");

$color = new Color();

switch ($_GET["op"]) {

    case "guardaryeditarColor":
        if (empty($_POST["colo_id"])) {
            $color->insert_color(strtoupper($_POST["colo_descripcion"]));
        } else {
            $color->update_color($_POST["colo_id"], strtoupper($_POST["colo_descripcion"]));
        }
        break;

        /* creando json segun el ID.... mostrar en lisata */
    case "mostrar":
        $datos = $color->get_color_id($_POST["colo_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["colo_id"] = $row["colo_id"];
                $output["colo_descripcion"] = $row["colo_descripcion"];
               
            }
            echo json_encode($output);
        }
        break;

    
             /* TODO LISTANDO TABLA COLORES */
        /* TODO LISTANDO TABLA COLORES */
        /* TODO LISTANDO TABLA COLORES */

        case "listaColores":
            $datos = $color->get_colorestabla();
    
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["colo_id"];
                $sub_array[] = strtoupper($row["colo_descripcion"]);
                $sub_array[] = $row["colo_estado"];
                $sub_array[] = '<button type="button" onClick="editar(' . $row["colo_id"] . ');"  id="' . $row["colo_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["colo_id"] . ');"  id="' . $row["colo_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
        $color->delete_color($_POST["colo_id"]);
        break;

    }

