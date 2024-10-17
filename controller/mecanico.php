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




        case "guardar_mantenimiento":
            try {
                // Recoger los datos enviados por el formulario
                $inun_id = isset($_POST['inun_id']) ? $_POST['inun_id'] : null;
                $esme_id = isset($_POST['esme_id']) ? $_POST['esme_id'] : null;
                $deso_id = isset($_POST['deso_id']) ? $_POST['deso_id'] : null;
                $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
                $hora = isset($_POST['hora']) ? $_POST['hora'] : null;
                $mecanico_id = isset($_POST['mecanico_id']) ? $_POST['mecanico_id'] : null;
                $diagnostico = isset($_POST['diagnostico']) ? $_POST['diagnostico'] : null;
                $accion = isset($_POST['accion']) ? $_POST['accion'] : null;
                $tercerizar = isset($_POST['tercerizar']) ? $_POST['tercerizar'] : 'no';
                $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
                $fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : null;
                $hora_salida = isset($_POST['hora_salida']) ? $_POST['hora_salida'] : null;
    
                // Manejo de archivos (foto inicial, foto final e informe)
                $foto_vehiculo = subirArchivo('foto-vehiculo', ['jpg', 'jpeg', 'png'], 4 * 1024 * 1024);
                $imagen_salida = subirArchivo('imagen-salida', ['jpg', 'jpeg', 'png'], 4 * 1024 * 1024);
                $informe = isset($_FILES['informe']) ? file_get_contents($_FILES['informe']['tmp_name']) : null;
    
                // Insertar mantenimiento en la base de datos
                $resultado = $mantenimiento->insertar_mantenimiento(
                    $inun_id, $esme_id, $deso_id, $foto_vehiculo, $fecha, $hora,
                    $mecanico_id, $diagnostico, $accion, $tercerizar, $empresa,
                    $informe, $imagen_salida, $fecha_salida, $hora_salida
                );
    
                if ($resultado) {
                    echo json_encode(['status' => 'success', 'message' => 'Mantenimiento guardado correctamente.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al guardar el mantenimiento.']);
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
            }
            break;
        




    case "listar_ingresos":
        $datos = $mecanico->listar_ingresos();
        echo json_encode($datos);

        break;




    case "listarRepuestos":
        $datos = $mecanico->listar_respuesto();
        foreach ($datos as $row) {
            $sub_array = array();

            $sub_array[] = strtoupper($row["repu_codigo"]);
            $sub_array[] = strtoupper($row["repu_descripcion"]);
            if ($row["repu_stock"] <= 5) {
                $sub_array[] = '<button  class="alert alert-danger">' . $row["repu_stock"] . '</button>';
            } else {
                $sub_array[] = '<button class=" alert alert-success" >' . $row["repu_stock"] . '</button>';
            }





            $sub_array[] = $row["repu_ultimo_ingreso"];

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


    case "fetch_correlativo":
        $next_correlativo = $mecanico->fetch_correlativo();
        echo json_encode(["next_correlativo" => $next_correlativo]);
        break;

    case "combolistarRepuestos":
        $repuestos = $mecanico->combolistarRepuestos();
        echo json_encode($repuestos);
        break;



        case "guardarSolicitudRepuesto":
            try {
                // Capturar los datos enviados por POST
                $sore_titulo = isset($_POST['sore_titulo']) ? trim($_POST['sore_titulo']) : '';
                $repu_id = isset($_POST['repuesto_id']) ? $_POST['repuesto_id'] : 0;
                $sore_cantidad = isset($_POST['cantidad_repuesto']) ? $_POST['cantidad_repuesto'] : 0;
                $sore_fecha = isset($_POST['sore_fecha']) ? $_POST['sore_fecha'] : '';
                $sore_estado = 1; // Estado activo
        
                // Validar que los campos obligatorios no estén vacíos
                if (empty($sore_titulo) || empty($repu_id) || empty($sore_cantidad) || empty($sore_fecha)) {
                    echo json_encode(["status" => "error", "message" => "Por favor complete todos los campos obligatorios."]);
                    exit();
                }
        
                // Insertar la solicitud
                $mecanico->insertarSolicitud($sore_fecha, $sore_titulo, $repu_id, $sore_cantidad, $sore_estado);
        
                // Respuesta exitosa
                echo json_encode(["status" => "success", "message" => "Solicitud guardada correctamente."]);
            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Error al guardar la solicitud: " . $e->getMessage()]);
            }
            break;
        

}


// Función para subir archivos y validarlos
function subirArchivo($inputName, $extensionesValidas, $maxSize)
{
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES[$inputName];
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        // Validar extensión y tamaño del archivo
        if (in_array($ext, $extensionesValidas) && $archivo['size'] <= $maxSize) {
            $destino = "../uploads/" . uniqid() . '.' . $ext;

            // Mover archivo al directorio destino
            if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                return $destino;
            } else {
                throw new Exception("Error al mover el archivo.");
            }
        } else {
            throw new Exception("Archivo no válido o excede el tamaño permitido.");
        }
    }
    return null; // Si no se subió archivo


}
