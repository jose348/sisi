<div id="modalarea" class="modal fade  " data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>



                <button type="reset" class="close" aria-label="Close" aria-hidden="true" data-dismiss="modal">
                    &times;
                </button>

            </div>
            <div class="modal-body">
                <form method="post" id="area_form_modal" class="form row">
                    <input type="hidden" name="depe_id" id="depe_id" /> 


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_denominacion" type="text" name="depe_denominacion" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Codigo Del Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_codigo" type="text" name="depe_codigo" style="text-transform:uppercase"  required />
                        </div>
                    </div>
                    

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Abreviatura Del Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_abreviatura" type="text" name="depe_abreviatura" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Sigala de Documento del Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_siglasdoc" type="text" name="depe_siglasdoc" style="text-transform:uppercase"  required />
                        </div>
                    </div>
                    

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Nombre del Representante: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_representante" type="text" name="depe_representante" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Cargo del Representante: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_cargo" type="text" name="depe_cargo" style="text-transform:uppercase"  required />
                        </div>
                    </div>
    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Direccion del Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_direccion" type="text" name="depe_direccion" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Telefono del Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_telefono" type="number" name="depe_telefono" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Anexo del Area: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_anexo" type="number" name="depe_anexo" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Funciones (ROF)- codigo: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_codrof" type="text" name="depe_codrof" style="text-transform:uppercase"  required />
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Area Superior: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="depe_superior" type="text" name="depe_superior" style="text-transform:uppercase"  required />
                        </div>
                    </div>

                    <div class="col-lg-3">
                    <div class="form-group">
                            <label class="form-control-label has-success text text-danger">Estado : <span class="tx-danger">*</span></label>
                            <select class="form-control  is-warning" style="width:100%" name="depe_estado" id="depe_estado" data-placeholder="Seleccione">
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>

                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-3">
                    <div class="form-group">
                            <label class="form-control-label has-success text text-danger">Unidad : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="tpde_id" id="tpde_id" data-placeholder="Seleccione">
                                <option label="Seleccion Organizacion"></option>
                                

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                    <div class="form-group">
                            <label class="form-control-label has-success text text-danger">Nivel Organizacional : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="nior_id" id="nior_id" data-placeholder="Seleccione">
                                <option label="Seleccion Organizacion"></option>
                                

                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                    <div class="form-group">
                            <label class="form-control-label has-success text text-danger">Tipo de Organo : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="tpor_id" id="tpor_id" data-placeholder="Seleccione">
                                <option label="Seleccion Organizacion"></option>
                                

                            </select>
                        </div>
                    </div>


                    

                    <div class="col-lg-6">
                    <div class="form-group">
                            <label class="form-control-label has-success text text-danger">Local Municipal : <span class="tx-danger">*</span></label>
                            <select class="form-control select2 is-warning" style="width:100%" name="lomu_id" id="lomu_id" data-placeholder="Seleccione">
                                <option label="Seleccion Organizacion"></option>
                                

                            </select>
                        </div>
                        </div>

                    <div class="modal-footer mx-auto">
                        <!-- para guardar en el boton guardar dentro de mi modal, aqui le agregamos el name y un value -->
                        <button type="submit" id="#" name="action" value="add" class="btn btn-outline-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                        <button type="reset" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>