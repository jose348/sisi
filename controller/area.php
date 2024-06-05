<?php 
    require_once("../config/conexion.php");
    require_once("../models/Area.php");

    $area=new Area();

    switch($_GET["op"]){

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


    }
    ?>
