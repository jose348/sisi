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
                        <strong class="d-block d-sm-inline-block-force text text-dark semibold">ADMINISTRAR DETALLE DE LA SOLICITUD</strong>
                    </header>
                    <br>

                    <div class="col-12 container">

                        <div class="row">
                            <div class="col-12" style="float:center;">
                                <div class="card-header  tx-white bg-info">
                                    <div class="row ">


                                        <div class="col-4 text-with" style="float:left;">

                                            <h4 class="text text-with  " id="numsolici"></h4>

                                        </div>



                                        <div class="col-4  text-with" style="float:center;">
                                            <center>
                                                <h4 class="text text-with  " id="fechsoli"></h4>
                                            </center>
                                        </div>





                                        <div class="col-4 text-right text-dark" style="float:right;" id="lblestado">

                                        </div>
                                    </div>

                                </div><!-- card-header -->
                                <div class="card-body bd bd-t-100 rounded-bottom" style=" font-size: 12px; font-weight: bold;color: dark;">


                                    <div id="proyectos-size">
                                        <ul>
                                            <li>TITULO :<center>
                                                    <p class="text text-with  " id="sore_titulo"></p>
                                                </center>
                                            </li>
                                            <br>
                                            <li>CANTIDAD SOLICITADA:<center>
                                                    <p class="text text-with  " id="deso_cantidad"></p>
                                                </center>
                                            </li>
                                            <br>
                                            <li>FECHA :<center>
                                                    <p class="text text-with  " id="sore_fecha"></p>
                                                </center>
                                            </li>
                                            <br>
                                            <li>REPUESTO:<center>
                                                    <p class="text text-with  " id="repu_descripcion"></p>
                                                </center>
                                            </li>
                                            <br>
                                        </ul>
                                        <center>
                                            <div class="row center">
                                                <div class="col-6">
                                                    <button type="button" onclick="atender(<?php echo $row['deso_id']; ?>)" id="atenderSolicitud" class=" col-6 btn btn-oblong btn-outline-warning btn-block"><i class="fa fa-check mg-r-10"></i>Atender</button>
                                                    

                                                </div>
                                                <div class="col-6">

                                                    <button type="button" id="cerrarSolicitud" name="action" value="add" class="btn btn-oblong btn-inline btn-danger">Cerrar Solicitud</button>

                                                </div>
                                            </div>
                                        </center>
                                    </div>

                                </div><!-- card-body -->





                            </div><!-- col-sm -->

                        </div><!-- card -->
                    </div><!-- col -->
                    <br>
                    <br>

                    <form method="post" id="repu_form" class="form row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label  text text-danger">Validar Existencia del REPUESTO / CANTIDAD : </label>
                                <select class="form-control select2  " style="width:100%; white-space: inherit;" name="repu_id" id="repu_id" data-placeholder="REPUESTO - CANTIDAD ">
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>

                    </form>

                </div><!-- row -->
            </div>
        </div>

        </div>

        <?php

        require_once("../Js/MainJs.php");



        ?>
        <script type="text/javascript" src="detalleSoli.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>