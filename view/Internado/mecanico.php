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

                        <!-- Formulario detallado que se muestra al seleccionar y recibir ticket -->
                        <!-- Formulario principal con nuevo diseño estilo card -->
                        <form id="detalle-form" class="hidden mt-4">
                            <div class="card" style="max-width: 1000px; margin: 0 auto; border: 1px solid #007bff; background-color: #f8f9fa; box-shadow: 0px 4px 6px rgba(0, 123, 255, 0.1);">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Detalles de Mantenimiento</h5>

                                    <div class="row">
                                        <!-- Contenedor para la vista previa de la imagen -->
                                        <div class="col-md-12 mb-3">
                                        <label for="foto-vehiculo" class="form-label">Foto de cómo ingresa el vehículo:</label>

                                            <div class="col-md-3 mb-3">
                                               

                                                <!-- Botón personalizado para cargar imagen -->
                                                <button type="button" class="btn btn-primary" onclick="document.getElementById('foto-vehiculo').click();">Cargar Imagen</button>

                                                <!-- Input de archivo oculto -->
                                                <input type="file" id="foto-vehiculo" name="foto-vehiculo" class="form-control d-none" accept="image/*">

                                                <!-- Mostrar el nombre de la imagen seleccionada -->
                                                <span id="foto-vehiculo-nombre" class="mt-2 d-block"></span>

                                                <!-- Contenedor para la vista previa de la imagen con un enlace para agrandar -->
                                                <div class="mt-3">
                                                    <img id="preview-foto-vehiculo" src="" alt="Vista previa" style="display: none; max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;" onclick="openModal('foto-vehiculo-modal')">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal para agrandar la imagen -->
                                        <div class="modal fade" id="foto-vehiculo-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel">Vista Ampliada</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img id="modal-foto-vehiculo" src="" alt="Vista ampliada" style="max-width: 100%; height: auto;">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <!-- Fecha y Hora en la misma fila -->
                                        <div class="col-md-3 mb-3">
                                            <label for="fecha" class="form-label">Fecha:</label>
                                            <input type="date" id="fecha" name="fecha" class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="hora" class="form-label">Hora:</label>
                                            <input type="time" id="hora" name="hora" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="mecanico_id" class="form-label">Nombre del Mecánico:</label>
                                            <select id="mecanico_id" name="mecanico_id" class="form-control">
                                                <option value="">Seleccione un mecánico</option>
                                            </select>
                                        </div>

                                        <!-- Diagnóstico especializado -->
                                        <div class="col-md-12 mb-3">
                                            <label for="diagnostico" class="form-label">Diagnóstico especializado:</label>
                                            <textarea id="diagnostico" name="diagnostico" class="form-control" rows="3"></textarea>
                                        </div>

                                        <!-- Acción realizada -->
                                        <div class="col-md-12 mb-3">
                                            <label for="accion" class="form-label">Acción realizada:</label>
                                            <textarea id="accion" name="accion" class="form-control" rows="3"></textarea>
                                        </div>

                                        <!-- Sección de tercerización en línea -->
                                        <div class="col-md-6 mb-3 d-flex align-items-center justify-content-between">
                                            <label for="tercerizar" class="form-label">¿Se Tercerizar?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="tercerizar-si" name="tercerizar" value="si" onclick="toggleEmpresa(true)">
                                                    <label class="form-check-label" for="tercerizar-si">Sí</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="tercerizar-no" name="tercerizar" value="no" onclick="toggleEmpresa(false)">
                                                    <label class="form-check-label" for="tercerizar-no">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Formulario de empresa (inicialmente oculto) -->
                                        <div class="col-md-6 mb-3 hidden mt-3" id="empresa-section">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="empresa" class="form-label">Empresa tercerizada:</label>
                                                    <input type="text" id="empresa" name="empresa" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="informe" class="form-label">Cargar informe:</label>
                                                    <input type="file" id="informe" name="informe" class="form-control" accept=".pdf,.doc,.docx">
                                                </div>


                                            </div>
                                            <!-- Botón cargar para empresa tercerizada -->
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">Cargar</button>
                                            </div>
                                        </div>




                                        <!-- Contenedor para la vista previa de la imagen -->
                                        <div class="col-md-12 mb-3">
                                            <label for="imagen-salida" class="form-label">Foto de cómo sale el vehículo:</label>

                                            <!-- Botón personalizado para cargar imagen -->
                                            <button type="button" class="btn btn-primary" onclick="document.getElementById('imagen-salida').click();">Cargar Imagen</button>

                                            <!-- Input de archivo oculto -->
                                            <input type="file" id="imagen-salida" name="imagen-salida" class="form-control d-none" accept="image/*">

                                            <!-- Mostrar el nombre de la imagen seleccionada -->
                                            <span id="imagen-salida-nombre" class="mt-2 d-block"></span>

                                            <!-- Contenedor para la vista previa de la imagen -->
                                            <div class="mt-3">
                                                <img id="preview-imagen-salida" src="" alt="Vista previa" style="display: none; max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;" onclick="openModal('imagen-salida-modal')">
                                            </div>
                                        </div>

                                        <!-- Modal para agrandar la imagen -->
                                        <div class="modal fade" id="imagen-salida-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel">Vista Ampliada</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img id="modal-imagen-salida" src="" alt="Vista ampliada" style="max-width: 100%; height: auto;">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                        </form>
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