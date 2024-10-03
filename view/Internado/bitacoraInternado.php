<?php

require_once("../../config/conexion.php");

if (isset($_SESSION["id"])) { //para validar si cerre session y no abrir el url copiado antes que ingrese 
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        require_once("../Head/MainHead.php");
        ?>
        <title>ADMIN::Unidades</title>
        <link href="styles.css" rel="stylesheet">
    </head>

    <body>

        <?php
        require_once("../Menu/menu.php");
        ?>
        <!-- ########## END: LEFT PANEL ########## -->

        <?php
        require_once("../Header/MainHeader.php");
        ?>
        <!-- ########## END: HEAD PANEL ########## -->

        <!-- ########## START: MAIN PANEL ########## -->

        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
                <span class="breadcrumb-item active">Bitácora</span>
            </div><!-- br-pageheader -->

            <div class="row">
                <div class="br-section-wrapper container">
                    <p class="tx-16 tx-uppercase tx-spacing-1 mg-t-1 mg-b-2 tx-gray-600 text-center">
                        INTERNAMIENTO DE VEHICULOS - MPCH - BITACORA
                    </p>

                    <div class="container">
                        <br>
                        <h2 class="text-center">Bitácora de Unidades</h2>
                        <hr>




                        <form id="formBusqueda" method="POST"  >
                            <div class="row">
                                <!-- Combo de Tipo de Unidad -->
                                <div class="col-3  ">
                                    <label for="tipoUnidad" class="search-title">Tipo de Unidad</label>
                                    <select id="tiun_id" name="tiun_id" class="form-control select2">
                                        <option value="">Seleccione tipo de unidad</option>
                                    </select>
                                </div>

                                <!-- Combo de Modelo -->
                                <div class="col-3 ">
                                    <label for="modelo" class="search-title">Modelo</label>
                                    <select id="mode_id" name="mode_id" class="form-control select2"></select>
                                </div>

                                <!-- Combo de Marca -->
                                <div class="col-3  ">
                                    <label for="marca" class="search-title">Marca</label>
                                    <select id="marc_id" name="marc_id" class="form-control select2"></select>
                                </div>

                                <!-- Input de Placa -->
                                <div class="col-2  ">
                                    <label for="placaUnidad" class="search-title">Placa de Unidad</label>
                                    <input type="text" class="form-control" id="placaUnidad" name="placaUnidad" placeholder="">
                                </div>

                                <!-- Botón de Buscar -->
                                <div class="col-1  align-self-end">
                                    <button type="button" class="btn btn-primary btn-block" id="btnBuscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="row mt-4">
                                <!-- Campo para seleccionar fecha desde -->
                                <div class="col-md-4">
                                    <label for="fechaDesde" class="search-title">Fecha Desde</label>
                                    <input type="date" class="form-control" id="fechaDesde" name="fechaDesde">
                                </div>

                                <!-- Campo para seleccionar fecha hasta -->
                                <div class="col-md-4">
                                    <label for="fechaHasta" class="search-title">Fecha Hasta</label>
                                    <input type="date" class="form-control" id="fechaHasta" name="fechaHasta">
                                </div>

                                <!-- Botón para generar reporte en PDF -->
                                <div class="col-md-2 align-self-end">
                                    <button type="button" class="btn btn-outline-danger btn-block" id="btnGenerarPDF">
                                        <i class="fa fa-file-pdf-o"></i> Generar PDF
                                    </button>
                                </div>

                                <!-- Botón para generar reporte en Excel -->
                                <div class="col-md-2 align-self-end">
                                    <button type="button" class="btn btn-outline-success btn-block" id="btnGenerarExcel">
                                        <i class="fa fa-file-excel-o"></i> Generar Excel
                                    </button>
                                </div>
                            </div>
                        </form>






<br>
<br>
<br>

                        <!-- Tabla para listar los datos -->
                        <table id="bitacoraTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Placa</th>
                                    <th>Tipo de Unidad</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>F.Prog.Mant</th>
                                    <th>Ticket</th>
                                    <th>Mantenimiento</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once("../Js/MainJs.php");
        require_once("bitacoraInternadoModal.php");
        ?>

        <script type="text/javascript" src="bitacoraInternado.js"></script>
    </body>

    </html>
<?php
} else {
    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea
}
?>