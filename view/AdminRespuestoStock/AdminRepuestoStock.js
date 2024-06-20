function init() {}


$(document).ready(function() {
    $('#repu_descripcion').select2();
    combo_stock();

    $('#repu_descripcion').change(function() {
        $("#repu_descripcion option:selected").each(function() { /* con estas lineas capturamos nuestro id de nuestro combo */
            repu_descripcion = $(this).val(); //con el id captrado traemos los datos para mi tabla


            /* Listado de datatable */
            $('#stock_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax": {
                    url: "../../controller/repuesto.php?op=listar_repuestoStock",
                    type: "post",
                    data: { repu_descripcion: repu_descripcion },
                    /* le pasamos como parametro cur_id */
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


});

function combo_stock() {
    $.post("../../controller/repuesto.php?op=comboStockRespuesto", function(data) {
        $('#repu_descripcion').html(data);
    });
}
init();