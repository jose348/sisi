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
        <title>USER::Unidades</title>


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



            <!-- TABLA PARA IMPLEMENTACION CON JS  -->
            <!-- TABLA PARA IMPLEMENTACION CON JS  -->
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <!-- #region  -->
                    <header class="card-header">
                        <strong class="d-block d-sm-inline-block-force text text-primary">REGISTRO DE UNIDADES MOVILES</strong>
                    </header>
                    <br>


                    <form id="registroMovil">
                        <input type="hidden" name="unid_id" id="unid_id" />
                        <div class="row mg-b-25">


                            <div class="row col-12">

                                <label class="form-control-label col-1">Tipo: <span class="tx-danger ">*</span></label>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force has-warning">

                                        <select class="form-control select2" name="tiun_id" id="tiun_id" data-placeholder="Seleccione Tipo Movil" required>
                                            <option label="Seleccione"></option>
                                        </select>

                                    </div>
                                </div><!-- col-4 -->



                                <label class="form-control-label col 1">Codigo: <span class="tx-danger">*</span></label>
                                <div class="col-lg-5">
                                    <div class="form-group">

                                        <input class="form-control" type="text" name="unid_codigo" id="unid_codigo" placeholder="Ingrese Codigo" required>
                                    </div>
                                </div><!-- col-4 -->







                                <label class="form-control-label col-1">Marca: <span class="tx-danger ">*</span></label>
                                <br>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force has-warning">

                                        <select class="form-control select2" name="marc_id" id="marc_id" data-placeholder="Seleccione Marca del Movil" required>
                                            <option label="Seleccione"></option>
                                        </select>

                                    </div>
                                </div><!-- col-4 -->



                                <label class="form-control-label col-1">Modelo: <span class="tx-danger ">*</span></label>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force has-warning">

                                        <select class="form-control select2" name="mode_id" id="mode_id" data-placeholder="Seleccione Modelo del Movil" required>
                                            <option label="Seleccione"></option>


                                        </select>

                                    </div>
                                </div><!-- col-4 -->









                                <label class="form-control-label col-1">Area: <span class="tx-danger ">*</span></label>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force has-warning">

                                        <select class="form-control select2" name="depe_id" id="depe_id" data-placeholder="Seleccione Area de Destino" required>

                                            <option label="Seleccione"></option>


                                        </select>


                                    </div>
                                </div><!-- col-4 -->



                                <label class="form-control-label col-1">placa <span class="tx-danger">*</span></label>
                                <div class="col-lg-5">
                                    <div class="form-group mg-b-10-force">

                                        <input class="form-control" type="text" name="unid_placa" id="unid_placa" placeholder="Ingrese Placa" required>
                                    </div>
                                </div><!-- col-8 -->







                                <label class="form-control-label col-1">Color: <span class="tx-danger ">*</span></label>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force has-warning">

                                        <select class="form-control select2" style="width:100%" name="colo_id" id="colo_id" data-placeholder="Seleccione Color" required>
                                            <option label="Seleccione"></option>

                                        </select>

                                    </div>
                                </div><!-- col-4 -->



                                <label class="form-control-label col-1">Año : <span class="tx-danger">*</span></label>
                                <div class="col-lg-5">
                                    <div class="form-group">

                                        <input class="form-control" type="date" name="unid_anio" id="unid_anio" placeholder="Ingrese Año" required>
                                    </div>
                                </div><!-- col-4 -->












                                <label class="form-control-label col-1">Combustible:<span class="tx-danger ">*</span></label>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force has-warning">

                                        <select class="form-control select2" name="comb_id" id="comb_id" data-placeholder="Seleccione" required>

                                           

                                        </select>

                                    </div>
                                </div><!-- col-4 -->



                                <label class="form-control-label col-1">Adquisicion:<span class="tx-danger">*</span></label>
                                <div class="col-lg-5">
                                    <div class="form-group">

                                        <input class="form-control" type="date" name="unid_adquisicion" id="unid_adquisicion" placeholder="Ingrese Año" required>
                                    </div>
                                </div><!-- col-4 -->





                                <label class="form-control-label col-1">Motor: <span class="tx-danger">*</span></label>
                                <div class="col-lg-5">

                                    <div class="form-group mg-b-10-force">

                                        <input class="form-control" type="text" name="unid_motor" id="unid_motor" placeholder="Ingrese Tipo de Motor" required>
                                    </div>
                                </div><!-- col-4 -->









                                <div class="row col-12">
                                    <label class="form-control-label col-1">Descripcion 1 :<span class="tx-danger">*</span></label>
                                    <div class="form-group  col-11">
                                        <textarea class="form-control" id="unid_observacion" name="unid_observacion" placeholder="Ingrese Descripcion"></textarea>
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->

                        </div>
                        <div class="form-layout-footer justify-content-center row row-12">
                           <button type="submit" id="#" name="action" value="add" class="btn btn-outline-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                        </div><!-- form-layout-footer -->
                    </form>

                </div>




            </div>
        </div>

        <?php

        require_once("../Js/MainJs.php");

        ?>
        <script type="text/javascript" src="registrounidad.js"></script>
    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>