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
                    <header class="card-header ">
                        <strong class="d-block d-sm-inline-block-force text text-danger">ADMINISTRAR AREA</strong>
                    </header>
                    <br>
                    
                    <button class="col-lg-3 btn btn-outline-primary float-right" id="add_button" onclick="nuevo()">
                        <i class="fa fa-home mg-r-10"></i>Nueva Area
                    </button>
                   
                    <div class="table-wrapper">
                    <br>
                        <table id="area_data" class="table-responsive table table-active table-check table table-striped   ">
                            <thead>
                                <tr>
                                    <th class="wd-5p">Id</th>
                                    <th class="wd-5p">Codigo</th>
                                    <th class="wd-20p">Dependencia</th>
                                    <th class="wd-15p">Representante</th>
                                    <th class="wd-10p"></th>
                                    <th class="wd-10p"></th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->

                </div>
            </div>




        </div>

        <?php

        require_once("../Js/MainJs.php");
       

        ?>
        <script type="text/javascript" src="adminregistrounidad.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>