<?php

require_once("../../config/conexion.php");


if (isset($_SESSION["id"])) { //para validar si cerre session y no abrir el url copiado antes que ingrese 
    //por url------esta linea 
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


        <!-- ########## END: RIGHT PANEL ########## --->

        <!-- ########## START: MAIN PANEL ########## -->

        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">

                <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
                <span class="breadcrumb-item active">Bitácora</span>

            </div><!-- br-pageheader -->

            <!-- TODO LISTANDO AREAS -->
            <!-- TODO LISTANDO AREAS -->
            <!-- TODO LISTANDO AREAS -->

            <div class="row">
                <div class="br-section-wrapper container">

                    <p class="tx-16 tx-uppercase tx-spacing-1 mg-t-1 mg-b-2 tx-gray-600 text-center">
                        INTERNAMIENTO DE VEHICULOS - MPCH - BITACORA
                    </p>

                    <div class="container">
                        <br>
                        <h2 class="text-center">Bitácora de Unidades</h2>
                        <hr>

                        <!-- Formulario de búsqueda -->

                        <form id="formBusqueda" method="POST" class="mb-4">
                            <div class="row">
                                <div class="col-md-3 mt-4">
                                    <label for="tipoUnidad" class="search-title">Tipo de Unidad</label>
                                    <select id="tiun_id" name="tiun_id" class="form-control select2">
                                        <option value="">Seleccione tipo de unidad</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="modelo" class="search-title">Modelo</label>
                                    <select id="mode_id1" name="mode_id1" class="form-control select2"></select>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="marca" class="search-title">Marca</label>
                                    <select id="marc_id" name="marc_id" class="form-control select2"></select>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <label for="placaUnidad" class="search-title">Placa de Unidad</label>
                                    <input type="text" class="form-control" id="placaUnidad" name="placaUnidad" placeholder="Placa de Unidad">
                                </div>
                            </div>
                        </form>

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
                            <tbody></tbody>
                        </table>



                    </div>


                </div>
            </div>


        </div>

        <?php

        require_once("../Js/MainJs.php");



        ?>

        <script type="text/javascript" src="bitacoraInternado.js"></script>

    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>