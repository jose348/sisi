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
    $('#medida_data').DataTable({
        "processing": true,
        "serverSide": true, // Asegura que esta opción esté habilitada
        "ajax": {
            "url": "../../controller/repuesto.php?op=listaUmedida", // Asegúrate de que la URL es correcta
            "type": "POST"
        },
        "bDestroy": true,
        "responsive": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
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