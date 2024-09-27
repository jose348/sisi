<?php

require_once("../config/conexion.php");
require_once("../models/Intermovilregistro.php");
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php'); //TODO para generea mi PDF
require_once('../vendor/autoload.php'); // Incluye la librería TCPDF



$interMovilregistro = new Intermovilregistro();

switch ($_GET["op"]) {

    case "guardarEditar":
        if (empty($_POST["unid_id"])) {
            $interMovilregistro->insert_movil(
                $_POST["unid_anio"],
                strtoupper($_POST["unid_placa"]),
                strtoupper($_POST["unid_motor"]),
                strtoupper($_POST["unid_adquisicion"]),
                strtoupper($_POST["unid_observacion"]),
                $_POST["tiun_id"],
                $_POST["depe_id"],
                $_POST["mode_id"],
                strtoupper($_POST["unid_codigo"]),
                $_POST["colo_id"],
                $_POST["comb_id"]
            );
        } else {
            $interMovilregistro->update_movil(
                $_POST["unid_id"],
                strtoupper($_POST["unid_anio"]),
                strtoupper($_POST["unid_placa"]),
                strtoupper($_POST["unid_motor"]),
                strtoupper($_POST["unid_adquisicion"]),
                strtoupper($_POST["unid_observacion"]),
                $_POST["tiun_id"],
                $_POST["depe_id"],
                $_POST["mode_id"],
                strtoupper($_POST["unid_codigo"]),
                $_POST["colo_id"],
                $_POST["comb_id"]
            );
        }
        break;




    case "listar":
        $datos = $interMovilregistro->get_lista_intermovil();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            /* $sub_array[] = $row["unid_id"]; */
            //$sub_array[] = '<input type="radio"  name="select-row" value="' . $row["unid_id"] . '" id="select_' . $row["unid_id"] . '"style="transform: scale(0.8); width: 20px; height: 20px;">';
            $sub_array[] = '<label class="rdiobox rdiobox-pink mg-t-1">
            <input type="radio" name="select-row" value="' . $row["unid_id"] . '" id="select_' . $row["unid_id"] . '"  >
            <span></span>
        </label>';


            $sub_array[] = $row["unid_codigo"];
            $sub_array[] = $row["depe_denominacion"];
            $sub_array[] = $row["tiun_descripcion"];
            $sub_array[] = $row["marc_descripcion"];
            $sub_array[] = $row["mode_descripcion"];
            $sub_array[] = $row["unid_motor"];
            if ($row["unid_estado"] == "1") {
                $sub_array[] = '<button  class="btn btn-oblong btn-success">Activo</button>';
            } else {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">InActivo</button>';
            }


            /* $sub_array[] = $row["colo_descripcion"]; */
            /*  $sub_array[] = $row["colo_descripcion"];
            $sub_array[] = $row["comb_descripcion"]; */
            /*   $sub_array[] = '<button type="button" onClick="editar(' . $row["unid_id"] . ');"  id="' . $row["unid_id"] . '" class="btn btn-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["unid_id"] . ');"  id="' . $row["unid_id"] . '" class="btn btn-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
           */

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

    case "combo_tipo":
        $datos = $interMovilregistro->combo_tipo();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Tipo de Unidad'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tiun_id'] . "'>" . $row['tiun_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_marca":
        $datos = $interMovilregistro->combo_marca();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Marca'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['marc_id'] . "'>" . $row['marc_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_modelo":
        $datos = $interMovilregistro->combo_modelo($_POST["marc_id"]);

        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Modelo'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['mode_id'] . "'>" . $row['mode_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_area":
        $datos = $interMovilregistro->combo_area();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Area de destino'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['depe_id'] . "'>" . $row['depe_denominacion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_color":
        $datos = $interMovilregistro->combo_color();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Color'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['colo_id'] . "'>" . $row['colo_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_combustible":
        $datos = $interMovilregistro->combo_combustible();

        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Combustible'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['comb_id'] . "'>" . $row['comb_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;


    case "mostrarMovil":
        $datos = $interMovilregistro->get_movil_id($_POST["unid_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["unid_id"] = $row["unid_id"];
                $output["tiun_id"] = $row["tiun_id"];
                $output["unid_codigo"] = $row["unid_codigo"];
                $output["marc_id"] = $row["marc_id"];
                $output["mode_id"] = $row["mode_id"];
                $output["depe_id"] = $row["area_id"];
                $output["unid_placa"] = $row["unid_placa"];
                $output["colo_id"] = $row["colo_id"];
                $output["unid_anio"] = $row["unid_anio"];
                $output["comb_id"] = $row["comb_id"];
                $output["unid_adquisicion"] = $row["unid_adquisicion"];
                $output["unid_motor"] = $row["unid_motor"];
                $output["unid_observacion"] = $row["unid_observacion"];
            }
            echo json_encode($output);
        }
        break;
    case "eliminarMovil":
        $interMovilregistro->eliminar_movil($_POST["unid_id"]);
        break;




        /* TODO  GENERANDO PDF PARA REPORTE */

    case "reportePDF":
        $datos = $interMovilregistro->get_lista_intermovil();


        // Crear PDF en orientación horizontal (Landscape)
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('REPORTE DE MOVILES');
        $pdf->SetSubject('REPORTE DE MOVILES');
        $pdf->SetKeywords('TCPDF, PDF, reporte');

        date_default_timezone_set('America/Lima');
        $current_date_time = date('d/m/Y');
        $current_date_hora = date('H:i');


        // Configuración de la imagen de la cabecera
        $header_logo = '/sisi/files/img/user.jpg';
        $header_logo_width = 100; // Ancho en mm
        $pdf->SetHeaderData('<img src="<?php echo' . $header_logo . '; ?>" alt="Logo">', $header_logo_width, 'MUNICIPALIDAD PROVINCIAL DE CHICLAYO', 'Servicios Internos');


        // Fuentes y márgenes
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 35, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 25);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Añadir una página
        $pdf->AddPage();

        // Configuración del contenido
        $html = '<style>

.table1 {
        width: 100%;
        border-collapse: collapse;
    }
   
    .table-data1 {
        background-color: #e1f0d7; /* Color original */
    }
    
   
  .title {
        background-color: #a3c293;
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        padding: 10px;
        margin-bottom: 15px;
    }
    .section-header {
        background-color: #d9ead3;
        font-weight: bold;
        font-size: 12px;
        padding: 5px;
    }
    .table-header {
        background-color: #a3c293;
        font-weight: bold;
        text-align: center;
    }
    .table-data {
        text-align: center;
        padding: 5px;
    }
    .blue-highlight {
        background-color: #9fc5e8;
        font-weight: bold;
    }
                        </style>
                        <div class="title">REPORTE DE UNIDADES MOVILES</div>

<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td class="section-header">DEPENDENCIA</td>
        <td colspan="3" class="table-data">SUBGERENCIA DE GESTION DE RESIDUOS SOLIDOS</td>
    </tr>
    <tr>
        <td class="section-header">NOMBRE DE AREA</td>
        <td class="table-data">SERVICIOS INTERNOS</td>
        <td class="section-header">FECHA REPORTE</td>
        <td class="table-data">' .  $current_date_time . ' ' . '  -  ' . ' ' . $current_date_hora . '</td>
    </tr>
   
</table>
<br>
<div class="title" style="margin-top: 20px; font-size:13px;">* DETALLE DE UNIDADES *</div>
<br>

                        <table class="table1" cellspacing="0" cellpadding="4" border="1" style="margin-top: 20px; font-size:12px; text-align:center" >
                            <tr class="table-header">
                                   
                                    <th style="width: 5%;">Nº</th>
                                    <th style=" width: 5%;">Código</th>
                                    <th style=" width: 47%;">Área</th>
                                    <th style=" width: 16%;">Tipo</th>
                                    <th style=" width: 13%;">Marca</th>
                                    <th style=" width: 14%;" >Modelo</th>
                                   
                                </tr>';

        // Llenar la tabla con datosWE
        foreach ($datos as $row => $dt) {
            $row_class = ($row % 2 == 0) ? 'table-data1' : '';
            $html .= '<tr class="' . $row_class . '">
                                        <td>' . ($row + 1) . '</td>
                                        <td>' . $dt["unid_codigo"] . '</td>
                                        <td>' . $dt["depe_denominacion"] . '</td>
                                        <td>' . $dt["tiun_descripcion"] . '</td>
                                        <td>' . $dt["marc_descripcion"] . '</td>
                                        <td>' . $dt["mode_descripcion"] . '</td>
                                        
                                    </tr>';
        }

        $html .= '</table>';

        // Escribir el HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del PDF

        $pdf->Output('reporte_UnidadesMovil.pdf', 'I');
        break;





    case "combo_UNIDADMOVIL":
        $datos = $interMovilregistro->combo_unidadMovil();

        if (is_array($datos) && count($datos) > 0) {
            $html = "<option value='' label='Seleccione Unidad Movil'></option>";
            foreach ($datos as $row) {
                // El valor incluye el ID y la descripción completa (tipo de vehículo, placa y modelo)
                $html .= "<option value='" . htmlspecialchars($row['unid_id'], ENT_QUOTES) . " / " .
                    htmlspecialchars($row['tiun_descripcion'], ENT_QUOTES) . " / " .
                    htmlspecialchars($row['unid_placa'], ENT_QUOTES) . " / " .
                    htmlspecialchars($row['mode_descripcion'], ENT_QUOTES) . "'>" .
                    htmlspecialchars($row['tiun_descripcion'], ENT_QUOTES) . " / " .
                    htmlspecialchars($row['unid_placa'], ENT_QUOTES) . " / " .
                    htmlspecialchars($row['mode_descripcion'], ENT_QUOTES) . "</option>";
            }
            echo trim($html);
        } else {
            echo "<option value='' disabled>No hay unidades disponibles</option>";
        }
        break;







    case "combo_esme":
        $datos = $interMovilregistro->combo_espec();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Especialidad'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['esme_id'] . "'>" . $row['esme_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;


        /* TODO  aqui llamamos al modelo GuardarProgramacionMant y realizamos nuestro case:*/
    case "guardar_prog_mante":
        if (empty($_POST["prma_id"])) {
            if (isset($_POST["prma_diagnostico_inicial"], $_POST["prma_fecha"], $_POST["prma_hora"], $_POST["unid_id"], $_POST["esme_id"])) {
                $nuevoID = $interMovilregistro->GuardarProgramacionMant(
                    strtoupper($_POST["prma_diagnostico_inicial"]),
                    strtoupper($_POST["prma_fecha"]),
                    strtoupper($_POST["prma_hora"]),
                    strtoupper($_POST["unid_id"]),
                    strtoupper($_POST["esme_id"])
                );

                if ($nuevoID) {
                    echo json_encode(['success' => true, 'id' => $nuevoID]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al guardar los datos.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos en la solicitud.']);
            }
        }
        break;




        /* TODO  aqui llamamos al modelo Guardar Registro Ingreso DE Vehiculo models/GuardarRegistroVehiculo y realizamos nuestro case:*/
    case "guardar_ing_vehi":
        if (empty($_POST["inun_id"])) {
            // Llamar a la función GuardarRegistroVehiculo en el modelo
            $nuevoID = $interMovilregistro->GuardarRegistroVehiculo(
                strtoupper($_POST["inun_fecha"]),
                strtoupper($_POST["inun_hora"]),
                strtoupper($_POST["inun_diagnostico"]),
                strtoupper($_POST["unid_id"]),
                strtoupper($_POST["inun_diagnostico_especializado"]),
                strtoupper($_POST["inun_fecha_diagnostico_especializado"]),
                $_POST["inun_estado"] // Guardar el estado
            );

            // Si se guarda correctamente, devolver el nuevo ID en el JSON
            if ($nuevoID) {
                echo json_encode([
                    'success' => true,
                    'inun_id' => $nuevoID // Cambiar 'id' por 'inun_id' para mantener consistencia
                ]);
            } else {
                // En caso de error, enviar un mensaje de error en el JSON
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al guardar los datos.'
                ]);
            }
        }
        break;


    case "combo_tipo_unidad_busquedad":
        $datos = $interMovilregistro->combo_tipo_busquedad();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Especialidad'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['tiun_id'] . "'>" . $row['tiun_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_modelo_busquedad":
        $datos = $interMovilregistro->combo_modelo_busquedad();
        if (is_array($datos) == true  and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['mode_id'] . "'>" . $row['mode_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_marca_busquedad":
        $datos = $interMovilregistro->combo_marca_busquedad();
        if (is_array($datos) == true  and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['marc_id'] . "'>" . $row['marc_descripcion'] . "</option>";
            }
            echo $html;
        }
        break;


    case "listar_bitacora":
        // Llamamos a la función listar_bitacora del modelo
        $datos = $interMovilregistro->listar_bitacora();

        $data = array();

        // Recorremos los resultados y los formateamos en un array asociativo
        foreach ($datos as $row) {
            $sub_array = array();


            $dropdown = '<style>
    /* Reducimos el padding y el margin dentro del dropdown */
    .dropdown-menu {
          padding: 10px;
        margin: 5px;
        min-width: 53px; /* Evita que el dropdown tenga un ancho mínimo */
    }

    /* Ajustamos los botones dentro del dropdown para que no agreguen espacio innecesario */
    .dropdown-item button {
         
        width: 50%; /* Asegura que el botón ocupe todo el ancho disponible */
        padding: 50px; /* Reduce el padding para que no se vea tan grande */
    }
</style>

                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton_' . $row['unid_placa'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_' . $row['unid_placa'] . '">
                        <a class=" " href="#" onclick="verVehiculo(\'' . $row['unid_placa'] . '\')">
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                        <a class="" href="#" onclick="pdfVehiculo(\'' . $row['unid_placa'] . '\')">
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i>
                            </button>
                        </a>
                        
                    </div>
                </div>';
            // Agregamos el dropdown a la primera columna
            $sub_array[] = $dropdown; // Dropdown con acciones

            $sub_array[] = $row["unid_placa"]; // Placa del vehículo
            $sub_array[] = $row["tiun_descripcion"]; // Tipo de Unidad
            $sub_array[] = $row["mode_descripcion"]; // Modelo
            $sub_array[] = $row["marc_descripcion"]; // Marca
            $sub_array[] = $row["inun_fecha"]; // Fecha de Ingreso
            $sub_array[] = $row["inun_diagnostico"]; // Diagnóstico
            $sub_array[] = $row["inun_fecha_diagnostico_especializado"]; // Fecha del Diagnóstico Especializado
            $sub_array[] = $row["prma_fecha"]; // Fecha del Diagnóstico Especializado

            // Agregamos este conjunto de datos al array de resultados
            $data[] = $sub_array;
        }

        // Formato de salida para DataTables
        $results = array(
            "sEcho" => 1, // Información para DataTables
            "iTotalRecords" => count($data), // Total de registros
            "iTotalDisplayRecords" => count($data), // Total de registros a mostrar
            "aaData" => $data // Datos formateados para mostrar
        );

        // Devolvemos los resultados en formato JSON
        echo json_encode($results);
        break;




        /*TODO =============================================================  EMPEZAMOS CON LLENADO DE MIS COMBOX EN MI 
        ====================================================================  EN MI FORMULARIO TICKET*/

    case "combo_tipo_componente":
        $datos = $interMovilregistro->combo_tipo_componente();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label='Seleccione Componente'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['comp_id'] . "'>" . $row['comp_descrip'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_tipo_componente_especifico":
        $componente_id = $_POST['componente_id'];  // Recibir el ID del componente seleccionado
        $datos = $interMovilregistro->combo_tipo_componente_especifico($componente_id);
        if (is_array($datos) && count($datos) > 0) {
            $html = "<option label='Seleccione Componente Específico'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['coti_id'] . "'>" . $row['coti_descrip'] . "</option>";
            }
            echo $html;
        }
        break;

    case "combo_lubricador_mecanico":
        // Llamar a la función del modelo
        $datos = $interMovilregistro->combo_lubricadormecanico();

        if (is_array($datos) && count($datos) > 0) {
            $html = "<option value=''>Seleccione Responsable</option>";  // Opción por defecto

            foreach ($datos as $row) {

                $html .= "<option value='" . htmlspecialchars($row['direct_id'], ENT_QUOTES) . "'>" . htmlspecialchars($row['nombres'], ENT_QUOTES) . "</option>";
            }
            echo $html;
        } else {
            echo "<option value=''>No se encontraron responsables</option>";
        }
        break;





    case "validar_token":
        $direct_id = $_POST['direct_id'];
        $token = $_POST['token'];

        // Lógica para verificar si el token es correcto para el responsable seleccionado
        $datos = $interMovilregistro->verificarToken($direct_id, $token);

        if (is_array($datos) && count($datos) > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Token válido']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'El token no coincide con el responsable seleccionado']);
        }
        break;

        /*TODO generando el codigo del ticket */
    case "generar_codigo_ticket":
        // Llamar a la función del modelo para generar el siguiente número de ticket
        $codigo_ticket = $interMovilregistro->generarCodigoTicket();
        echo json_encode(["codigo_ticket" => $codigo_ticket]);
        break;




    case "buscar_chofer_por_dni":
        if (isset($_POST['dni'])) {
            $dni = $_POST['dni'];  // Recoger el DNI desde la solicitud POST

            // Llamar al modelo para buscar el chofer
            $datos = $interMovilregistro->buscarChoferPorDNI($dni);

            // Verificar si hay resultados y devolverlos como JSON
            if (is_array($datos) && count($datos) > 0) {
                echo json_encode($datos);  // Devolver los datos del chofer
            } else {
                echo json_encode([]);  // No se encontró el chofer
            }
        } else {
            echo "DNI no proporcionado";  // Si no se envía el DNI
        }
        break;


        /*TODO obteniendo el ultimo ID */
    case "obtener_ultimo_inun_id":
        // Llamar al modelo para obtener el último inun_id
        $ultimoIngresoUnidad = $interMovilregistro->obtenerUltimoIngresoUnidad();

        if ($ultimoIngresoUnidad !== false) {
            echo json_encode(['success' => true, 'ultimo_inun_id' => $ultimoIngresoUnidad]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;



        /*TODO AHORA GUARDAMOS EL TICKETE */
    case "guardar_ticket":
        // Obtener los datos enviados por el formulario
        $ticketNumber = $_POST['ticketNumber'];
        $fecha = $_POST['fecha'];
        $horaIngreso = $_POST['horaIngreso'];
        $coti_id = $_POST['coti_id']; // Componente Específico (Cotización ID)
        $cantidad = $_POST['cantidad'];
        $pers_id = $_POST['pers_id']; // Aquí debería venir el `pers_id` (ID de la persona), no el DNI
        $direct_id = $_POST['direct_id']; // Responsable (Director ID)
        $inun_id = $_POST['inun_id']; // ID del Ingreso Unidad

        // Validar los campos obligatorios
        if (empty($fecha) || empty($horaIngreso) || empty($coti_id) || empty($cantidad) || empty($pers_id) || empty($direct_id) || empty($inun_id)) {
            echo json_encode(['success' => false, 'message' => 'Faltan datos para completar la solicitud.']);
            exit; // Detener ejecución si falta algún dato
        }

        // Llamar al modelo para guardar el ticket
        $nuevoTicket = $interMovilregistro->guardarTicket($ticketNumber, $fecha, $horaIngreso, $coti_id, $cantidad, $pers_id, $direct_id, $inun_id);

        if ($nuevoTicket) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo guardar el ticket.']);
        }
        break;



        /*TODO generamos el pdf */
        case "generar_ticket_pdf":
            if (!isset($_GET['ticketNumber'])) {
                echo "Error: No se proporcionó el número de ticket.";
                exit;
            }
        
            $ticketNumber = $_GET['ticketNumber'];
        
            // Obtenemos los datos del ticket con la consulta corregida
            $ticketData = $interMovilregistro->getTicketByNumber($ticketNumber);
        
            if (!$ticketData) {
                echo "Error: No se encontró el ticket con el número proporcionado.";
                exit;
            }
        
            // Crear PDF con TCPDF
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); 
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('Ticket de Dotación');
            $pdf->SetHeaderData('', 0, 'MUNICIPALIDAD PROVINCIAL DE CHICLAYO', 'Servicios Internos');
        
            // Fuentes y márgenes
            $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
            $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(15, 27, 15);
            $pdf->SetHeaderMargin(5);
            $pdf->SetFooterMargin(10);
            $pdf->SetAutoPageBreak(TRUE, 25);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
            // Añadir una página
            $pdf->AddPage();
        
            // Contenido del PDF con mejoras en el diseño y estilo
            $html = '
            <style>
                h2 {
                    color: #00b297;
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    font-family: Arial, sans-serif;
                }
                th {
                    background-color: #00b297;
                    color: white;
                    font-weight: bold;
                    padding: 8px;
                    text-align: left;
                }
                .ti {
                    background-color: white;
                    color: #00b297;
                    font-weight: bold;
                    padding: 8px;
                    text-align: left;
                    }    
                td {
                    padding: 8px;
                    border: 1px solid #dddddd;
                }
                .header {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
            </style>
            <h2 style="text-align:center">TICKET DE DOTACIÓN</h2>
            
            <table border="1" cellpadding="5">
            <br>
                <tr>
                    <th>Nº de Ticket</th>
                    <td>' . $ticketData['tickdo_numtick'] . '</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>' . $ticketData['tickdo_fecha'] . '</td>
                </tr>
                <tr>
                    <th>Hora de Ingreso</th>
                    <td>' . $ticketData['tickdo_hora'] . '</td>
                </tr>
               <br> 
                <tr class="header">
                    <th class="ti"  colspan="2" style="text-align:center">DETALLES DEL COMPONENTE</th>
                </tr>
                <br>
                <tr>
                    <th>Componente Específico</th>
                    <td>' . $ticketData['componente_especifico'] . '</td>
                </tr>
                <tr>
                    <th>Tipo de Componente</th>
                    <td>' . $ticketData['tipo_componente'] . '</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>' . $ticketData['tickdo_cantidad'] . '</td>
                </tr>
                <br>
                <tr class="header">
                    <th class="ti" colspan="2" style="text-align:center">DATOS DEL PERSONAL</th>
                </tr>
                <br>
                <tr>
                    <th>Chofer</th>
                    <td>' . $ticketData['nombre_chofer'] . '</td>
                </tr>
                <tr>
                    <th>Responsable</th>
                    <td>' . $ticketData['nombre_responsable'] . '</td>
                </tr>
                <br>
                <tr class="header">
                    <th  class="ti" colspan="2" style="text-align:center">INFORMACIÓN DE LA UNIDAD</th>
                </tr>
                <br>
                <tr>
                    <th>Unidad</th>
                    <td>' . $ticketData['movilidad'] . '</td> <!-- Información completa de la unidad -->
                </tr>
            </table>';
        
            $pdf->writeHTML($html, true, false, true, false, '');
        
            // Salida del PDF
            $pdf->Output('Ticket_Dotacion_' . htmlspecialchars($ticketNumber) . '.pdf', 'I');
            break;
        
}
