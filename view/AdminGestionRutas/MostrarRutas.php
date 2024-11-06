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

        <title>ADMIN::Visualizar Rutas</title>

        <!-- CSS de Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            body,
            html {
                height: 100%;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            #map {
                height: 80vh;
                width: 100%;
            }

            .container {
                max-width: 800px;
                margin: 20px auto;
                text-align: center;
            }

            .control-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 10px;
            }

            .control-row select,
            .control-row button {
                margin-right: 10px;
                flex: 1;
            }
        </style>


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
                <span class="breadcrumb-item active">Registro</span>

            </div><!-- br-pageheader -->

            <div class="br-pagebody">
                <div class="br-section-wrapper">





                    <!-- Contenedor principal -->
                    <div class="row">

                        <br>
                        <!-- Fila de controles (Select + Botones) -->
                        <div class="col-12 control-row">
                            <select id="rutaSelect" class="form-control">
                                <option value="">Seleccione una ruta</option>
                            </select>
                            <button class="btn btn-warning" id="editarRuta">Editar Ruta</button>
                            <button class="btn btn-danger" id="eliminarRuta">Eliminar Ruta</button>
                            <button class="btn btn-info" id="limpiarRuta">Limpiar Ruta</button>
                        </div>
                        <br>

                        <div class="row col-12 align-items-center">
                            <div class="col-4">
                                <input class="form-control" type="text" id="nombreRutaEditar" placeholder="Nuevo nombre de la ruta" disabled>
                            </div>
                            <div class="col-4">
                                <select id="horarioSelectEditar" class="form-control" disabled>
                                    <option value="">Seleccione un horario</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-success" id="guardarCambiosRuta" style="display: none;">Guardar Cambios</button>
                            </div>
                        </div>
                        <br>



                        <!-- Contenedor del Mapa -->


                    </div>
                    <br>
                    <div id="map" style="height: 500px;"></div>


                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

                </div>
            </div>

            <?php

            require_once("../Js/MainJs.php");

            ?>

            <script src="MostrarRutas.js"></script>

    </body>

    </html>
<?php

} else {

    /* sino a iniciado session entonces lo redireccionara a la ruta principal */
    //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
    header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>