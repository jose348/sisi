<?php
require_once("../config/conexion.php");
require_once("../models/Repuesto.php");

$repuesto = new Repuesto();
switch ($_GET["op"]) {

    case "guardaryEditarRpuesto";
        if (empty($_POST["repu_id"])) {
            $repuesto->insert_repuesto(
                strtoupper($_POST["repu_codigo"]),
                strtoupper($_POST["repu_descripcion"]),
                strtoupper($_POST["alma_id"]),
                $_POST["repu_stock"],
                $_POST["repu_precio_unitario"],
                strtoupper($_POST["repu_stock_total"]),
                strtoupper($_POST["repu_ultimo_ingreso"]),
                strtoupper($_POST["unme_id"]),
                strtoupper($_POST["repu_situacion"])
            );
        } else {
            $repuesto->update_repuesto(
                $_POST["repu_id"],
                strtoupper($_POST["repu_codigo"]),
                strtoupper($_POST["repu_descripcion"]),
                strtoupper($_POST["alma_id"]),
                $_POST["repu_stock"],
                $_POST["repu_precio_unitario"],
                /* strtoupper($_POST["repu_stock_total"]), */
                strtoupper($_POST["repu_ultimo_ingreso"]),
                strtoupper($_POST["unme_id"]),
                strtoupper($_POST["repu_situacion"])
            );
        }
        break;

    case "listarRepuestos":
        $datos = $repuesto->listar_respuesto();
        foreach ($datos as $row) {
            $sub_array = array();

            $sub_array[] = strtoupper($row["repu_codigo"]);
            $sub_array[] = strtoupper($row["repu_descripcion"]);
            if ($row["repu_stock"] <= 5) {
                $sub_array[] = '<button  class="alert alert-danger">' . $row["repu_stock"] . '</button>';
            } else {
                $sub_array[] = '<button class=" alert alert-success" >' . $row["repu_stock"] . '</button>';
            }


            if (empty($row["repu_stock_total"])) {
                $sub_array[] = 0;
            } else {
                $sub_array[] = $row["repu_stock_total"];
            }


            $sub_array[] = $row["repu_ultimo_ingreso"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["repu_id"] . ');" id"' . $row["repu_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-pencil"></i></div></button>
                            <button type="button" onClick="eliminar(' . $row["repu_id"] . ');" id"' . $row["repu_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-minus-circle"></i></div></button>';

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


    case "eliminarRepuesto":
        $repuesto->delete_respuesto_x_id($_POST["repu_id"]);

        break;

    case "mostraEditar":
        $datos = $repuesto->mostrar_editar($_POST["repu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["repu_id"] = $row["repu_id"];
                $output["repu_codigo"] = $row["repu_codigo"];
                $output["repu_descripcion"] = $row["repu_descripcion"];
                $output["alma_id"] = $row["alma_id"]; 
                $output["repu_stock"] = $row["repu_stock"];
                $output["repu_precio_unitario"] = $row["repu_precio_unitario"];
                /*  $output["repu_stock_total"]=$row["repu_stock_total"]; */
                $output["repu_ultimo_ingreso"] = $row["repu_ultimo_ingreso"];
                $output["unme_id"] = $row["unme_id"];
                $output["repu_situacion"] = $row["repu_situacion"];
            }
            echo json_encode($output);
        }
        break;

    case "comboResponsable":
        $datos = $repuesto->combo_respondableAlmacen();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['alma_id'] . "'>" . strtoupper($row['alma_responsable']) . "</option>";
            }
            echo $html;
        }

        break;

    case "comboUnidadMedida":
        $datos = $repuesto->combo_unidad_medida();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['unme_id'] . "'>" . strtoupper($row['unme_descripcion']) . "</option>";
            }
            echo $html;
        }

        break;


        case "eliminarMedida":
            $repuesto->eliminarMedida($_POST["unme_id"]);
    
            break;

    case "listaUmedida":
        $datos = $repuesto->listar_UnidadMedidad();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["unme_id"];
            $sub_array[] = $row["unme_codigo"];
            $sub_array[] = $row["unme_descripcion"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["unme_id"] . ');"  id="' . $row["unme_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["unme_id"] . ');"  id="' . $row["unme_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';

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

        case "guardaryEditarunidadMedida";
        if (empty($_POST["unme_id"])) {
            $repuesto->insert_unidad_medida(
                strtoupper($_POST["unme_codigo"]),
                strtoupper($_POST["unme_descripcion"])
                
            );
        } else {
            $repuesto->update_unidad_medida(
                $_POST["unme_id"],
                strtoupper($_POST["unme_codigo"]),
                strtoupper($_POST["unme_descripcion"])

            );
        }
        break;

        case "mostraUnidadMedida":
            $datos = $repuesto->mostrar_unidad_medida($_POST["unme_id"]);
            if (is_array($datos) == true and count($datos) > 0) {
                foreach ($datos as $row) {
                    $output["unme_id"] = $row["unme_id"];
                    $output["unme_codigo"] = $row["unme_codigo"];
                    $output["unme_descripcion"] = $row["unme_descripcion"];
                   
                   
                }
                echo json_encode($output);
            }
            break;

            case "comboStockRespuesto":
                $datos = $repuesto->combo_stok_repuesto();
                if (is_array($datos) == true and count($datos) > 0) {
                    $html = " <option label='Seleccione'></option>";
                    foreach ($datos as $row) {
                        $html .= "<option value='" . $row['repu_descripcion'] . "'>" . strtoupper($row['repu_descripcion']) . "</option>";
                    }
                    echo $html;
                }
        
                break;

                
                /* listar repuesto seleccionado por Combo del adminrepuetostock */

                case "listar_repuestoStock":
                    $datos = $repuesto->get_repuestostock_x_id($_POST["repu_descripcion"]); //guardamos en la variable datos la instancia de Models/Usuario.php y//le pasamos lo que viene por $_POST
                       $data=Array();
                       foreach ($datos as $row) {
                         $sub_array= array();
                         $sub_array[] = $row["repu_codigo"];
                         $sub_array[] = $row["repu_descripcion"];
                         $sub_array[] = $row["repu_stock"];
                         $sub_array[] = $row["repu_ultimo_ingreso"];
                         $sub_array[] = '<button type="button" onClick="certificado('.$row["repu_id"].');"  id="'.$row["repu_id"].'" class="btn btn-outline-info btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                         $sub_array[]='<button type="button" onClick="eliminar(' . $row["repu_id"] . ');"  id="' . $row["repu_id"] . '" class="btn btn-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                         $data[]=$sub_array;
                       }
            
                       $results = array(
                        "sEcho"=>1,
                        "iTotalRecords"=>count($data),
                        "iTotalDisplayRecords"=>count($data),
                        "aaData"=>$data);
                    echo json_encode($results);
            
                    break;

    }
