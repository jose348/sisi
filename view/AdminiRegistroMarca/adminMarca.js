function init() {
    $("#marca_form_modal").on("submit", function(e) {
        guardaryeditarMarca(e);
    });
}

function guardaryeditarMarca(e) {
    e.preventDefault();
    var formData = new FormData($("#marca_form_modal")[0]);
    $.ajax({
        url: "../../controller/marca.php?op=guardaryeditarMarca",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

            $('#marca_data').DataTable().ajax.reload();
            $('#modalmarca').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function() {

    /* TODO COMBO MARCA */
    $('#marc_combo').select2({
        dropdownParent: $('#modalmarca')
    });


    combo_marca();



    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
    $('#marca_data').DataTable({ //llamamos el nombre de la tabla

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
            url: "../../controller/marca.php?op=listaMarca", //ruta para recibir mi servicio que viene desde mi controller
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

    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
});



/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* cuando le demos editar nos llama al modal con la informacion cargada */
function editar(marc_id) {
    $.post("../../controller/marca.php?op=mostrarMarca", { marc_id: marc_id }, function(data) {
        data = JSON.parse(data);
        $('#marc_id').val(data.marc_id);
        $('#marc_descripcion').val(data.marc_descripcion);
        combo_marca();


    });
    $('#lbltitulo').html('Editar Registro'); //este para cambiarle el titulo al modal que clickeo en editar
    $('#modalmarca').modal('show'); //para traer mi modal
}
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */







/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
function eliminar(marc_id) { //tener encuenta que el marc_id viene de la sentencia eliminar
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/marca.php?op=eliminarMarca", { marc_id, marc_id }, function(data) { // eliminamos el registro 
                $('#marca_data').DataTable().ajax.reload();
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

function nuevaMarca() {
    $('#marc_id').val('');
    $('#lbltitulo').html('Nuevo Registro');
    combo_marca();
    $('#marca_form_modal')[0].reset();

    $('#modalmarca').modal('show');

}

function combo_marca() {
    $.post("../../controller/marca.php?op=combo_marca_modal", function(data) {
        $('#marc_combo').html(data);
    });
}





init();