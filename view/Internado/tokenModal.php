<!-- Modal -->
<div class="modal fade" id="tokenModal" tabindex="-1" role="dialog" aria-labelledby="tokenModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tokenModalLabel">Mi Token</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para cambiar contraseña -->
        <form id="changePasswordForm">
          

          <div class="form-group">
            <label for="currentPassword">Contraseña Actual</label>
            <input type="password" class="form-control" id="token_actual" placeholder="Ingrese su contraseña actual" required>
          </div>
          <div class="form-group">
            <label for="newPassword">Nueva Contraseña</label>
            <input type="password" class="form-control" id="token_nuevo" placeholder="Ingrese su nueva contraseña" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="token_confirma" placeholder="Confirme su nueva contraseña" required>
          </div>
        </form>

        <hr>

        <!-- Sección para recuperar contraseña -->
        
      </div>
      <div class="modal-footer row block">
      <input type="hidden" id="direct_id" name="direct_id">
        <button type="button" class="col-12 btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="col-12 btn btn-primary btn-block" onclick="cambiarToken()">Cambiar Contraseña</button>
        
      </div>
    </div>
  </div>
</div>