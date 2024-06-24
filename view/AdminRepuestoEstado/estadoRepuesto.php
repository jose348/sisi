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
                        <strong class="d-block d-sm-inline-block-force text text-danger">ESTADO DEL REPUESTO</strong>
                    </header>
                    <br>

                    <div class="form-layout">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Situacion del Repuesto: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" style="width:100%" name="repu_situacion" id="repu_situacion"   >
                                            <option label="Seleccione"></option>
                                            <option value="A">ACTIVO</option>
                                            <option value="M">MALOGRADO</option>
                                            <option value="T">TALLER</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-control-label">&nbsp;</label>
                                <button class="btn btn-outline-primary btn-oblong  form-control" id="add_button" onclick="nuevo()"><i class="fa fa-file-pdf-o mg-r-5"></i> Repuesto</button>
                            </div>
                        </div>
                    </div>


                    <div class="table-wrapper"></div>
                    <table id="situacion_data" class="table display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="wd-15p">Codigo</th>
                                <th class="wd-15p">Repuesto</th>
                                <th class="wd-15p">Stock Total</th>
                                <th class="wd-20p">Fecha Ingreso</th>
                                <th class="wd-15p">Situacion</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>




        </div>

        <?php
        require_once("../Js/MainJs.php");


        ?>
        <script type="text/javascript" src="estadoRespuesto.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>