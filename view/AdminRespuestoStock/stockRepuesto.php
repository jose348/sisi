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
                        <strong class="d-block d-sm-inline-block-force text text-danger">STOCK DEL REPUESTO</strong>
                    </header>
                    <br>

                    <div class="form-layout">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label has-error">Repuesto: <span class="tx-danger"></span></label>
                                        <select class="form-control select2  " style="width:100%" name="repu_descripcion" id="repu_descripcion" data-placeholder="Seleccione">
                                            <option label="Seleccione"></option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4 col-xl-3">
                                <div class="bg-teal rounded overflow-hidden">
                                    <div class="pd-20 d-flex align-items-left">
                                        <i class="fa fa-line-chart tx-50 tx-white op-7"></i>
                                        <div class="mg-l-20">
                                            <p class="tx-12 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Stock Total</p>
                                            <p class="tx-20 tx-white tx-lato tx-bold mg-b-2 lh-1" id=""></p>
                                            <span class="tx-11 tx-roboto tx-white-6">24% higher yesterday</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-wrapper"></div>
                    <br>
                    <table id="stock_data" class="table display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="wd-15p">Codigo</th>
                                <th class="wd-15p">Repuesto</th>
                                <th class="wd-15p">Stock</th>
                                <th class="wd-20p">Fecha de Ingreso</th>
                                <th class="wd-10p"></th>
                                <th class="wd-10p"></th>
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
        <script type="text/javascript" src="AdminRepuestoStock.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>