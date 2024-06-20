<div id="modalRepuesto" class="modal fade  " data-backdrop="static" data-keyboard="false">
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
                    <form method="post" id="repuesto_form" class="form row">
                        <input type="hidden" name="repu_id" id="repu_id" />

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Codigo Repuesto: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_codigo" type="text" name="repu_codigo" required />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Repuesto: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_descripcion" type="text" name="repu_descripcion" required />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Responsable de Almacen: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" style="width:100%" name="alma_id" id="alma_id">
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Unidad de Medida: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" style="width:100%" name="unme_id" id="unme_id" data-placeholder="Seleccione" required>
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Stock: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_stock" min="0" type="number" name="repu_stock" required />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Precio Unitario: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_precio_unitario" type="long" name="repu_precio_unitario" required />
                            </div>
                        </div>
                        <!--  <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Utimo Stock Ingresado: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_stock_ultimo_ingreso" type="number" name="repu_stock_ultimo_ingreso" value="" readonly />
                            </div>
                        </div> -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Ultimo Ingreso de Repuesto: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-uppercase" id="repu_ultimo_ingreso" type="date" name="repu_ultimo_ingreso" required />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Situeacion del Repuesto: <span class="tx-danger">*</span></label>
                                <select class="form-control " style="width:100%" name="repu_situacion" id="repu_situacion" required>
                                <option label="Seleccione"></option>
                                <option value="A">ACTIVO</option>
                                <option value="M">MALOGRADO</option>
                                <option value="T">TALLER</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-12">
                            <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
                            <center><button type="submit" id="#" name="action" value="add" class="btn btn-outline-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                            <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                            </center>
                        </div>
                    </form>
                </div>

            </div><!-- modal-body -->

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->