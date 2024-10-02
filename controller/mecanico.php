<?php

require_once("../config/conexion.php");
require_once("../models/Mecanico.php");



$mecanico = new Mecanico();

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
        case "guardar_formulario_mantenimiento":
            try {
                // Recoger los datos del formulario
                $fecha = $_POST['fecha'];
                $hora = $_POST['hora'];
                $mecanico_id = $_POST['mecanico_id'];
                $diagnostico = $_POST['diagnostico'];
                $accion = $_POST['accion'];
                $esme_id = $_POST['esme_id'];
                $tickdo_id = $_POST['tickdo_id'];
                $tercerizar = $_POST['tercerizar'];
        
                // Manejar las imágenes y el informe (verificar que se suban correctamente)
                $foto_vehiculo = subirArchivo('foto_vehiculo', ['jpg', 'jpeg', 'png'], 2 * 1024 * 1024);
                $imagen_salida = subirArchivo('imagen_salida', ['jpg', 'jpeg', 'png'], 2 * 1024 * 1024);
        
                $informe = null;
                $empresa = null;
                if ($tercerizar === 'si') {
                    $empresa = $_POST['empresa'];
                    $informe = subirArchivo('informe', ['pdf', 'doc', 'docx'], 2 * 1024 * 1024);
                }
        
                // Comprobar si las imágenes son válidas
                if ($foto_vehiculo && $imagen_salida) {
                    // Llamar a la función de insertar mantenimiento
                    $resultado = $mecanico->insertar_mantenimiento(
                        $fecha, $hora, $mecanico_id, $diagnostico, $accion, $esme_id, 
                        $foto_vehiculo, $imagen_salida, $tickdo_id, $tercerizar, $empresa, $informe
                    );
        
                    if ($resultado) {
                        echo json_encode(['status' => 'success', 'message' => 'Mantenimiento guardado correctamente.']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Error al guardar en la base de datos.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'La imagen inicial o de salida no es válida o excede los 2 MB.']);
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Hubo un problema al guardar el mantenimiento: ' . $e->getMessage()]);
            }
            break;
        
        


        }

        function subirArchivo($inputName, $extensionesValidas, $maxSize) {
            if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
                $archivo = $_FILES[$inputName];
                $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                
                if (in_array($ext, $extensionesValidas) && $archivo['size'] <= $maxSize) {
                    $destino = "../uploads/" . uniqid() . '.' . $ext;
                    
                    if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                        return $destino;
                    } else {
                        throw new Exception("Error al mover el archivo al directorio de destino.");
                    }
                } else {
                    throw new Exception("Archivo no válido o excede el tamaño permitido.");
                }
            }
            return null; // Si no hay archivo subido o no es obligatorio
        }
        
