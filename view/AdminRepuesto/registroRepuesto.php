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
                        <strong class="d-block d-sm-inline-block-force text text-danger">REGISTRAR REPUESTO NUEVO</strong>
                    </header>
                    <br>

                    <div class="body">
                        <form method="post" id="repuesto_form" class="form row">
                            <input type="hidden" name="repu_id" id="repu_id" />




                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Codigo Repuesto: <span class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="repu_codigo" type="text" name="repu_codigo" required />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Repuesto: <span class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="repu_descripcion" type="text" name="repu_descripcion" required />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Responsable de Almacen: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" style="width:100%" name="alma_id" id="alma_id">
                                        <option label="Seleccione"></option>

                                    </select>
                                </div>
                            </div>
                            <br>





                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label class="form-control-label">Unidad de Medida: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" style="width:100%" name="unme_id" id="unme_id" data-placeholder="">
                                        <option label="Seleccione"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Stock: <span class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="repu_stock" min="0" type="number" name="repu_stock" required />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Precio Unitario: <span class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="repu_precio_unitario" type="long" name="repu_precio_unitario" required />
                                </div>
                            </div>
                            <!--  <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Utimo Stock Ingresado: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_stock_ultimo_ingreso" type="number" name="repu_stock_ultimo_ingreso" value="" readonly />
                            </div>
                        </div> -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Ultimo Ingreso de Repuesto: <span class="tx-danger">*</span></label>
                                    <input class="form-control tx-uppercase" id="repu_ultimo_ingreso" type="date" name="repu_ultimo_ingreso" required />
                                </div>
                            </div>


                           

                            <div class="col-12">
                                <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
                                <center><button type="submit" id="#" name="action" value="add" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-close"></i> Cancelar</button>
                                </center>
                            </div>
                        </form>
                    </div>

                </div>
            </div>




        </div>

        <?php
        require_once("../Js/MainJs.php");


        ?>
        <script type="text/javascript" src="adminRepuesto.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>