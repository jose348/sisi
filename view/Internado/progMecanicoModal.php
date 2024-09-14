<!-- Modal para mostrar datos -->
<style>
  .titulo-personalizado {
    font-family: 'Arial', sans-serif;
    /* Cambia el tipo de letra */
    font-size: 1.5rem;
    /* Ajusta el tamaño de la fuente */
    color: #1D2939;
    /* Color azul Bootstrap */
    font-weight: bold;
    /* Negrita */
    text-align: center;
    /* Centra el texto */
    margin-top: 20px;
    /* Espacio superior */
    text-transform: uppercase;
    /* Texto en mayúsculas */
    border-bottom: 2px solid #007bff;
    /* Línea debajo del título */
    padding-bottom: 10px;
    /* Espacio debajo del texto */
  }
</style>

<div id="modalRegistrarMecanica" class="modal fade  " data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bd-0">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistrarMecanicaLabel">Programacion de Mantenimiento del Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí se mostrarán los datos -->
        <form id="miFormularioPrgEsp">
        <!-- <input type="hidden" name="prma_id" id="prma_id" /> -->
       <!--  <input type="hidden" name="unid_id" id="unid_id" /> -->

          <p id="datosUnidadMovil" class="titulo-personalizado"></p>

          <!-- Diagnóstico del Vehículo -->
          <div class="form-group row -largecol-12">
            <div class="col-12">
              <div class="mt-2">
                <label for="descripcion">Diagnóstico Inicial Vehículo</label>
                <textarea class="form-control" id="prma_diagnostico_inicial" rows="3" placeholder="Describe el problema del vehículo"></textarea>
              </div>
            </div>
            <br>

            <div class="form-group row -largecol-12">
              <div class="col-6">
                <div class="mt-2">
                  <label for="fechaIngreso">Fecha de Ingreso</label>
                  <input type="date" class="form-control" id="prma_fecha">
                </div>
              </div>
              <div class="col-6">
                <div class="mt-2">
                  <label for="horaIngreso">Hora de Ingreso</label>
                  <input type="time" class="form-control" id="prma_hora">
                </div>
              </div>
            </div>


          </div>
          <br>
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label has-success ">Especialidad De Mecanica:</label>
              <select class="form-control select2 is-warning" style="width:100%" name="esme_id" id="esme_id" data-placeholder="Seleccione" style="text-transform:uppercase">
                <option value=""  >Seleccion Especialidad</option>


              </select>
            </div>
          </div>


          <div class="modal-footer">
            <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
            <!-- Botón de Guardar dentro del modal -->
            <button type="button" id="guardarEnModal" onclick="guardarDatos()" class="btn btn-oblong btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
              <i class="fa fa-check"></i> Guardar
            </button>

            <button type="reset"class="btn btn-oblong btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal">
              <i class="fa fa-close"></i> Cancelar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>