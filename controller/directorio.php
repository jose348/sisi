<?php

require_once("../config/conexion.php");
require_once("../models/Directorio.php");

$directorio = new Directorio();

switch ($_GET["op"]) {


    case "combo_trabajador":
        $datos = $directorio->combo_trabajador();
        if (is_array($datos) && count($datos) > 0) {
            $html = "<option value='' label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['pers_id'] . "'>" . $row['pers_nombre_completo'] . "</option>";
            }
            echo $html;
        }
        break;



    case "combo_funcion":
        $datos = $directorio->combo_funciones();
        if (is_array($datos) && count($datos) > 0) {
            $html = "<option value='' label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['func_id'] . "'>" . $row['func_descrip'] . "</option>";
            }
            echo $html;
        }
        break;



        case "listarDirectorio":
            $datos = $directorio->get_directorio();
        
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["pers_nombre_completo"];  // Trabajador
                $sub_array[] = $row["func_descrip"];          // Función
                $sub_array[] = $row["direct_fecha"];          // Fecha
                $sub_array[] = '
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                            Acciones
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-warning" href="#" onClick="editar(' . $row["direct_id"] . ');">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                                <a class="dropdown-item text-danger" href="#" onClick="eliminar(' . $row["direct_id"] . ');">
                                    <i class="fa fa-trash"></i> Eliminar
                                </a>
                        </div>
                    </div>';
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
        



    case "obtenerDirectorio":
        $direct_id = $_POST['direct_id'];  // Recibir el ID enviado desde la solicitud AJAX
        $datos = $directorio->get_directorio_by_id($direct_id);  // Llama a la función del modelo
        echo json_encode($datos);  // Devuelve los datos como JSON
        break;



    case "updateDirectorio":
        $direct_id = $_POST["direct_id"];
        $pers_id = $_POST["trabajador_id"];
        $func_id = $_POST["func_id"];
        $direct_descrip = $_POST["descripcionTarea"];
        $direct_fecha = $_POST["fechaAsignacion"];

        // Llamar al método del modelo para actualizar el registro
        $directorio->update_directorio($direct_id, $pers_id, $func_id, $direct_descrip, $direct_fecha);

        // Retornar una respuesta (puedes devolver un mensaje o simplemente un estado de éxito)
        echo json_encode(["status" => "success"]);
        break;



    case "deleteDirectorio":
        $direct_id = $_POST["direct_id"];  // Recibir el ID del registro a eliminar
        $directorio->delete_directorio($direct_id);  // Llamar a la función del modelo para eliminar
        echo json_encode(["status" => "success"]);  // Devolver una respuesta exitosa
        break;
}
