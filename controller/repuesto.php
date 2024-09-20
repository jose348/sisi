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
            
            $data = array();  // Inicializar el array de datos
        
            // Verificar si hay datos devueltos
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $row) {
                    $sub_array = array();
                    $sub_array[] = $row["unme_id"];
                    $sub_array[] = $row["unme_codigo"];
                    $sub_array[] = $row["unme_descripcion"];
                    $sub_array[] = '<button type="button" onClick="editar(' . $row["unme_id"] . ');" id="' . $row["unme_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar(' . $row["unme_id"] . ');" id="' . $row["unme_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                    
                    $data[] = $sub_array;  // Agregar cada sub-array al array $data
                }
            }
        
            // Validar si el parámetro 'draw' está en la solicitud, y asignar un valor por defecto si no está
            $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
        
            // Generar la respuesta JSON en el formato adecuado
            $results = array(
                "draw" => $draw,  // El parámetro 'draw' que viene de DataTables o 0 por defecto
                "recordsTotal" => count($data),    // Número total de registros
                "recordsFiltered" => count($data), // Número total de registros después de filtros
                "data" => $data                    // Los datos reales
            );
        
            // Enviar la respuesta JSON
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
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["repu_codigo"];
            $sub_array[] = $row["repu_descripcion"];
            $sub_array[] = $row["repu_stock"];
            $sub_array[] = $row["repu_ultimo_ingreso"];
            if ($row["repu_estado"] == 1) {
                $sub_array[] = '<button  class="btn btn-oblong btn-info">Alta</button>';
            } else {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Baja</button>';
            }

            $sub_array[] = $row["repu_stock_total"];

            if ($row["repu_situacion"] == 'A') {
                $sub_array[] = '<button  class="btn btn-oblong btn-success">Activo</button>';
            } else 
                            if ($row["repu_situacion"] == 'M') {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Malogrado</button>';
            } else
                           if ($row["repu_situacion"] == 'T') {
                $sub_array[] = '<button  class="btn btn-oblong btn-warning">Taller</button>';
            } else if (empty($row["repu_situacion"])) {
                $sub_array[] = '<button  class="btn btn-oblong btn-secondary">verificar</button>';
            }
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

    case "totalStock":
        $datos = $repuesto->get_total_stock_repuesto($_POST["repu_descripcion"]); //guardamos en la variable datos la instancia de Models/Usuario.php y//le pasamos lo que viene por $_POST
        if (is_array($datos) == true and count($datos) <> 0) { //si el dato tiene valores en arrays y es diferente de cero entonces
            foreach ($datos as $row) { //recorro con un foreach los resultado de lo que viene de $datos y que fue pasado por $_POST["usu_id]
                $output["repu_stock"] = $row["repu_stock"]; //$output captura el resultado y lo guadar y lo sede al $row
            }
            echo json_encode($output); //el resultado que trae output lo imprimos en unjson 
        }
        //ahora si es un array o si tiene informacion                                                         
        break;


    case "listar_x_situacion_repuesto":
        $datos = $repuesto->get_estado_repuesto($_POST["repu_situacion"]); //guardamos en la variable datos la instancia de Models/Usuario.php y//le pasamos lo que viene por $_POST
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["repu_codigo"];
            $sub_array[] = $row["repu_descripcion"];
            $sub_array[] = $row["repu_stock"];
            $sub_array[] = $row["repu_ultimo_ingreso"];

            if ($row["repu_situacion"] == 'A') {
                $sub_array[] = '<button  class="btn btn-oblong btn-success">Activo</button>';
            } else 
                                    if ($row["repu_situacion"] == 'M') {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Malogrado</button>';
            } else
                                   if ($row["repu_situacion"] == 'T') {
                $sub_array[] = '<button  class="btn btn-oblong btn-warning">Taller</button>';
            }


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


    case "listar_bajas":
        $datos = $repuesto->get_baja(); //guardamos en la variable datos la instancia de Models/Usuario.php y//le pasamos lo que viene por $_POST
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();


            $sub_array[] = $row["repu_codigo"];
            $sub_array[] = $row["repu_descripcion"];
            $sub_array[] = $row["repu_stock"];
            $sub_array[] = $row["repu_stock_total"];

            if ($row["repu_estado"] == 1) {
                $sub_array[] = '<button  class="btn btn-oblong btn-info">Alta</button>';
            } else {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Baja</button>';
            }

            $sub_array[] = $row["repu_ultimo_ingreso"];

            if ($row["repu_situacion"] == 'A') {
                $sub_array[] = '<button  class="btn btn-oblong btn-success">Activo</button>';
            } else 
                                        if ($row["repu_situacion"] == 'M') {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Malogrado</button>';
            } else
                                       if ($row["repu_situacion"] == 'T') {
                $sub_array[] = '<button  class="btn btn-oblong btn-warning">Taller</button>';
            } else if (empty($row["repu_situacion"])) {
                $sub_array[] = '<button  class="btn btn-oblong btn-secondary">verificar</button>';
            }



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



    case "listar_altas_bajas":
        $datos = $repuesto->get_altas_sbajas($_POST["repu_estado"]); //guardamos en la variable datos la instancia de Models/Usuario.php y//le pasamos lo que viene por $_POST
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();


            $sub_array[] = $row["repu_codigo"];
            $sub_array[] = $row["repu_descripcion"];
            $sub_array[] = $row["repu_stock"];
            $sub_array[] = $row["repu_stock_total"];

            if ($row["repu_estado"] == 1) {
                $sub_array[] = '<button  class="btn btn-oblong btn-info">Alta</button>' . "   " . '  <button type="button" onClick="darbaja(' . $row["repu_id"] . ');"  id="' . $row["repu_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-long-arrow-down"></i></div></button>';
            } else {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Baja</button>' . "  " . '<button type="button" onClick="daralta(' . $row["repu_id"] . ');"  id="' . $row["repu_id"] . '" class="btn btn-outline-success btn-icon"><div><i class="fa fa-long-arrow-up"></i></div></button>';
            }
            $sub_array[] = $row["repu_ultimo_ingreso"];

            if ($row["repu_situacion"] == 'A') {
                $sub_array[] = '<button  class="btn btn-oblong btn-success">Activo</button>';
            } else 
                                            if ($row["repu_situacion"] == 'M') {
                $sub_array[] = '<button  class="btn btn-oblong btn-danger">Malogrado</button>';
            } else
                                           if ($row["repu_situacion"] == 'T') {
                $sub_array[] = '<button  class="btn btn-oblong btn-warning">Taller</button>';
            } else if (empty($row["repu_situacion"])) {
                $sub_array[] = '<button  class="btn btn-oblong btn-secondary">verificar</button>';
            }



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

    case "comboaltabaja":
        $datos = $repuesto->combo_altabaja();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['repu_estado'] . "'>" . strtoupper($row['repu_estado']) . "</option>";
            }
            echo $html;
        }

        break;

    case "daralta":
        $repuesto->dar_alta($_POST["repu_id"]);
        break;
    case "darbaja":
        $repuesto->dar_baja($_POST["repu_id"]);
        break;



    case "mostarDetalleSolicitud":
        $datos = $repuesto->listar_solicitud();

        foreach ($datos as $row) { ?>

            <div class="col-5 container">

                <div class="row mg-t-50">
                    <div class="col-12 bd-2000">
                        <div class="card-header tx-white bg-info container">
                            <div class="row">
                                <div class="col-6">

                                    <?php echo "Solicitud N°" . $row["sore_id"]; ?>

                                </div>
                                <div class="col-6 text-right text-dark">

                                    <h6><?php echo  $row["sore_fecha"]; ?></h6>

                                </div>
                            </div>

                        </div><!-- card-header -->
                        <div class="card-body bd bd-t-0 rounded-bottom">
                            <div style="float:right;">
                                <?php if ($row["deso_estado"] == 1) { ?>
                                    <button class="btn btn-oblong btn-success">Abierto</button>
                                <?php  }else{?>
                                <button class="btn btn-oblong btn-danger">Cerrado</button>
                                    <?php } ?>
                            </div>

                            <div id="proyectos-size">
                                <ul>
                                    <li><?php echo $row["sore_titulo"]; ?></li>
                                    <br>
                                    <li>CANTIDAD: <?php echo $row["deso_cantidad"]; ?></li>
                                    <br>
                                    <li>Fecha : <?php echo $row["sore_fecha"]; ?></li>
                                    <br>
                                    <li>REPUESTO: <?php echo $row["repu_descripcion"]; ?> </l>
                                        <br>
                                        
                                        
                                        
                                </ul>
                                <button type="button" onclick="atender(<?php echo $row['deso_id']; ?>)" id="<?php echo $row['deso_id']; ?>" class="btn btn-oblong btn-outline-info btn-block"><i class="fa fa-eye mg-r-10"></i>Atender</button>
                            </div>
                        </div><!-- card-body -->




                        <!--  <button  type="button" onclick="rechazar(<?php echo $row['sore_id']; ?>)" id="<?php echo $row['sore_id']; ?>" class="btn btn-outline-danger btn-block"><i class="fa fa-close mg-r-10"></i> Rechazar</button> -->


                    </div><!-- col-sm -->
                    <div class="col-1">
                         <br>
                    </div>
                </div><!-- card -->
            </div><!-- col -->
           

<?php


        }
        break;



    case "rechazar":
        $repuesto->rechazar($_POST["sore_id"]);
        break;
}
?>