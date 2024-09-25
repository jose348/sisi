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

          <p class="tx-16 tx-uppercase tx-spacing-1 mg-t-1 mg-b-2 tx-gray-600 text-center">
            INTERNAMIENTO DE VEHICULOS - MPCH - MECANICA
          </p>
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

                              <!-- Input con datalist -->
                              <input list="unid_options" class="form-control" name="unid_id" id="unid_id" placeholder="Seleccione Unidad Movil" onchange="updateVehiculoName()">

                              <!-- Datalist que se llenará con los vehículos desde el backend -->
                              <datalist id="unid_options">
                                <!-- Aquí se llenarán las opciones dinámicamente -->
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
                  background-color: #00B297;
                  color: #fff;
                  padding: 10px;
                  border-radius: 5px;
                  margin-bottom: 5px;
                  text-transform: uppercase;
                  font-size: 12px;
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


                /* Estilo personalizado para el botón con los colores que deseas */
                .btn-outline-custom {
                  background-color: transparent;
                  /* Transparente para mantener el estilo outline */
                  border: 2px solid #00B297;
                  /* Borde con el color personalizado */
                  color: #00B297;
                  /* Color del texto */
                }

                .btn-outline-custom:disabled {
                  background-color: transparent;
                  /* Transparente cuando está deshabilitado */
                  border-color: #a8dcd3;
                  /* Color de borde más claro cuando está deshabilitado */
                  color: #a8dcd3;
                  /* Texto más claro cuando está deshabilitado */
                }

                .btn-outline-custom:hover,
                .btn-outline-custom:focus {
                  background-color: #00B297;
                  /* Fondo del color personalizado cuando se pasa el mouse */
                  color: white;
                  /* Texto blanco cuando se pasa el mouse */
                  border-color: #00B297;
                  /* Borde del mismo color */
                }



                /* Estilo para select2 */
              </style>
              </head>


              <div class="container mt-5">
                <div class="form-container">

                  <h5 class="text-center mb-4 form-title">Departamento de Servicios Internos</h5>
                  <br>
                  <!-- Contenedor del formulario -->
                  <div class="row col-12">
                    <div class="row">
                      <!-- Botón de Solicitud de Mecánico -->


                      <button id="imprimirTicketButton" type="button" onclick="imprimirTicket()" class="btn btn-oblong btn-outline-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" disabled>
                        <i class="fa fa-print"></i> Imprimir Ticket
                      </button>


                    </div>
                  </div>

                  <br>


                  <form id="GernerarTicket">


                    <input type="hidden" id="id_unidad" name="id_unidad" disabled>


                    <div class="form-section-title1">Información General</div>
                    <br>
                    <div class="row row-spacing1">

                      <div class="col-md-3">
                        <label for="ticketNumber" class="form-label">N° de Ticket</label>
                        <input type="text" id="ticketNumber" name="ticketNumber" class="form-control" placeholder="Número de Ticket" disabled>
                      </div>

                      <div class="col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha">
                      </div>

                      <div class="col-md-3">
                        <label for="horaIngreso" class="form-label">Hora de Ingreso</label>
                        <input type="time" class="form-control" id="horaIngreso" name="horaIngreso">
                      </div>

                      <div class="col-md-3">
                        <label for="vehiculo" class="form-label">Vehículo</label>
                        <input type="text" class="form-control" id="vehiculo" name="vehiculo" placeholder="Vehículo" disabled>
                      </div>
                    </div>

                    <br>


                    <div class="form-section-title1">Detalle del Componente</div>
                    <br>
                    <div class="row row-spacing1">
                      <div class="col-md-4">
                        <label for="componente" class="form-label">Tipo de Componente</label>
                        <select class="form-control" name="componente" id="componente" data-placeholder="Seleccione">
                          <option value="">Seleccione Componente</option>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <label for="Componente_espec" class="form-label">Componente Específico</label>
                        <select class="form-control" name="Componente_espec" id="Componente_espec" data-placeholder="Seleccione" disabled>
                          <option value="">Seleccione Componente Específico</option>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese Cantidad" min="1" step="any">
                      </div>
                    </div>

                    <br>


                    <div class="form-section-title1">Información del Personal</div>
                    <br>
                    <div class="row row-spacing1">


                      <!-- Campo oculto para guardar el pers_id del chofer -->
                      <input type="hidden" id="pers_id" name="pers_id">



                      <div class="col-md-4">
                        <label for="dniChoferInput" class="form-label">Buscar Chofer por DNI</label>
                        <input oninput="buscarChoferPorDNI()" type="text" class="form-control" id="dniChoferInput" name="dniChoferInput" placeholder="Ingrese DNI del Chofer" maxlength="8">
                      </div>

                      <br>


                      <div class="col-md-4">
                        <label for="nombreChofer" class="form-label">Chofer</label>
                        <input type="text" class="form-control" id="nombreChofer" name="nombreChofer" placeholder="Nombre del Chofer" disabled>
                      </div>

                      <div class="col-md-4">
                        <label for="responsable" class="form-label">Responsable (lubricador / mecánico)</label>
                        <select class="form-control" id="responsable" name="responsable">
                          <option value="">Seleccione Responsable</option>

                        </select>
                      </div>

                      <br>


                      <div class="col-md-4">
                        <label for="token" class="form-label">Token</label>
                        <input oninput="confirmarToken()" type="password" class="form-control" id="token" name="token" placeholder="Ingrese Token">
                      </div>
                    </div>

                    <br>


                    <div class="mx-auto">
                      <button id="guardarButton" type="button" onclick="guardarFormulario()" class="btn btn-oblong btn-outline-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" disabled>
                        <i class="fa fa-save"></i> Guardar
                      </button>
                    </div>

                  </form>
                  
                </div>
              </div>
            </section>







            <h4>Vehiculo En Taller</h4>
            <section style="background-color: white;  padding: 20px;">

              <div class="container mt-5">

                <style>
                  .form-section-title1 {
                    background-color: #00B297;
                    color: #fff;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 5px;
                    text-transform: uppercase;
                    font-size: 12px;
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


                  /* Estilo personalizado para el botón con los colores que deseas */
                  .btn-outline-custom {
                    background-color: transparent;
                    /* Transparente para mantener el estilo outline */
                    border: 2px solid #00B297;
                    /* Borde con el color personalizado */
                    color: #00B297;
                    /* Color del texto */
                  }

                  .btn-outline-custom:disabled {
                    background-color: transparent;
                    /* Transparente cuando está deshabilitado */
                    border-color: #a8dcd3;
                    /* Color de borde más claro cuando está deshabilitado */
                    color: #a8dcd3;
                    /* Texto más claro cuando está deshabilitado */
                  }

                  .btn-outline-custom:hover,
                  .btn-outline-custom:focus {
                    background-color: #00B297;
                    /* Fondo del color personalizado cuando se pasa el mouse */
                    color: white;
                    /* Texto blanco cuando se pasa el mouse */
                    border-color: #00B297;
                    /* Borde del mismo color */
                  }
                </style>
                </head>

                <body>

                  <div class="container mt-5">
                    <div class="form-container">
                      <h2 class="form-title">Formulario de Mantenimiento</h2>
                      <form>
                        <!-- ID de Mantenimiento -->
                        <div class="mb-3">
                          <label for="mantId" class="form-label">ID de Mantenimiento</label>
                          <input type="number" class="form-control" id="mantId" placeholder="Ingrese ID de mantenimiento">
                        </div>

                        <!-- Fecha y Hora de Mantenimiento -->
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="mantFecha" class="form-label">Fecha de Mantenimiento</label>
                            <input type="date" class="form-control" id="mantFecha">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="mantHora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="mantHora">
                          </div>
                        </div>

                        <!-- Diagnóstico Especializado -->
                        <div class="mb-3">
                          <label for="diagnostico" class="form-label">Diagnóstico Especializado</label>
                          <textarea class="form-control" id="diagnostico" rows="3" placeholder="Describa el diagnóstico especializado"></textarea>
                        </div>

                        <!-- Acción Realizada -->
                        <div class="mb-3">
                          <label for="accionRealizada" class="form-label">Acción Realizada</label>
                          <textarea class="form-control" id="accionRealizada" rows="3" placeholder="Describa las acciones realizadas"></textarea>
                        </div>

                        <!-- Tipo de Acción y Mecánico Especialista -->
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="tipoAccion" class="form-label">Tipo de Acción</label>
                            <input type="number" class="form-control" id="tipoAccion" placeholder="Tipo de acción">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="mecanicoEspecialista" class="form-label">ID Mecánico Especialista</label>
                            <input type="number" class="form-control" id="mecanicoEspecialista" placeholder="ID del mecánico especialista">
                          </div>
                        </div>

                        <!-- Empresa Tercerizada -->
                        <div class="mb-3">
                          <label for="empresaTercerizada" class="form-label">Empresa Tercerizada</label>
                          <input type="text" class="form-control" id="empresaTercerizada" placeholder="Nombre de la empresa tercerizada">
                        </div>

                        <!-- Informe Tercerizado -->
                        <div class="mb-3">
                          <label for="informeTercerizado" class="form-label">Informe Tercerizado</label>
                          <textarea class="form-control" id="informeTercerizado" rows="3" placeholder="Informe tercerizado"></textarea>
                        </div>

                        <!-- Estado de Mantenimiento -->
                        <div class="mb-3">
                          <label for="estadoMantenimiento" class="form-label">Estado de Mantenimiento</label>
                          <input type="number" class="form-control" id="estadoMantenimiento" placeholder="Ingrese el estado de mantenimiento">
                        </div>

                        <!-- Foto de Ingreso y Salida de Unidad -->
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="fotoIngreso" class="form-label">Foto del Ingreso de la Unidad</label>
                            <input type="file" class="form-control" id="fotoIngreso" accept="image/*">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="fotoSalida" class="form-label">Foto de la Salida de la Unidad</label>
                            <input type="file" class="form-control" id="fotoSalida" accept="image/*">
                          </div>
                        </div>

                        <!-- Botón de Enviar -->
                        <button type="submit" class="btn btn-primary mt-4">Enviar</button>
                      </form>
                    </div>
                  </div>
            </section>
          </div>
        </div>
      </div>


    </div>

    <?php

    require_once("../Js/MainJs.php");
    require_once("nuevoMovilmodal.php");
    require_once("progMecanicoModal.php");
    require_once("ticketModal.php");


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