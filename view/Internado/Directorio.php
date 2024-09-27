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
            /* Flex container para el formulario, separador y tabla */
            .flex-container {
                display: flex;
                width: 100%;
                align-items: flex-start;
                /* Asegura que el formulario y la tabla se alineen en la parte superior */
            }

            /* Estilos para el separador vertical */
            .separator {
                border-left: 2px solid #ddd;
                height: 100%;
                margin: 0 20px;
            }

            /* Formulario y tabla */
            .formulario {
                flex: 4;
                /* El formulario ocupará menos espacio */
            }

            .tabla {
                flex: 6;
                /* La tabla ocupará más espacio */
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
                        INTERNAMIENTO DE VEHICULOS - MPCH - DIRECTORIO
                    </p>
                    <div class="container mt-5">
                        <div class="flex-container">
                            <!-- Columna izquierda: Formulario -->
                            <div class="formulario">
                                <h2 class="text-center">Asignar Función a Trabajador</h2>
                                <br>
                                <br>

                                <form id="asignarFuncionFormulario">
                                    <input type="hidden" id="direct_id" name="direct_id"> <!-- Campo oculto para direct_id -->

                                    <!-- Seleccionar Trabajador -->
                                    <div class="form-group row">
                                        <label for="trabajador" class="col-sm-9 col-form-label">Trabajador</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2 is-danger" name="trabajador_id" id="trabajador_id" disabled>
                                                <!-- Opciones llenadas dinámicamente -->
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Seleccionar Función -->
                                    <div class="form-group row">
                                        <label for="funcion" class="col-sm-9 col-form-label">Función</label>
                                        <div class="col-sm-12">
                                            <select class="form-control select2 is-danger" name="func_id" id="func_id" disabled>
                                                <!-- Opciones llenadas dinámicamente -->
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Descripción de la Tarea -->
                                    <div class="form-group row">
                                        <label for="descripcionTarea" class="col-sm-9 col-form-label">Descripción de la Tarea</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="descripcionTarea" rows="4" placeholder="Ingrese la descripción de la tarea asignada" required disabled></textarea>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Fecha de Asignación -->
                                    <div class="form-group row">
                                        <label for="fechaAsignacion" class="col-sm-9 col-form-label">Fecha de Asignación</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" id="fechaAsignacion" required disabled>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Botón de Enviar -->
                                    <!-- Botón de Enviar (Asignar Función) -->
                                    <button type="button" class="col-sm-12 btn btn-oblong btn-info" id="add_button" onclick="actualizarFuncion()" disabled>
                                        <i class="fa fa-check mg-r-10"></i> Asignar Función
                                    </button>
                                    <br>
                                    <br>
                                    <button type="button" class="col-sm-12 btn btn-oblong btn-success" id="add_tonken" onclick="tokens()" disabled>
                                        <i class="fa fa-lock mg-r-10"></i> Mi Token
                                    </button>
                                </form>







                            </div>

                            <!-- Línea de separación entre el formulario y la tabla -->
                            <div class="separator"></div>

                            <!-- Columna derecha: Tabla -->
                            <div class="tabla">
                                <h3 class="text-center">Cambios Asignados</h3>
                                <br>
                                <br>
                                <section class="p-3 mb-5 bg-light rounded">
                                    <table class="table table-bordered table-hover table-striped" id="directorio">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width:120px; text-align: center;">Trabajador</th>
                                                <th style="width:120px; text-align: center;">Función</th>

                                                <th style="width:120px; text-align: center;">Fecha</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaCambios">
                                            <!-- Filas dinámicas -->
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once("../Js/MainJs.php");
        require_once("tokenModal.php");
        ?>
        <script type="text/javascript" src="Directorio.js"></script>
        <script type="text/javascript" src="token.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:" . Conectar::ruta() . "View/404");
}
?>