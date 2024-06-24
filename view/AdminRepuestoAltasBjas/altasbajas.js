function init() {

}
$(document).ready(function() {


    $('#repu_estado').select2();




    $('#repu_estado').change(function() {
        $("#repu_estado option:selected").each(function() { /* con estas lineas capturamos nuestro id de nuestro combo */
            repu_estado = $(this).val(); //con el id captrado traemos los datos para mi tabla


            /* Listado de datatable */
            $('#baja_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [


                ],
                "ajax": {
                    url: "../../controller/repuesto.php?op=listar_altas_bajas",
                    type: "post",
                    data: { repu_estado: repu_estado },

                },
                "bDestroy": true,
                "responsive": true,
                "bInfo": true,
                "iDisplayLength": 10,
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

        });
    });



    $('#baja_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [

        ],
        "ajax": {
            url: "../../controller/repuesto.php?op=listar_bajas",
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
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
});

function daralta(repu_id) {
    swal.fire({
        title: "Dar Alta",
        text: "Deseas dar Alta al Registro ?",
        icon: "warning",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/repuesto.php?op=daralta", { repu_id, repu_id }, function(data) { // eliminamos el registro 
                $('#baja_data').DataTable().ajax.reload();
                swal.fire({
                    title: 'Correcto',
                    text: 'Se dio de Baja Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}



function darbaja(repu_id) {
    swal.fire({
        title: "Dar Baja",
        text: "Deseas dar Baja al Registro ?",
        icon: "warning",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/repuesto.php?op=darbaja", { repu_id, repu_id }, function(data) { // eliminamos el registro 
                $('#baja_data').DataTable().ajax.reload();
                swal.fire({
                    title: 'Correcto',
                    text: 'Se dio de Baja Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}



function combo_bajaAlta() {
    $.post("../../controller/repuesto.php?comboaltabaja", function(data) {
        $('#repu_estado').html(data);
    });
}

function recargar() {
    $('#baja_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [

        ],
        "ajax": {
            url: "../../controller/repuesto.php?op=listar_bajas",
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
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

}

init();