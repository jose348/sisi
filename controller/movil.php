<?php 
    require_once("../config/conexion.php");
    require_once("../models/Movil.php");
    $movil = new Movil();

    switch($_GET["op"]){
        
        
        case "combo_area":
            $datos=$movil->get_area();
            if(is_array($datos)==true and count($datos)>0){
                $html="<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.="<option value='".$row['depe_id']."'>".$row['depe_denominacion']."</option>";
                }
                echo $html;
            }
            break;


            case "combo_marca":
                $datos=$movil->get_marca();
                if(is_array($datos)==true and count($datos)>0){
                $html="<option label='Seleccione Marca'></option>";
                foreach($datos as $row){
                    $html.="<option value='".$row['marc_id']."'>".$row['marc_descripcion']."</option>";
                }
                echo $html;
            }
            break;

            case "combo_tipo":
                $datos=$movil->get_tipo();
                if(is_array($datos)==true and count($datos)>0){
                    $html="<option label='Seleccione Tipo'></option>";
                    foreach ( $datos as $row) {
                        $html.="<option value='".$row['tiun_id']."'>".$row['tiun_descripcion']."</option>";
                    }
                    echo $html;
                }
                break;



            case "combo_color":
                $datos=$movil->get_color();
                if(is_array($datos)==true and count($datos)>0  ){
                    $html="<option label='Seleccione Tipo'></option>";
                    foreach ($datos as $row) {
                        $html.="<option value='".$row['colo_id']."'>".$row['colo_descripcion']."</option>";
                    }
                    echo $html;
                }
                break;    


                case "modelo_por_id":
                    $datos=$movil->get_modelo($_POST["marc_id"]);
                if(is_array($datos)==true and count($datos)>0  ){
                    $html="<option label='Seleccione Modelo'></option>";
                    foreach ($datos as $row) {
                        $html.="<option value='".$row['marc_id']."'>".$row['mode_descripcion']."</option>";
                    }
                    echo $html;
                }
                break;    


           


                case "listar":
                        $datos=$movil->get_lista_movil();
                        $data = Array();
                        foreach($datos as $row){
                            $sub_array=array();
                            $sub_array[]=$row["unid_codigo"];
                      
                            $sub_array[]=$row["tiun_descripcion"];
                            $sub_array[]=$row["marc_descripcion"];
                            $sub_array[]=$row["mode_descripcion"];
                            $sub_array[]=$row["unid_adquisicion"];
                            $sub_array[]=$row["unid_estado"];
                            $sub_array[]=$row["colo_descripcion"];
                            $sub_array[]=$row["comb_descripcion"];
                            $data[]=$sub_array;
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