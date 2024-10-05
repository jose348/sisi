<?php

require_once("../config/conexion.php");
require_once("../models/Mecanico.php");



$mecanico = new Mecanico();

switch ($_GET["op"]) {


    case "combo_motivo_de_mantenimiento":
        $datos = $mecanico->combo_motivo_de_mantenimiento();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option value=''>Seleccione un mecánico</option>";
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
    case "guardar_formulario_mantenimiento":
        try {
            // Recoger los datos del formulario
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
            $hora = isset($_POST['hora']) ? $_POST['hora'] : null;
            $mecanico_id = isset($_POST['mecanico_id']) ? $_POST['mecanico_id'] : null;
            $diagnostico = isset($_POST['diagnostico']) ? $_POST['diagnostico'] : null;
            $accion = isset($_POST['accion']) ? $_POST['accion'] : null;
            $esme_id = isset($_POST['esme_id']) ? $_POST['esme_id'] : null;
            $tickdo_id = isset($_POST['tickdo_id']) ? $_POST['tickdo_id'] : null; // Opcional
            $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;

            // Manejar las imágenes y el informe (validar y subir los archivos)
            $foto_vehiculo = subirArchivo('foto-vehiculo', ['jpg', 'jpeg', 'png'], 4 * 1024 * 1024);
            $imagen_salida = subirArchivo('imagen-salida', ['jpg', 'jpeg', 'png'], 4 * 1024 * 1024);
            $informe = null;

            // Verificar si hay un archivo de informe para subir
            if (isset($_FILES['informe']) && $_FILES['informe']['size'] > 0) {
                $informe = subirArchivo('informe', ['pdf', 'doc', 'docx'], 4 * 1024 * 1024);
            }

            // Comprobar si las imágenes son válidas
            if ($foto_vehiculo && $imagen_salida) {
                // Llamar a la función de insertar mantenimiento
                $resultado = $mantenimiento->insertar_mantenimiento(
                    $fecha,
                    $hora,
                    $mecanico_id,
                    $diagnostico,
                    $accion,
                    $esme_id,
                    $foto_vehiculo,
                    $imagen_salida,
                    $tickdo_id,
                    $empresa,
                    $informe
                );

                if ($resultado) {
                    echo json_encode(['status' => 'success', 'message' => 'Mantenimiento guardado correctamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al guardar en la base de datos.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'La imagen inicial o de salida no es válida o excede los 4 MB.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Hubo un problema al guardar el mantenimiento: ' . $e->getMessage()]);
        }
        break;


        // Operación que maneja la solicitud para listar ingresos de vehículos


        case "listar_ingresos":
            $datos = $mecanico->listar_ingresos();
            echo json_encode($datos);
             
            break;
        
}




// Función para subir archivos y validarlos
function subirArchivo($inputName, $extensionesValidas, $maxSize)
{
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES[$inputName];
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        // Validar el tipo de archivo y el tamaño
        if (in_array($ext, $extensionesValidas) && $archivo['size'] <= $maxSize) {
            $destino = "../uploads/" . uniqid() . '.' . $ext;

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                return $destino; // Devuelve la ruta del archivo
            } else {
                throw new Exception("Error al mover el archivo al directorio de destino.");
            }
        } else {
            throw new Exception("Archivo no válido o excede el tamaño permitido.");
        }
    }
    return null; // Si no hay archivo subido o no es obligatorio



}
