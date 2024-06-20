function init() {
    $("#unidadmedida_form").on("submit", function(e) {
        guardaryeditar(e);
        $('#unidadmedida_form')[0].reset(); //limpiando cada uno de los datos

    });

}


function guardaryeditar(e) {

    e.preventDefault();
    var formData = new FormData($("#unidadmedida_form")[0]);
    $.ajax({
        url: "../../controller/repuesto.php?op=guardaryEditarunidadMedida",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

            $('#medida_data').DataTable().ajax.reload();
            $('#modalUnidadMedida').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar',

            })
        }

    });
}
$(document).ready(function() {
    $('#medida_data').DataTable({ //llamamos el nombre de la tabla

        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [

        ],
        /* LLAMANDO LOS DATOS DE MI Controller / usuario osea mi json -- 
           de este codigo case "listar_cursos": */


        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */
        "ajax": {
            url: "../../controller/repuesto.php?op=listaUmedida", //ruta para recibir mi servicio que viene desde mi controller
            type: "post" // tipo de envio 
                // data: { usu_id: usu_id }, //esta linea no porque en listar no tiene datos que enviar
        },
        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */


        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10, //filas a mostrar
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
        }

    });
});

function eliminar(unme_id) {

    swal.fire({
        title: "Eliminar",
        text: "¿Deseas eliminar el registro?",
        icon: "error",
        confirmButtonText: "Sí",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // Verificar si se hizo clic en el botón 'Sí'
        if (result.value) {
            $.post("../../controller/repuesto.php?op=eliminarMedida", { unme_id, unme_id }, function(data) {
                $('#medida_data').DataTable().ajax.reload(); // Recargar el DataTable después de eliminar
                swal.fire({
                    title: 'Correcto',
                    text: 'Se eliminó correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });     
        }    
    });
}



function editar(unme_id) {
    $.post("../../controller/repuesto.php?op=mostraUnidadMedida", { unme_id: unme_id }, function(data) {
        data = JSON.parse(data);
        $('#unme_id').val(data.unme_id);
        $('#unme_codigo').val(data.unme_codigo);
        $('#unme_descripcion').val(data.unme_descripcion);




    });
    $('#lbltitulo').html('Editar Registro'); //este para cambiarle el titulo al modal que clickeo en editar
    $('#modalUnidadMedida').modal('show'); //para traer mi modal
}

/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */

function nuevo() {
    $('#').val('');
    $('#lbltitulo').html('Nuevo Registro');

    $('#unidadmedida_form')[0].reset();

    $('#modalUnidadMedida').modal('show');
}


/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
/* TODO AHORA EL MANTRENIMIENTO DEL MODAL UnidadMedidaModal */
init();