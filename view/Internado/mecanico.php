<?php

require_once("../../config/conexion.php");

if (isset($_SESSION["id"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        require_once("../Head/MainHead.php");
        ?>
        <title>ADMIN::Directorio</title>
        <style>
            body {
                background-color: #f8f9fa;
            }



            h1 {
                font-size: 24px;
                font-weight: bold;
                color: #333333;
            }

            .form-label {
                font-weight: bold;
                color: #555555;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                font-weight: bold;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #004085;
            }

            .hidden {
                display: none;
            }

            .btn-success {
                background-color: #28a745;
                border-color: #28a745;
                font-weight: bold;
            }

            .btn-success:hover {
                background-color: #218838;
                border-color: #1e7e34;
            }

            .custom-file-label {
                cursor: pointer;
            }

            .centered-form {
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>

    <body>

        <?php
        require_once("../Menu/menu.php");
        ?>

        <?php
        require_once("../Header/MainHeader.php");
        ?>

        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
                <span class="breadcrumb-item active">Registro</span>
            </div><!-- br-pageheader -->

            <div class=" row">
                <div class="br-section-wrapper container">
                    <p class="tx-16 tx-uppercase tx-spacing-1 mg-t-1 mg-b-2 tx-gray-600 text-center">
                        INTERNAMIENTO DE VEHICULOS - MPCH - MANTENIMIENTO DE VEHICULOS
                    </p>



                    <div class="container mt-5">


                        <!-- Primera parte: Combo para seleccionar -->
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form id="main-form" class="text-center">
                                        <div class="mb-1">
                                            <label for="category" class="form-label" style="font-size: 14px;">Selecciona un Motivo de Mantenimiento:</label>
                                            <select id="esme_id" name="esme_id" class="form-select form-control" style="width: 100%; font-size: 12px; padding: 5px;">

                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <br>





                        <!-- Parte para buscar ticket, visible solo cuando se selecciona Componentes -->
                        <div id="ticket-section" class="hidden">
                            <div class="row">
                                <!-- Campo de texto para buscar el ticket -->
                                <div class="col-md-8 mb-3">
                                    <label for="ticket" class="form-label">Buscar Ticket:</label>
                                    <input type="text" id="ticket" name="ticket" class="form-control" placeholder="Ingrese el número de ticket">
                                </div>

                                <!-- Botón para buscar el ticket -->
                                <div class="col-md-4 mb-3 align-self-end">
                                    <label class="form-label d-none d-md-block">&nbsp;</label> <!-- Para alinear verticalmente con el input -->
                                    <button type="button" class="btn btn-primary w-100" onclick="buscarTicket()">Buscar Ticket</button>
                                </div>
                            </div>
                        </div>




                        <br>


                        <!-- Mostrar detalles del ticket una vez encontrado en una tabla -->
                        <!-- Mostrar detalles del ticket una vez encontrado en una tabla centrada -->
                        <div id="ticket-details" class="hidden mt-4">
                            <h4 class="text-center">Detalles del Ticket</h4>
                            <div class="table-responsive mx-auto" style="width: 80%;"> <!-- Contenedor centrado -->
                                <table class="table table-striped table-bordered text-center mx-auto">
                                    <thead class="thead-white">
                                        <tr>
                                            <th scope="col">Campo</th>
                                            <th scope="col">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nº de Ticket</strong></td>
                                            <td id="ticket-num"></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Fecha</strong></td>
                                            <td id="ticket-fecha"></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Hora</strong></td>
                                            <td id="ticket-hora"></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cantidad</strong></td>
                                            <td id="ticket-cantidad"></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Unidad</strong></td>
                                            <td id="ticket-unidad"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Botón para recibir ticket, centrado -->
                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" class="btn btn-success mx-2" id="btn-recibir" onclick="recibirTicket()">Recibir Ticket</button>
                                <button type="button" class="btn btn-primary mx-2" id="btn-editar" onclick="editarTicket()">Editar Ticket</button>
                            </div>


                        </div>




                        <br>





                        <style>
                            /* Estilo del formulario principal (card grande) */
                            #detalle-form .card {
                                background-color: #f8f9fa;
                                border-radius: 10px;
                                padding: 20px;
                                border: 2px solid #007bff;
                                box-shadow: 0px 4px 6px rgba(0, 123, 255, 0.1);
                            }

                            #detalle-form .card-title {
                                color: #007bff;
                                font-size: 20px;
                                font-weight: bold;
                            }

                            /* Estilo para el formulario simple de tercerización */
                            #empresa-section {
                                padding: 10px;
                                border: 1px solid #007bff;
                                background-color: #f0f8ff;
                                border-radius: 5px;
                            }


                            .form-group {
                                margin-bottom: 1rem;
                            }

                            .d-flex {
                                display: flex;
                                align-items: center;
                            }

                            .form-check-inline {
                                margin-right: 50px;
                            }

                            #empresa-section {
                                display: none;
                                /* El formulario de empresa se oculta por defecto */
                            }

                            .mt-3 {
                                margin-top: 1rem;
                            }

                            #modal-foto-vehiculo {
                                max-width: 100%;
                                /* Hacer que la imagen ocupe todo el ancho disponible */
                                height: auto;
                                /* Ajustar la altura proporcionalmente */
                            }
                        </style>

                        <form id="detalle-form" enctype="multipart/form-data" method="POST" class=" -extra-largeform">
                            <div>
                                <!-- Botón para abrir el modal -->
                                <div class="row">
                                    <div class="col-2">
                                        <button type="button" class="btn btn-oblong btn-indigo" data-toggle="modal" data-target="#vehiculoModal">
                                            <i class="fa fa-car"></i> Vehiculo Ingresado
                                        </button>
                                    </div>
                                    <div class="col-10">
                                        <div id="titulo-vehiculo-seleccionado" style="font-size: 18px; font-weight: bold; color: #007bff; text-align: right;">
                                            <!-- Aquí aparecerá el nombre del vehículo seleccionado -->
                                        </div>



                                    </div>

                                </div>



                                <br><br>


                                <!-- TODO modal para tabla de vehiculos ingresados -->
                                <!-- TODO modal para tabla de vehiculos ingresados -->
                                <!-- TODO modal para tabla de vehiculos ingresados -->
                                <!-- TODO modal para tabla de vehiculos ingresados -->
                                <div class="modal fade" id="vehiculoModal" tabindex="-1" role="dialog" aria-labelledby="vehiculoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="vehiculoModalLabel">Ingreso de Vehículos</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="tabla-ingreso-vehiculos" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <style>
                                                                #tabla-ingreso-vehiculos {
                                                                    font-size: 18px;
                                                                    /* Ajusta el tamaño de la fuente */
                                                                }
                                                            </style>
                                                            <th></th>
                                                            <th style="width: 100p; text-align: center; ">Nombre de Unidad</th>
                                                            <th style="width: 5p; text-align: center;">Fecha Ingreso</th>
                                                            <th style="width: 5p; text-align: center;">Hora Ingreso</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        <!-- Aquí se cargan los datos de la tabla mediante AJAX -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" id="confirmarSeleccionUnidad">Confirmar Selección</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- TODO modal para tabla de Repuesto -->
                                <!-- TODO modal para tabla de Repuesto -->
                                <!-- TODO modal para tabla de Repuesto -->
                                <!-- TODO modal para tabla de Repuesto -->
                                <div class="modal fade" id="almacenModal" tabindex="-1" role="dialog" aria-labelledby="almacenModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="almacenModalLabel">Almacen</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <style>
                                                #repuesto_data {
                                                    table-layout: fixed;
                                                    /* Asegura que las columnas se ajusten al ancho especificado */
                                                    word-wrap: break-word;
                                                    /* Permite que el contenido largo se ajuste dentro de la columna */
                                                }
                                            </style>
                                            <div class="modal-body">
                                                <table id="repuesto_data" class="table table-bordered table-striped table-center js-dataTable-full text text-center" style="width: 100%;">
                                                    <br>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 20%;">Código</th>
                                                            <th class="text-center" style="width: 40%;">Repuesto</th>
                                                            <th class="text-center" style="width: 20%;">Stock</th>
                                                            <th class="text-center" style="width: 20%;">Fecha Ingreso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Modal para enviar solicitud a almacén -->
                                <!-- Modal para enviar solicitud a almacén -->
                                <!-- Modal para enviar solicitud a almacén -->
                                <!-- Modal para enviar solicitud a almacén -->
                                <!-- Modal para enviar solicitud a almacén -->
                                <!-- Modal para enviar solicitud a almacén -->
                                <style>
                                    .modal-dialog {
                                        max-width: 900px;
                                        /* Ajusta este valor según lo que prefieras */
                                        width: 100%;
                                    }
                                </style>

                                <div class="modal fade" id="notificacionModal" tabindex="-1" role="dialog" aria-labelledby="notificacionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="notificacionModalLabel">Enviar Solicitud a Almacén</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="solicitud-almacen-form">
                                                    <div class="row">
                                                        <!-- Correlativo (se genera automáticamente) -->
                                                        <div class="form-group col-4">
                                                            <label for="correlativo">Número de Solicitud</label>
                                                            <input type="text" class="form-control" id="correlativo" name="correlativo" readonly>
                                                        </div>

                                                        <!-- Fecha de solicitud -->
                                                        <div class="form-group col-4">
                                                            <label for="sore_fecha">Fecha de Solicitud</label>
                                                            <input type="date" class="form-control" id="fecha-solicitud" name="sore_fecha" readonly>
                                                        </div>

                                                        <!-- Cantidad de repuestos -->
                                                        <div class="form-group col-4">
                                                            <label for="cantidad_repuesto">Cantidad de Repuestos</label>
                                                            <input type="number" class="form-control" id="cantidad_repuesto" name="cantidad_repuesto" min="1" required>
                                                        </div>

                                                        <!-- Combo para seleccionar el repuesto -->
                                                        <div class="form-group col-12">
                                                            <label for="repuesto">Repuesto</label>
                                                            <select class="form-control" id="repuesto_id" name="repuesto_id" required></select>
                                                        </div>

                                                        <!-- Descripción de la solicitud -->
                                                        <div class="form-group col-12">
                                                            <label for="sore_titulo">Descripción de la solicitud</label>
                                                            <textarea class="form-control" id="sore_titulo" name="sore_titulo" rows="3" required></textarea>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" id="enviarSolicitudAlmacen">Enviar Solicitud</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>








                                <!-- Formulario detallado que se muestra al seleccionar y recibir ticket -->
                                <!-- Formulario detallado que se muestra al seleccionar y recibir ticket -->
                                <!-- Formulario detallado que se muestra al seleccionar y recibir ticket -->
                                <!-- Formulario detallado que se muestra al seleccionar y recibir ticket -->
                                <!-- Formulario detallado que se muestra al seleccionar y recibir ticket -->
                                <div class="card" style="max-width: 1000px; margin: 0 auto; border: 1px solid #007bff; background-color: #f8f9fa; box-shadow: 0px 4px 6px rgba(0, 123, 255, 0.1);">
                                    <br>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">DETALLES DEL TALLER</h5>

                                        <!-- Campos ocultos para IDs que vienen de otras operaciones -->
                                        <input type="hidden" id="inun_id" name="inun_id"> <!-- Vehículo seleccionado -->
                                        <input type="hidden" id="esme_id_hidden" name="esme_id"> <!-- Motivo de Mantenimiento -->
                                        <input type="hidden" id="deso_id" name="deso_id"> <!-- Detalle de solicitud -->


                                        <div class="row">
                                            <!-- Contenedor para la vista previa de la imagen -->
                                            <div class="col-md-12 mb-3">
                                                <label for="foto-vehiculo" class="form-label">Foto de cómo ingresa el vehículo:</label>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Botón personalizado para cargar imagen -->
                                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('foto-vehiculo').click();" disabled>Cargar Imagen</button>
                                                    <!-- Input de archivo oculto -->
                                                    <input type="file" id="foto-vehiculo" name="foto-vehiculo" class="form-control d-none" accept="image/*" disabled>
                                                    <!-- Mostrar el nombre de la imagen seleccionada -->
                                                    <span id="foto-vehiculo-nombre" class="mt-2 d-block"></span>
                                                    <!-- Contenedor para la vista previa de la imagen con un enlace para agrandar -->
                                                    <div class="mt-3">
                                                        <img id="preview-foto-vehiculo" src="" alt="Vista previa" style="display: none; max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;" onclick="openModal('foto-vehiculo-modal')" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal para agrandar la imagen -->
                                            <div class="modal fade" id="foto-vehiculo-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Vista Ampliada de Ingreso del Vehiculo</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img id="modal-foto-vehiculo" src="" alt="Vista ampliada" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" disabled>Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Fecha y Hora en la misma fila -->
                                            <div class="col-md-3 mb-3">
                                                <label for="fecha" class="form-label">Fecha:</label>
                                                <input type="date" id="fecha" name="fecha" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="hora" class="form-label">Hora:</label>
                                                <input type="time" id="hora" name="hora" class="form-control" disabled>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="mecanico_id" class="form-label">Nombre del Mecánico:</label>
                                                <select id="mecanico_id" name="mecanico_id" class="form-control" disabled>
                                                    <option value="">Seleccione un mecánico</option>
                                                </select>
                                            </div>

                                            <!-- Diagnóstico especializado -->
                                            <div class="col-md-12 mb-3">
                                                <label for="diagnostico" class="form-label">Diagnóstico especializado:</label>
                                                <textarea id="diagnostico" name="diagnostico" class="form-control" rows="3" disabled></textarea>
                                            </div>



                                            <!-- Botón para la solicitud al almacén -->
                                            <div id="solicitud-almacen" style="text-align: right; margin-top: 10px; display: none;">
                                                <button type="button" class="btn btn-oblong btn-warning " data-toggle="modal" data-target="#almacenModal">
                                                    <i class="fa fa-eye"></i> Ver Repuesto
                                                </button>
                                                <button type="button" class="btn btn-oblong btn-warning" data-toggle="modal" data-target="#notificacionModal">
                                                    <i class="fa fa-cogs"></i> Enviar Solicitud
                                                </button>
                                                <div id="titulo-repuesto-seleccionado" style="font-size: 18px; font-weight: bold; color: #007bff; text-align: right;">
                                                    <!-- Aquí aparecerá el nombre del vehículo seleccionado -->
                                                </div>

                                            </div>












                                            <!-- Acción realizada -->
                                            <div class="col-md-12 mb-3">
                                                <br>
                                                <label for="accion" class="form-label">Acción realizada:</label>
                                                <textarea id="accion" name="accion" class="form-control" rows="3" disabled></textarea>
                                            </div>

                                            <!-- Sección de tercerización en línea -->
                                            <div class="col-md-6 mb-3 d-flex align-items-center justify-content-between">
                                                <label for="tercerizar" class="form-label">¿Se Tercerizar?</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="tercerizar-si" name="tercerizar" value="si" onclick="toggleEmpresa(true)" disabled>
                                                        <label class="form-check-label" for="tercerizar-si">Sí</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="tercerizar-no" name="tercerizar" value="no" onclick="toggleEmpresa(false)" disabled>
                                                        <label class="form-check-label" for="tercerizar-no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Formulario de empresa (inicialmente oculto) -->
                                            <div class="col-md-6 mb-3 hidden mt-3" id="empresa-section">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="empresa" class="form-label">Empresa tercerizada:</label>
                                                        <input type="text" id="empresa" name="empresa" class="form-control" disabled>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="informe" class="form-label">Cargar informe:</label>
                                                        <input type="file" id="informe" name="informe" class="form-control" accept=".pdf,.doc,.docx" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Contenedor para la vista previa de la imagen -->
                                            <div class="col-md-12 mb-3">
                                                <div class="col-md-3 mb-3">
                                                    <label for="imagen-salida" class="form-label">Foto de cómo sale el vehículo:</label>
                                                    <!-- Botón personalizado para cargar imagen -->
                                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('imagen-salida').click();" disabled>Cargar Imagen</button>
                                                    <!-- Input de archivo oculto -->
                                                    <input type="file" id="imagen-salida" name="imagen-salida" class="form-control d-none" accept="image/*" disabled>
                                                    <!-- Mostrar el nombre de la imagen seleccionada -->
                                                    <span id="imagen-salida-nombre" class="mt-2 d-block"></span>
                                                    <!-- Contenedor para la vista previa de la imagen -->
                                                    <div class="mt-3">
                                                        <img id="preview-imagen-salida" src="" alt="Vista previa" style="display: none; max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;" onclick="openModal('imagen-salida-modal')" disabled>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-3 mb-3">
                                                <label for="fecha" class="form-label">Fecha salida:</label>
                                                <input type="date" id="fecha" name="fecha" class="form-control" disabled>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="hora" class="form-label">Hora Salida:</label>
                                                <input type="time" id="hora" name="hora" class="form-control" disabled>
                                            </div>




                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-center mt-4">
                                                    <button type="button" class="btn btn-outline-info mx-2" onclick="validarFormulario()" disabled>Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>


                    </div>


                </div>
            </div>
        </div>
        </form>






        </div>

        </div>
        </div>
        </div>

        <?php
        require_once("../Js/MainJs.php");

        ?>
        <script type="text/javascript" src="mecanico.js"></script>
        <!-- Bootstrap JS and dependencies (Popper and jQuery) -->


    </body>

    </html>

<?php
} else {
    header("Location:" . Conectar::ruta() . "View/404");
}
?>