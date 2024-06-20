<div id="modalUnidadMedida" class="modal fade  " data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0 rounded-10">
            <div class="modal-body pd-0">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>



                    <button type="reset" class="close" aria-label="Close" aria-hidden="true" data-dismiss="modal">
                        &times;
                    </button>

                </div>
                <div class="modal-body">
                    <form method="post" id="unidadmedida_form" class="form row">
                        <input type="hidden" name="unme_id" id="unme_id" />

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Codigo de Unidad de Medida : <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="unme_codigo" type="text" name="unme_codigo" required />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Nombre de Unidad de Medida: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="unme_descripcion" type="text" name="unme_descripcion" required />
                            </div>
                        </div>



                        <div class="col-12">
                                <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
                                <center><button type="submit" id="#" name="action" value="add" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                                <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                                </center>
                            </div>
                    </form>
                </div>

            </div><!-- modal-body -->

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->