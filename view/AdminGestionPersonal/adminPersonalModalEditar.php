<div id="modelaEdi" class="modal fade  " data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lblTitutloedit" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>

                <button type="reset" class="close" aria-label="Close" aria-hidden="true" data-dismiss="modal">
                    &times;
                </button>

            </div>

            <div class="container row">


                <div class="col-12 mg-t-20">
                    <div class="col-12">
                        <div class="card shadow-base bd-0">
                            <form method="post" id="personal_form_modal" class="form row">
                                <table class="table table-responsive mg-b-0 tx-12">
                                    <thead>
                                        <tr class="tx-15">
                                            <th class="wd-10p pd-y-5">&nbsp;</th>
                                            <th class="pd-y-15 pd-x-20">User</th>
                                            <th class="pd-y-15 pd-x-20">Caracteristicas</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Id Persona</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-2">

                                                    <p id="idpersona1"></p>
                                                </div>

                                            </td>


                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Nombre</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="nombre_persona1"></p>
                                                </div>


                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Dni</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="pers_dni1"></p>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Id de Dependencia</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="depe_id1"></p>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Dependencia</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="depe_denominacion1"></p>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Id del Cargo</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="carg_id1"></p>

                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Cargo</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="carg_denominacion1"></p>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>
                                                            <select class="form-control" style="width:100%" name="combo_cargo" id="combo_cargo">
                                                                <option label="Seleccione"></option>

                                                            </select>

                                                        </div>
                                                        <button type="submit" onclick="actualizar_cargo(event)" class="btn btn-outline-warning tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium center-block">
                                                            <i class="fa fa-check"></i> Guardar
                                                        </button>


                                                    </div>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Perfil</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="perf_nombre1"></p>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Perfil: <span class="tx-danger">*</span></label>
                                                            <select class="form-control" style="width:100%" name="combo_perfil" id="combo_perfil">
                                                                <option label="Seleccione"></option>

                                                            </select>

                                                        </div>
                                                        <button type="submit" onclick="actualizar_perfil(event)" class="btn btn-outline-warning tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium center-block">
                                                            <i class="fa fa-check"></i> Guardar
                                                        </button>


                                                    </div>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Id del Sistema</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="sist_id1"></p>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Sistema</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="sist_denominacion1"></p>
                                                </div>

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="pd-l-20">
                                                <img src="http://via.placeholder.com/280x280" class="wd-10 rounded-circle" alt="Image">
                                            </td>
                                            <td>
                                                <a href="" class="tx-inverse tx-14 tx-medium d-block">Fecha de Creacion</a>

                                            </td>
                                            <td class="tx-12 row">
                                                <div class="col-1">
                                                    <span class="square-8 bg-success mg-r-5 rounded-circle "></span>

                                                </div>
                                                <div class="col-11">

                                                    <p id="perm_fechacrea1"></p>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal-footer">
                                    <center>
                                        <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium center-block" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br>


            </div>

        </div>
    </div>
</div>