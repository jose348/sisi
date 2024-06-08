function init() {
    $("#modelo_form_modal").on("submit", function(e) {
        guardaryeditarModelo(e);
    });
}

function guardaryeditarModelo(e) {
    console.log("test");
    e.preventDefault();
    var formData = new FormData($("#modelo_form_modal")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controller/modelo.php?op=guardaryeditarModelo",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#modelo_data').DataTable().ajax.reload(); //para recargar mi tabla
            $('#modalmodelo').modal('hide'); //para limpiar mi modal
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

    $('#marc_id').select2({
        dropdownParent: $('#modelo_form_modal')
    });

    combo_marca();


    /* TODO PARA MI TIPO DE MODELO */
    /* TODO PARA MI TIPO DE MODELO */
    /* TODO PARA MI TIPO DE MODELO */

    $('#modelo_data').DataTable({ //llamamos el nombre de la tabla

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
            url: "../../controller/modelo.php?op=listaModelo", //ruta para recibir mi servicio que viene desde mi controller
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

    /* TODO PARA MI TIPO DE MODELO */
    /* TODO PARA MI TIPO DE MODELO */
    /* TODO PARA MI TIPO DE MODELO */



});




/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* cuando le demos editar nos llama al modal con la informacion cargada */
function editar(mode_id) {
    $.post("../../controller/modelo.php?op=mostrarModelo", { mode_id: mode_id }, function(data) {
        data = JSON.parse(data);
        $('#mode_id').val(data.mode_id);
        $('#mode_descripcion').val(data.mode_descripcion);

        $('#marc_id').val(data.marc_id).trigger('change');


    });
    $('#lbltitulo').html('Editar Registro'); //este para cambiarle el titulo al modal que clickeo en editar
    $('#modalmodelo').modal('show'); //para traer mi modal
}


function combo_marca() {
    $.post("../../controller/modelo.php?op=combo_marca", function(data) {
        $('#marc_id').html(data);
    });

}

/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
function eliminar(mode_id) { //tener encuenta que el cur_id viene de la sentencia eliminar
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/modelo.php?op=eliminar", { mode_id, mode_id }, function(data) { // eliminamos el registro 
                $('#modelo_data').DataTable().ajax.reload();
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


function nuevoModelo() {

    $('#mode_id').val('');
    $('#lbltitulo').html('Nuevo Registro');
    $('#modelo_form_modal')[0].reset();
    combo_marca();
    $('#modalmodelo').modal('show');
}
init();