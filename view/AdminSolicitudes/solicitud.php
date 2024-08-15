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
        <title>ADMIN::Solicitud</title>


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

            <div class="br-pagebody">
                <div class="br-section-wrapper">

                    <header class="card-header">
                        <strong class="d-block d-sm-inline-block-force text text-danger">ADMINISTRAR SOLICITUDES DE MECANICO</strong>
                    </header>
                    <br>

                    <div class="container">
                        <div class="row" id="lblDetalle">
                        
                        </div>  
                        

                    </div><!--.activity-line-->
                   



                </div><!-- row -->
            </div>
        </div>




        </div>

        <?php

        require_once("../Js/MainJs.php");



        ?>
        <script type="text/javascript" src="solicitud.js"></script>
        <script type="text/javascript" src="../DetalleSolicitud/detalleSoli.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>