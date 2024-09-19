<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1></h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario dentro del modal con 2 columnas -->
        <form class="container-fluid ">
        <h5 class="modal-title" id="ticketModalLabel"> Solicitud de Lubricante e Insumos / Urea Automotriz </h5>
          <div class="row">
          
            <div class="col-12">
              <div class="form-group">
                <label for="modalNumero">N° de Ticket</label>
                <input type="text" class="form-control form-control-lg" id="modalNumero" placeholder="Ingrese el N° de Ticket" disabled>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="modalUnidad">Unidad</label>
                <input type="text" class="form-control form-control-lg" id="modalUnidad" placeholder="Unidad seleccionada" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modalFecha">Fecha</label>
                <input type="date" class="form-control form-control-lg" id="modalFecha">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="modalTipoInsumo">Tipo de Insumo</label>
                <input type="text" class="form-control form-control-lg" id="modalTipoInsumo" placeholder="Ingrese el tipo de insumo">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modalHora">Hora</label>
                <input type="time" class="form-control form-control-lg" id="modalHora">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="modalSolicitador">Solicitador</label>
                <input type="text" class="form-control form-control-lg" id="modalSolicitador" placeholder="Ingrese el nombre del solicitador">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>