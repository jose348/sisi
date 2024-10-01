<?php

require_once("../config/conexion.php");
require_once("../models/Mecanico.php");



$mecanico = new mecanico();

switch ($_GET["op"]) {


    case "combo_motivo_de_mantenimiento":
        $datos = $mecanico->combo_motivo_de_mantenimiento();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Especialidad'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['esme_id'] . "'>" . $row['esme_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "buscar_ticket":
        $ticketNumber = $_POST['ticketNumber'];
        $ticketData = $mecanico->buscar_ticket($ticketNumber);

        if ($ticketData) {
            // Incluimos el estado del ticket en la respuesta
            echo json_encode($ticketData);
        } else {
            echo json_encode(false);
        }
        break;

    case "actualizar_estado_ticket":
        $ticketNumber = $_POST['ticketNumber'];
        $response = $mecanico->actualizar_estado_ticket($ticketNumber, 'R'); // Cambiar estado a 'R' (Recibido)

        if ($response) {
            echo 'success';
        } else {
            echo 'error';
        }
        break;


        // Combo para cargar los mecánicos
    case "combo_mecanicos":
        $datos = $mecanico->combo_mecanicos();
        if (is_array($datos) == true && count($datos) > 0) {
            $html = "<option value=''>Seleccione un mecánico</option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['direct_id'] . "'>" . $row['mecanico'] . "</option>";
            }
            echo $html;
        }
        break;


        /*TODO GUARDAR FORMULARIO */
 
        
}