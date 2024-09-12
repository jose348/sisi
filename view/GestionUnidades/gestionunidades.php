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
        <title>Gestion::Unidades</title>


    </head>

    <body>

        <?php
        require_once("../Menu/menu.php");

        ?>
        <!-- ########## END: LEFT PANEL ########## -->

        <?php
        require_once("../Header/MainHeader.php");

        ?>

        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">

                <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
                <span class="breadcrumb-item active">Gestion de Unidades</span>

            </div><!-- br-pageheader -->
            <div class="br-pagebody col-12">

                <div class="br-section-wrapper">
                    <!-- #region  -->
                    <header class="card-header">
                        <strong class="d-block d-sm-inline-block-force text text-primary">GESTION DE UNIDADES MOVILES</strong>
                    </header>
                    <br>

                    <br>
                    <button class="col-sm-3 btn btn-outline-primary" id="add_button" onclick="nuevo()">
                        <i class="fa fa-plus mg-r-10"></i>Nuevo Registro
                    </button>

                    <div class="table-wrapper">
                        <br>
                        <table id="gestionunidades_data" class="table-responsive table table-active table-check table table-striped   ">
                            <thead>
                                <tr>
                                    <th class="wd-3p">ID</th>
                                    <th class="wd-3p">CD</th>
                                    <th class="wd-8p">Area</th>
                                    <th class="wd-2p">Tipo</th>
                                    <th class="wd-1p">Marca</th>
                                    <th class="wd-1p">Modelo</th>
                                    <th class="wd-2p">Adquisicion</th>
                                    <th class="wd-1p">Estado</th>
                                    <th class="wd-1p">Color</th>
                                    <th class="wd-1p">Combustible</th>
                                    <th class="wd-1p"></th>
                                    <th class="wd-1p"></th>

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

        require_once("modalgestionunidades.php");
        require_once("../Js/MainJs.php");

        ?>
        <script type="text/javascript" src="gestionunidades.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script><!-- script para traer mis excel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script><!-- script para traer mis excel -->

    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>