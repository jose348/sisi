function init() {
    $("#area_form_modal").on("submit", function(e) {
        guardaryeditarArea(e);
    });
}



function guardaryeditarArea(e) {
    console.log("test");
    e.preventDefault();
    var formData = new FormData($("#area_form_modal")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controller/area.php?op=guardaryeditarArea",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#area_data').DataTable().ajax.reload(); //para recargar mi tabla
            $('#modalarea').modal('hide'); //para limpiar mi modal
            Swal.fire({
                title: 'Correcto',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}


$(document).ready(function() {
    $('#tpde_id').select2({
        dropdownParent: $('#area_form_modal')
    });
    combo_unidad();

    $('#nior_id').select2({
        dropdownParent: $('#area_form_modal')
    });
    combo_nivel_organizacional();

    $('#tpor_id').select2({
        dropdownParent: $('#area_form_modal')
    });
    combo_organo();


    $('#lomu_id').select2({
        dropdownParent: $('#area_form_modal')
    });
    combo_local_muni();


    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */
    $('#area_data').DataTable({ //llamamos el nombre de la tabla

        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        /* LLAMANDO LOS DATOS DE MI Controller / usuario osea mi json -- 
           de este codigo case "listar_cursos": */


        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */
        "ajax": {
            url: "../../controller/area.php?op=listaArea", //ruta para recibir mi servicio que viene desde mi controller
            type: "post" // tipo de envio 
                // data: { usu_id: usu_id }, //esta linea no porque en listar no tiene datos que enviar
        },
        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */


        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5, //filas a mostrar
        "order": [
            [0, "desc"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },

    });
    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */

});


/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
function eliminar(depe_id) { //tener encuenta que el cur_id viene de la sentencia eliminar
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/area.php?op=eliminarArea", { depe_id, depe_id }, function(data) { // eliminamos el registro 
                $('#area_data').DataTable().ajax.reload();
                swal.fire({
                    title: 'Correcto',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */



/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* cuando le demos editar nos llama al modal con la informacion cargada */
function editar(depe_id) {
    $.post("../../controller/area.php?op=mostrarArea", { depe_id: depe_id }, function(data) {
        data = JSON.parse(data);
        $('#depe_id').val(data.depe_id);
        $('#depe_denominacion').val(data.depe_denominacion);
        $('#depe_codigo').val(data.depe_codigo);
        $('#depe_abreviatura').val(data.depe_abreviatura);
        $('#depe_siglasdoc').val(data.depe_siglasdoc);
        $('#depe_representante').val(data.depe_representante);
        $('#depe_cargo').val(data.depe_cargo);
        $('#depe_direccion').val(data.depe_direccion);
        $('#depe_telefono').val(data.depe_telefono);
        $('#depe_anexo').val(data.depe_anexo);
        $('#depe_codrof').val(data.depe_codrof);
        $('#depe_superior').val(data.depe_superior);
        $('#depe_estado').val(data.depe_estado);
        $('#tpde_id').val(data.tpde_id).trigger('change');
        $('#nior_id').val(data.nior_id).trigger('change');
        $('#tpor_id').val(data.tpor_id).trigger('change');
        $('#lomu_id').val(data.lomu_id).trigger('change');

    });
    $('#lbltitulo').html('Editar Registro'); //este para cambiarle el titulo al modal que clickeo en editar
    $('#modalarea').modal('show'); //para traer mi modal
}
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */





/* TODO LLENAMOS LOS COMBOX */
/* TODO LLENAMOS LOS COMBOX */
/* TODO LLENAMOS LOS COMBOX */
/* TODO LLENAMOS LOS COMBOX */
function combo_unidad() {
    $.post("../../controller/area.php?op=combo_unidad", function(data) {
        $('#tpde_id').html(data);
    });
}

function combo_nivel_organizacional() {
    $.post("../../controller/area.php?op=combo_nivel_organizacional", function(data) {
        $('#nior_id').html(data);
    });
}

function combo_organo() {
    $.post("../../controller/area.php?op=combo_organo", function(data) {
        $('#tpor_id').html(data);
    });
}

function combo_local_muni() {
    $.post("../../controller/area.php?op=combo_local_muni", function(data) {
        $('#lomu_id').html(data);
    });
}
/* TODO LLENAMOS LOS COMBOX */
/* TODO LLENAMOS LOS COMBOX */
/* TODO LLENAMOS LOS COMBOX */
/* TODO LLENAMOS LOS COMBOX */







function nuevoArea() {
    $('#tpde_id').val('');
    $('#nior_id').val('');
    $('#tpor_id').val('');
    $('#lomu_id').val('');
    $('#lbltitulo').html('Nuevo Registro');
    combo_unidad();
    combo_nivel_organizacional();
    combo_organo();
    combo_local_muni();
    $('#area_form_modal')[0].reset();
    $('#modalarea').modal('show');
}

init();