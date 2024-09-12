<div id="resgitrarmovil" class="modal fade " data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>



                <button type="reset" class="close" aria-label="Close" aria-hidden="true" data-dismiss="modal">
                    &times;
                </button>

            </div>
            <div class="modal-body">
                <form method="post" id="movil_form_modal" class="form row">
                    <input type="hidden" name="unid_id" id="unid_id" />


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label has-success">Tipo de Unidad : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="tiun_id" id="tiun_id"  style="text-transform:uppercase" required>
                                <option label="Seleccion Organizacion"></option>


                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Codigo: <span class="tx-danger">*</span></label>
                            <input class="form-control " id="unid_codigo" type="text" name="unid_codigo"    style="text-transform:uppercase" required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label has-success ">Marca : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="marc_id" id="marc_id" style="text-transform:uppercase" required>
                                <option label="Seleccion Organizacion"></option>


                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label has-success ">Modelo : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="mode_id" id="mode_id"  style="text-transform:uppercase" required>
                                <option label="Seleccion Organizacion"></option>


                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label has-success">Area de destino : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="depe_id" id="depe_id"  style="text-transform:uppercase" required>
                                <option label="Seleccion Organizacion"></option>


                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Placa de la Unidad: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="unid_placa" type="text" name="unid_placa"  style="text-transform:uppercase" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label has-success">Color : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="colo_id" id="colo_id"  style="text-transform:uppercase" required>
                                <option label="Seleccion Organizacion"></option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Año de la Unidad: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="unid_anio" type="date" name="unid_anio" style="text-transform:uppercase" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label ">Combustible : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 " style="width:100%" name="comb_id" id="comb_id"   style="text-transform:uppercase" required>
                            <option label="Seleccion Combustible"></option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Año de Adquisicion: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="unid_adquisicion" type="date" name="unid_adquisicion"  style="text-transform:uppercase" required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Motor: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="unid_motor" type="text" name="unid_motor"  style="text-transform:uppercase" required />
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Descripcion: <span class=""></span></label>
                            <textarea class="form-control" id="unid_observacion"  name="unid_observacion" style="text-transform:uppercase" requerid></textarea>
                        </div>
                    </div>


                    <div class="modal-footer mx-auto">
                        <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
                        <button type="submit" id="#" name="action" value="add" class="btn btn-outline-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                        <button type="reset" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>