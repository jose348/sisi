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
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Google Maps Geoposicionamiento</title>




    </head>

    <body onload="initialize()">

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



            <!-- TABLA PARA IMPLEMENTACION CON JS  -->
            <!-- TABLA PARA IMPLEMENTACION CON JS  -->
            <div class="br-pagebody">
                <div class="br-section-wrapper">

                  
                    <div id="map-canvas"></div>
                    <div class="lngLat"><span class="one">Latitud</span><span class="two">,Longitud</span></div>
                  
                    <div class="col-lg-12">
                        <div class="form-group">
                        <button class="btn btn-outline-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"  onclick="copyToClipboard(document.getElementById('info').innerHTML)"><i class="fa fa-check"></i> Cordenadas</button>
                       
                            <textarea class="form-control" id="info" style="text-transform:uppercase" requerid></textarea>
                        </div>
                    </div>

                </div>

                

            </div>
        </div>

        <?php

        require_once("../Js/MainJs.php");

        ?>
        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false'></script>
        <script type="text/javascript" src="poligonoMaps.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>