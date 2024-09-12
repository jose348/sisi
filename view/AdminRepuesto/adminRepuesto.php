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
                        <strong class="d-block d-sm-inline-block-force text text-danger">LISTA DE RESPUESTOS ACTIVOS</strong>
                    </header>
                    <br>

                    <!--  <button class="col-lg-3 btn btn-outline-primary float-right" id="add_button" onclick="nuevo()">
                        Nuevo Repuesto<i class="fa fa-home mg-r-10"></i>
                    </button> -->

                    <br>
                    <div class="box-typical box-typical-padding" id="table">
                        <br>
                        <table id="repuesto_data" class="table table-bordered table-striped table-center js-dataTable-full text text-center">
                            <br>
                            <thead>
                                <tr>

                                    <th class="text text-center" style="width: 12%; ">Codigo</th>
                                    <th class="text text-center" style="width: 25%; ">Repuesto</th>
                                    <th class="text text-center" style="width: 14%; ">Stock</th>
                                    <th class="text text-center" style="width: 16%; ">Cant de Ult Ingreso</th>
                                    <th class="text text-center" style="width: 16%; ">Fech de ult Ingreso</th>
                                    <th></th>

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
        require_once("modalRepuesto.php");
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