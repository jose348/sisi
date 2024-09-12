function init() {}

document.addEventListener("DOMContentLoaded", function() {
    // Función para mostrar/ocultar botones de acciones
    $('.toggle-buttons').on('click', function() {
        $('.acciones').toggleClass('ocultar');
    });
});

$(document).ready(function() {
    $('#tiun_id').select2({
        dropdownParent: $('#formBusqueda')
    });
    combo_tipo_unidad_busquedad();

    $('#mode_id').select2({
        dropdownParent: $('#formBusqueda')
    });
    combo_modelo_unidad_busquedad();

    $('#marc_id').select2({
        dropdownParent: $('#formBusqueda')
    });
    combo_marca_unidad_busquedad();



    // Inicializamos DataTables y cargamos los datos desde el controlador
    $('#bitacoraTable').DataTable({




        "aProcessing": true,
        "aServerSide": true,
        "searching": false,
        dom: 'Bfrtip',
        buttons: [


        ],
        "ajax": {
            "url": "../../controller/intermovilregistro.php?op=listar_bitacora", // URL del controlador
            "type": "GET"
        },


        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5,
        "searching": false,
        "order ": [
            [5, "  desc "]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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
})





function combo_tipo_unidad_busquedad() {
    $.post("../../controller/intermovilregistro.php?op=combo_tipo_unidad_busquedad", function(data) {
        $('#tiun_id').html(data);
    });
}

function combo_modelo_unidad_busquedad() {
    $.post("../../controller/intermovilregistro.php?op=combo_modelo_busquedad", function(data) {
        $('#mode_id').html(data);
    });
}

function combo_marca_unidad_busquedad() {
    $.post("../../controller/intermovilregistro.php?op=combo_marca_busquedad", function(data) {
        $('#marc_id').html(data);
    });
}
init();