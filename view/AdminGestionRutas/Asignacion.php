<?php

require_once("../../config/conexion.php");
if (isset($_SESSION["id"])) { // Validar si hay sesión iniciada
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php
        require_once("../Head/MainHead.php");
        ?>
        <title>ADMIN::Asignación de Rutas</title>

        <!-- CSS de Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <style>
            .container-custom {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }

            .header-text {
                font-weight: bold;
                color: #007bff;
                text-align: center;
                font-size: 18px;
                margin-bottom: 20px;
            }

            .table-custom {
                background-color: #f9f9f9;
                border-radius: 8px;
                overflow: hidden;
            }

            .table-custom th {
                background-color: #EFEBEF;
                color: #ffffff;
                text-transform: uppercase;
                font-size: 14px;
            }

            .btn-custom {
                width: 100%;
                font-weight: bold;
                background-color: #007bff;
                color: #ffffff;
                border: none;
                border-radius: 5px;
                padding: 10px 0;
            }

            .btn-custom:hover {
                background-color: #0056b3;
            }


            .modal-fullscreen {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            .modal-body {
                padding: 0;
            }

            #map {
                height: 100vh;
                width: 100%;
            }
        </style>
    </head>

    <body>

        <?php
        require_once("../Menu/menu.php");
        ?>
        <?php
        require_once("../Header/MainHeader.php");
        ?>

        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
                <span class="breadcrumb-item active">Asignación de Rutas</span>
            </div><!-- br-pageheader -->

            <div class="br-pagebody">
                <div class="br-section-wrapper container-custom">

                    <h2 class="header-text">Asignación de Rutas</h2>

                    <div class="row mb-4">
                        <!-- Combo de búsqueda para seleccionar Chofer -->
                        <div class="col-md-6">
                            <label for="chofer" class="form-label">Seleccione un Chofer:</label>
                            <select id="chofer" name="chofer" class="form-control" style="width: 100%;"></select>
                        </div>
                        <br>

                        <!-- Combo de búsqueda para seleccionar Ayudante -->
                        <div class="col-md-6">
                            <label for="ayudante" class="form-label">Seleccione un Ayudante:</label>
                            <select id="ayudante" name="ayudante" class="form-control" style="width: 100%;"></select>
                        </div>
                        <br>
                    </div>

                    <br>
                    <div class="row">

                        <div class="col-md-6">
                            <h4 class="header-text">Rutas Disponibles</h4>
                            <div class="table-responsive table-custom">
                                <table id="rutaTable" class="table table-bordered text-center"> <!-- Añadir el ID aquí -->
                                    <thead>
                                        <tr>
                                            <th>Ruta</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th></th>
                                            <th>Mapa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ruta-list">
                                        <!-- Aquí se cargarán dinámicamente las rutas mediante AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>





                        <br>

                        <!-- Modal para mostrar el mapa -->
                        <!-- Modal para mostrar el mapa en pantalla completa -->
                        <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mapModalLabel"> Vista de Ruta en el Mapa para visualizar, selecionar ruta si es necesara ...! </h5>

                                    </div>
                                    <div class="modal-body">
                                        <div id="map" style="height: 50vh; width: 100%;"></div> <!-- Contenedor para el mapa en pantalla completa -->
                                    </div>
                                </div>
                            </div>
                        </div>










                        <!-- Tabla para seleccionar Unidad Móvil -->
                        <!--TODO tener encuenta que aqui solo utilice mis unidades de residuos solidos para unir con mis choferes, ayudantes, rutas-->
                        <!--TODO tener encuenta que aqui solo utilice mis unidades de residuos solidos para unir con mis choferes, ayudantes, rutas-->
                        <!--TODO tener encuenta que aqui solo utilice mis unidades de residuos solidos para unir con mis choferes, ayudantes, rutas-->
                        <!--TODO tener encuenta que aqui solo utilice mis unidades de residuos solidos para unir con mis choferes, ayudantes, rutas-->
                        <!--TODO tener encuenta que aqui solo utilice mis unidades de residuos solidos para unir con mis choferes, ayudantes, rutas-->
                        <div class="col-md-6">
                            <h4 class="header-text">Unidades Móviles Disponibles</h4>
                            <div class="table-responsive table-custom">
                                <table class="table table-bordered text-center" id="unidadesMovilesTable">
                                    <thead>
                                        <tr>
                                            <th>Placa</th>
                                            <th>Tipo de Unidad</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>


                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="unidades-list">
                                        <!-- Aquí se cargarán dinámicamente las unidades móviles mediante AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Botón para asignar la ruta y la unidad al chofer y ayudante seleccionados -->
                    <div class="text-center mt-4">
                        <button class="col-4 btn btn-custom" id="btn-asignar">Asignar RUTA - CHOFER - AYUDANTE - UNIDAD - HORARIO</button>
                    </div>

                </div>
            </div>
        </div>

        <?php
        require_once("../Js/MainJs.php");
        ?>


        <script src="Asignacion.js"></script> <!-- Archivo JavaScript donde se realizarán las interacciones -->
        <!-- JS de Leaflet -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    </body>

    </html>
<?php
} else {
    // Redirige si no hay sesión iniciada
    header("Location:" . Conectar::ruta() . "View/404");
}
?>