<div id="modalcolor" class="modal fade  " data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>



                <button type="reset" class="close" aria-label="Close" aria-hidden="true" data-dismiss="modal">
                    &times;
                </button>

            </div>
            <div class="modal-body">
                <form method="post" id="color_form_modal" class="form row">
                    <input type="hidden" name="colo_id" id="colo_id" /> 

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Color: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="colo_descripcion" type="text" name="colo_descripcion" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                     

                    <div class="modal-footer">
                        <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
                        <button type="submit" id="#" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                        <button type="reset" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>