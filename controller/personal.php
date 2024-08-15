<?php
require_once("../config/conexion.php");
require_once("../models/Personal.php");

$personal = new Personal();

switch ($_GET["op"]) {
    case "listarPersonal":
        $datos = $personal->get_personal();
        if (is_array($datos) == true and ($datos) > 0) {

        foreach ($datos as $row) {
            $sub_array = array();
      
            $sub_array[] = strtoupper($row["nombre_persona"]);
            $sub_array[] = strtoupper($row["pers_dni"]);
            $sub_array[] = strtoupper($row["depe_denominacion"]);
            $sub_array[] = strtoupper($row["carg_denominacion"]);
            $sub_array[] = strtoupper($row["perf_nombre"]);
            $sub_array[] = strtoupper($row["sist_denominacion"]);
   
            $sub_array[] = '<button type="button" onClick="ver(' . $row["pers_id"] . ');"  id="' . $row["pers_id"] . '" class="btn btn-success btn-icon"><div><i class="fa fa-eye"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="editar(' . $row["pers_id"] . ');"  id="' . $row["pers_id"] . '" class="btn btn-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["pers_id"] . ');"  id="' . $row["pers_id"] . '" class="btn btn-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
}
