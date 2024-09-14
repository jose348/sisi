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
          <p class="tx-16 tx-uppercase tx-spacing-1 mg-t-1 mg-b-2 tx-gray-600">INTERNAMIENTO DE VEHICULOS - MPCH</p>

          <div id="wizard1" class="mg-t-20">
            <h4>MOVIL / REGISTRO MOVIL</h4>
            <section style="background-color: white;  padding: 20px;">

              <div class="col-12 row">

                <br>
                <button class="col-sm-3 btn btn-oblong btn-outline-info" id="add_button" onclick="nuevoMovil()">
                  <i class="fa fa-car mg-r-10"></i>Nuevo Movil
                </button>

                <button class="col-sm-3 btn btn-oblong btn-outline-warning  " id="add_button" onclick="editar()">
                  <i class="fa fa-car mg-r-10"></i>Editar Movil
                </button>

                <button class="col-sm-3 btn btn-oblong btn-outline-danger" id="add_button" onclick="eliminar()">
                  <i class="fa fa-car mg-r-10"></i>Dar Baja Movil
                </button>

                <button class="col-sm-3 btn btn-oblong btn-outline-secondary" id="add_button" onclick="pdf()">
                  <i class="fa fa-file-pdf-o mg-r-10"></i>Reporte Movil
                </button>
              </div>

              <div class="table-wrapper">
                <br>
                <table id="moviles_data" class="table-responsive table  table-check table table-striped">
                  <thead>
                    <tr>
                      <th class="text text-center" style="width: 1%; "></th>
                      <th class="text text-center" style="width: 1%; ">CD</th>
                      <th class="text text-center" style="width: 12%; ">Area</th>
                      <th class="text text-center" style="width: 2%; ">Tipo</th>
                      <th class="text text-center" style="width: 2%; ">Marca</th>
                      <th class="text text-center" style="width: 2%; ">Modelo</th>
                      <th class="text text-center" style="width: 2%; ">Motor</th>
                      <th class="text text-center" style="width: 2%; ">Estado</th>
                      <!-- <th class="wd-1p">Color</th>
                          <th class="wd-1p">Combustible</th> -->
                      <!-- <th class="wd-1p"></th>
                          <th class="wd-1p"></th> -->

                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>

              </div>
            </section>






            <h4>INGRESO DE MOVIL</h4>
            <style>
              .form-container {
                margin-top: 10px;
                background-color: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px #A0E3EB;
              }

              .form-title {
                color: #17A2B8;
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
                text-align: center;
              }
            </style>
            <section style="background-color: white;  padding: 20px;">
              <div class="col-12 row">

                <div class="container">
                  <div class=" justify-content-center">
                    <div class="col-md-12">
                      <div class="form-container">
                        <div class="form-title">Registro de Ingreso de Vehículo</div>
                        <br>


                        <form id="miFormulario">


                          <!-- <input type="hidden" name="prma_id" id="prma_id" /> --> <!-- Este debería tener el nuevo prma_id generado -->
                          <!-- <input type="hidden" name="unid_id" id="unid_id" /> -->
                          <!-- Turno -->
                          <div class="form-group text-left">
                            <div class="form-check form-check-right">
                              <input class="form-check-input" type="radio" name="turno" id="turnoMañana" value="mañana">
                              <label class="form-check-label" for="turnoMañana">Mañana</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="turno" id="turnoTarde" value="tarde">
                              <label class="form-check-label" for="turnoTarde">Tarde</label>
                            </div>
                          </div>

                          <!-- Fecha y Hora de Ingreso -->
                          <div class="form-group row -largecol-12">
                            <div class="col-6">
                              <div class="mt-2">
                                <label for="fechaIngreso">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="fechaIngreso">
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="mt-2">
                                <label for="horaIngreso">Hora de Ingreso</label>
                                <input type="time" class="form-control" id="horaIngreso">
                              </div>
                            </div>
                          </div>
                          <br>

                          <!-- Diagnóstico del Vehículo -->
                          <div class="form-group col-12">
                            <div class="mt-2">
                              <div class="row">
                                <label for="descripcion">Diagnóstico del Vehículo</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Describe el problema del vehículo"></textarea>
                              </div>
                            </div>
                          </div>
                          <br>

                          <!-- Estado de Ingreso del Vehículo -->
                          <div class="form-group col-9">
                            <div class="row">
                              <div class="col-4">
                                <label>Estado de Ingreso del Vehículo</label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <div class="mt-2">
                                  <input type="radio" name="estado" id="estadoActivo" value="Activo">
                                  <span class="status-label">Activo</span>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="mt-2">
                                  <input type="radio" name="estado" id="estadoInactivo" value="Inactivo">
                                  <span class="status-label">Inactivo</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <br>



                          <div class="col-lg-12">
                            <div class="form-group" style="position: relative;">
                              <label class="form-control-label">Unidad Movil: <span class="tx-danger">*</span></label>
                              <!-- Input para buscar en el datalist -->
                              <input list="unid_options" class="form-control" name="unid_id" id="unid_id" placeholder="Seleccione Unidad Movil" style="position: relative;">
                              <!-- Datalist con las opciones -->
                              <datalist id="unid_options" style="position: absolute; top: 100%; left: 0; width: 100%;">
                                <!-- Las opciones se cargarán dinámicamente con JavaScript -->
                              </datalist>
                            </div>
                          </div>
                          <br>
                          <div class="form-group row -largecol-12">
                            <div class="col-9">
                              <div class="mt-2">
                                <div class="row">
                                  <label for="descripcion">Diagnóstico Especializado</label>
                                  <textarea class="form-control" id="descripDiagnos" rows="1" placeholder="Diagnostico del vehiculo"></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="mt-2">
                                <label for="fechaIngreso">Fecha de Diagnostico</label>
                                <input type="date" class="form-control" id="fechaDiagnostico">
                              </div>
                            </div>
                          </div>



                          <br>
                          <!-- Botones del Modal -->
                          <div>
                            <button type="button" id="botonRegistrarMecanica" class="btn btn-oblong btn-outline-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="ModalProgMeca()">
                              <i class="fa fa-wrench"></i> Registrar Mecánica
                            </button>

                            <br>

                            <div class="modal-footer mx-auto">
                              <button id="botonGuardar" type="button" onclick="guardar()" class="btn btn-oblong btn-outline-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" disabled>
                                <i class="fa fa-check"></i> Guardar
                              </button>

                              <!--  <button type="button" id="cancelar" onclick="cancelar()" class="btn btn-oblong btn-outline-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-hidden="true">
                                <i class="fa fa-close"></i> Cancelar
                              </button> -->

                              <button type="button" id="cancelar" class="btn btn-oblong btn-outline-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="cancelar()">
                                <i class="fa fa-close"></i> Cancelar
                              </button>

                            </div>

                        </form>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </section>







            <h4>Componentes / Repuestos</h4>
            <section style="background-color: white;  padding: 20px;">
              <style>
                .form-section-title1 {
                  background-color: #17a2b8;
                  color: #fff;
                  padding: 10px;
                  border-radius: 5px;
                  margin-bottom: 15px;
                  text-transform: uppercase;
                  font-size: 18px;
                  font-weight: bold;
                }

                .form-label {
                  font-weight: bold;
                  color: #495057;
                }

                .btn-primary1 {
                  background-color: #007bff;
                  border-color: #007bff;
                  padding: 10px 20px;
                  font-size: 16px;
                  border-radius: 5px;
                }

                .btn-primary1:hover {
                  background-color: #0056b3;
                  border-color: #0056b3;
                }

                .row-spacing1 {
                  margin-bottom: 20px;
                }

                /* Estilo para select2 */
               
              </style>
              </head>

              <body>
                <div class="container mt-5">
                  <div class="form-container">
                    
                    <h5 class="text-center mb-4">Departamento de Servicios Internos</h5>
                    <form>
                      <!-- Información General -->
                      <div class="form-section-title1">Información General</div>
                      <div class="row row-spacing1">
                        <div class="col-md-3">
                          <label for="ticketNumber" class="form-label">N° de Ticket</label>
                          <input type="text" class="form-control" id="ticketNumber" placeholder="Ingrese N° de Ticket">
                        </div>
                        <div class="col-md-3">
                          <label for="fecha" class="form-label">Fecha</label>
                          <input type="date" class="form-control" id="fecha">
                        </div>
                        <div class="col-md-3">
                          <label for="turno" class="form-label">Turno</label>
                          <select class="form-control select2" style="width:100%" name="comb_id" id="comb_id">
                            <option value="">Seleccione Turno</option>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label for="vehiculo" class="form-label">Vehículo Destino</label>
                          <input type="text" class="form-control" id="vehiculo" placeholder="Ingrese Vehículo Destino">
                        </div>
                      </div>
<br>
                      <!-- Detalle de Lubricación -->
                      <div class="form-section-title1">Detalle de Lubricación</div>
                      <div class="row row-spacing1">
                        <div class="col-md-4">
                          <label for="aceite" class="form-label">Aceite</label>
                          <select class="form-control select2" id="aceite">
                            <option value="">Seleccione Tipo de Aceite</option>
                            <option value="15W40">15W40</option>
                            <option value="20W50">20W50</option>
                            <option value="25W50">25W50</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="hidrolina" class="form-label">Hidrolina</label>
                          <select class="form-control select2" id="hidrolina">
                            <option value="">Seleccione Hidrolina</option>
                            <option value="SAE 10">SAE 10</option>
                            <option value="SAE 68">SAE 68</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="aceiteTransmision" class="form-label">Aceite de Transmisión</label>
                          <select class="form-control select2" id="aceiteTransmision">
                            <option value="">Seleccione Aceite de Transmisión</option>
                            <option value="80W90">80W90</option>
                            <option value="85W140">85W140</option>
                          </select>
                        </div>
                      </div>

                      <div class="row row-spacing1">
                        <div class="col-md-4">
                          <label for="grasa" class="form-label">Grasa de Chasis</label>
                          <input type="text" class="form-control" id="grasa" placeholder="Ingrese Grasa de Chasis">
                        </div>
                        <div class="col-md-4">
                          <label for="liquidoFreno" class="form-label">Líquido de Freno</label>
                          <input type="text" class="form-control" id="liquidoFreno" placeholder="Ingrese Líquido de Freno">
                        </div>
                        <div class="col-md-4">
                          <label for="refrigerante" class="form-label">Refrigerante</label>
                          <input type="text" class="form-control" id="refrigerante" placeholder="Ingrese Refrigerante">
                        </div>
                      </div>
                      <br>

                      <!-- Información del Personal -->
                      <div class="form-section-title1">Información del Personal</div>
                      <div class="row row-spacing1">
                        <div class="col-md-4">
                          <label for="chofer" class="form-label">Chofer</label>
                          <input type="text" class="form-control" id="chofer" placeholder="Ingrese Nombre del Chofer">
                        </div>
                        <div class="col-md-4">
                          <label for="firma" class="form-label">Firma</label>
                          <input type="text" class="form-control" id="firma" placeholder="Ingrese Firma">
                        </div>
                        <div class="col-md-4">
                          <label for="lubricador" class="form-label">Lubricador</label>
                          <input type="text" class="form-control" id="lubricador" placeholder="Ingrese Nombre del Lubricador">
                        </div>
                      </div>

                      <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary1">Guardar</button>
                      </div>
                    </form>



                  </div>
                </div>



            </section>





            <h4>Payment Details</h4>
            <section>
              <p>The next and previous buttons help you to navigate through your content.</p>
            </section>
          </div>
        </div>
      </div>


    </div>

    <?php

    require_once("../Js/MainJs.php");
    require_once("nuevoMovilmodal.php");
    require_once("progMecanicoModal.php");


    ?>

    <script type="text/javascript" src="movil.js"></script>

  </body>

  </html>
<?php

} else {

  /* sino a iniciado session entonces lo redireccionara a la ruta principal */
  //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
  header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>