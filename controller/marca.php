<?php 
    require_once("../config/conexion.php");
    require_once("../models/Marca.php");

    $marca=new Marca();

    switch($_GET["op"]){

        case "guardaryeditarMarca":
            if (empty($_POST["marc_id"])) {
                $marca->insert_marca(strtoupper($_POST["marc_descripcion"]));
            } else {
                $marca->update_marca($_POST["marc_id"],strtoupper( $_POST["marc_descripcion"]));
            }
            break;





        /* TODO ELIMNAMOS LA MARCA */
        case "eliminarMarca":
            $marca->delete_marca($_POST["marc_id"]);
            break;
    
    
            /* TODO COMBO PARA MI MODAL */
            case "combo_marca_modal":
                $datos=$marca->get_marca_modal();
                if(is_array($datos)==true  and count($datos)>0 ){
                    $html= " <option label='Seleccione'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['marc_id']."'>".$row['marc_descripcion']."</option>";
                    }
                    echo $html;
                }
            break;



            case "mostrarMarca":
                $datos = $marca->get_marca_id($_POST["marc_id"]);
                if (is_array($datos) == true and count($datos) <> 0) {
                    foreach ($datos as $row) {
                        $output["marc_id"] = $row["marc_id"];
                        $output["marc_descripcion"] = $row["marc_descripcion"];
                       
                    }
                    echo json_encode($output);
                }
                break;
    


                
  /* TODO LISTANDO TABLA MARCA */
        /* TODO LISTANDO TABLA MARCA */
        /* TODO LISTANDO TABLA MARCA */

        case "listaMarca":
            $datos = $marca->get_marcalist();
    
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["marc_id"];
                $sub_array[] = strtoupper($row["marc_descripcion"]);
                $sub_array[] = $row["marc_estado"];
                $sub_array[] = '<button type="button" onClick="editar(' . $row["marc_id"] . ');"  id="' . $row["marc_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["marc_id"] . ');"  id="' . $row["marc_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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