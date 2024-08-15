<?php

require_once("../../config/conexion.php");
if (isset($_SESSION["id"])) { //para validar si cerre session y no abrir el url copiado antes que ingrese 
    //por url------esta linea 
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php
        require_once("../Head/MainHead.php");
        ?>
        <title>ADMIN::Repuesto</title>


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
                <span class="breadcrumb-item active">Registro</span>

            </div><!-- br-pageheader -->

            <!-- TODO LISTANDO AREAS -->
            <!-- TODO LISTANDO AREAS -->
            <!-- TODO LISTANDO AREAS -->

            <div class="br-pagebody row">
                <div class="br-section-wrapper container">



                    <!-- #region  -->
                    <header class="card-header">
                        <strong class="d-block d-sm-inline-block-force text text-danger">BAJAS / ALTAS DEL REPUESTO</strong>
                    </header>
                    <br>
                    <button class="col-lg-3 btn btn-oblong btn-info float-right" id="add_button" onclick="recargar()">
                        <i class="fa fa-refresh mg-r-10"></i> Re-Cargar
                    </button>

                    <!-- TODO TABLA LO TRAEMOS DE MANTENIMIENTO USUARIO PARA MOSTRAR LOS USUARIOS -->
                    <div class="table-wrapper">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">ALTAS / BAJAS: <span class="tx-danger"></span></label>
                                            <select class="form-control select2" style="width:100%" name="repu_estado" id="repu_estado">
                                                <option label="Seleccione"></option>
                                                <option value="1">ALTAS</option>
                                                <option value="0">BAJAS</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <table id="baja_data" class="table display responsive nowrap">
                            <thead>
                                <tr>

                                    <th class="wd-10p" style="text-align: center;">Codigo</th>
                                    <th class="wd-15p" style="text-align: center;">Repuesto</th>
                                    <th class="wd-5p" style="text-align: center;">Stock</th>
                                    <th class="wd-1p" style="text-align: center;">Stock total</th>

                                    <th class="wd-13p" style="text-align: center;">ESTADO</th>

                                    <th class="wd-5p" style="text-align: center;">Ultimo Ingreso</th>
                                    <th class="wd-10p" style="text-align: center;">Situacion</th>




                                </tr>
                            </thead>
                            <tbody style="text-align: center;">

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>




        </div>

        <?php
        require_once("../Js/MainJs.php");


        ?>
        <script type="text/javascript" src="altasbajas.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>