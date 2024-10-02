<?php

require_once("../config/conexion.php");
require_once("../models/Bita.php");

$bita = new Bita();

switch ($_GET["op"]) {

    case "combo_tipo_unidad_busquedad":
        $datos = $bita->combo_tipo_busquedad();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Especialidad'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tiun_id'] . "'>" . $row['tiun_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_modelo_busquedad":
        $datos = $bita->combo_modelo_busquedad();
        if (is_array($datos) == true  and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['mode_id'] . "'>" . $row['mode_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_marca_busquedad":
        $datos = $bita->combo_marca_busquedad();
        if (is_array($datos) == true  and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['marc_id'] . "'>" . $row['marc_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;



    case "listar_bitacora":
        $tiun_id = isset($_POST["tiun_id"]) ? $_POST["tiun_id"] : "";
        $mode_id = isset($_POST["mode_id"]) ? $_POST["mode_id"] : "";
        $marc_id = isset($_POST["marc_id"]) ? $_POST["marc_id"] : "";
        $placaUnidad = isset($_POST["placaUnidad"]) ? $_POST["placaUnidad"] : "";

        $datos = $bita->get_lista_bitacora($tiun_id, $mode_id, $marc_id, $placaUnidad);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = '<button class="btn btn-outline-info rounded-pill ver-btn" data-id="' . $row["unid_id"] . '">
    <i class="fa fa-eye"></i> Ver
</button>';


            $sub_array[] = $row["unid_placa"];
            $sub_array[] = $row["tiun_descripcion"];
            $sub_array[] = $row["mode_descripcion"];
            $sub_array[] = $row["marc_descripcion"];
            $sub_array[] = $row["inun_fecha"];
            $sub_array[] = $row["prma_fecha"];
            $sub_array[] = $row["tickdo_numtick"];
            $sub_array[] = $row["mant_fech"];
            $data[] = $sub_array;
        }

        $results = array(
            "draw" => 1,
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($results);
        break;



    case "ver_movimientos":
        $unid_id = $_POST["unid_id"];
        $datos = $bita->get_movimientos_unidad($unid_id);
        echo json_encode($datos);
        break;



        /*TODO QUERY PARA VER EN MODAL DE MI HISTORIAL */
        case "get_historial_unidad":
            $unid_id = $_POST['unid_id'];
            $datos = $bita->get_historial_unidad($unid_id);
        
            // Verificar si hay registros para esa unidad
            if (!empty($datos)) {
                // Construir el título con detalles adicionales de la unidad
                $html = '<div class="modal-dialog modal-lg" style="width: 750px;">'; // Hacemos el modal más ancho
                $html .= '<div class="modal-content">'; // Inicia el contenido del modal
        
                // Título del modal
                $html .= '<div class="modal-header bg-primary text-white">';
                $html .= '<h5 class="modal-title">Historial de la Unidad</h5>';
                $html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                $html .= '<span aria-hidden="true">&times;</span>';
                $html .= '</button>';
                $html .= '</div>';
        
                // Cuerpo del modal
                $html .= '<div class="modal-body" style="font-size: 1.2rem; padding: 25px;">';
                $html .= '<div class="text-center mb-4">';
                $html .= '<h4 style="color: #007bff; font-weight: bold;">Placa: ' . $datos[0]['unid_placa'] . '</h4>';
                $html .= '<p><strong>Tipo de Unidad:</strong> <span style="color: #17a2b8;">' . $datos[0]['tiun_descripcion'] . '</span></p>';
                $html .= '<p><strong>Marca:</strong> <span style="color: #28a745;">' . $datos[0]['marc_descripcion'] . '</span></p>';
                $html .= '<p><strong>Modelo:</strong> <span style="color: #ffc107;">' . $datos[0]['mode_descripcion'] . '</span></p>';
                $html .= '</div>';
        
                // Lista de historial
                $html .= '<ul class="list-group">';
                foreach ($datos as $row) {
                    $html .= '<li class="list-group-item" style="margin-bottom: 15px; padding: 20px; border-radius: 8px; width: 100%; box-shadow: 0px 4px 6px rgba(0,0,0,0.1);">';
                    
                    // Fecha y hora en una fila, alineados
                    $html .= '<div class="row mb-3">';
                    $html .= '<div class="col-md-7"><strong>Fecha de Ingreso:</strong> ' . $row['inun_fecha'] . '</div>';
                    $html .= '<div class="col-md-5"><strong>Hora de Ingreso:</strong> ' . $row['inun_hora'] . '</div>';
                    $html .= '</div>';
        
                    // Chofer y diagnóstico en una fila, alineados
                    $html .= '<div class="row mb-3">';
                    $html .= '<div class="col-md-7"><strong>Chofer:</strong> <span style="color: #28a745;">' . $row['chofer'] . '</span></div>';
                    $html .= '<div class="col-md-5"><strong>Diagnóstico:</strong> <span style="color: #dc3545;">' . $row['inun_diagnostico'] . '</span></div>';
                    $html .= '</div>';
        
                    // Fecha programación y ticket en una fila, alineados
                    $html .= '<div class="row mb-3">';
                    $html .= '<div class="col-md-7"><strong>Fecha Prog. Mant.:</strong> <span style="color: #ffc107;">' . $row['prma_fecha'] . '</span></div>';
                    $html .= '<div class="col-md-5"><strong>Ticket:</strong> <span style="color: #007bff;">' . $row['tickdo_numtick'] . '</span></div>';
                    $html .= '</div>';
        
                    // Fecha mantenimiento, alineada
                    $html .= '<div class="row">';
                    $html .= '<div class="col-md-12"><strong>Fecha Mantenimiento:</strong> ' . $row['mant_fech'] . '</div>';
                    $html .= '</div>';
                    
                    $html .= '</li>';
                }
                $html .= '</ul>';
        
                $html .= '</div>'; // Fin del cuerpo del modal
                $html .= '</div>'; // Fin del contenido del modal
                $html .= '</div>'; // Fin del diálogo del modal
            } else {
                $html = '<p class="text-center">No se encontraron registros para esta unidad.</p>';
            }
        
            echo $html;
            break;
        
        
        
}
