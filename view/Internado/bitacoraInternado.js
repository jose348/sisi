function init() {}



$(document).ready(function() {

    // Inicialización del DataTable
    var table = $('#bitacoraTable').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [],
        "searching": true,
        "ajax": {
            url: "../../controller/bita.php?op=listar_bitacora",
            type: "post",
            data: function(d) {
                // Pasar los valores del formulario de búsqueda al backend
                d.tiun_id = $('#tiun_id').val();
                d.mode_id = $('#mode_id').val();
                d.marc_id = $('#marc_id').val();
                d.placaUnidad = $('#placaUnidad').val(); // Agregamos el valor de placaUnidad
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": false,
        "iDisplayLength": 5, // Número de filas a mostrar
        "order": [
            [0, "desc"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
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

    // Ejecutar la búsqueda cuando se cambie cualquier campo del formulario
    $('#tiun_id, #mode_id, #marc_id, #placaUnidad').on('change', function() {
        table.ajax.reload(); // Recargar la tabla con los nuevos datos
    });

    // Llenar combos
    $('#tiun_id').select2({
        dropdownParent: $('#formBusqueda')
    });
    combo_marca_unidad_busquedad();

    $('#mode_id').select2({
        dropdownParent: $('#formBusqueda')
    });
    combo_modelo_unidad_busquedad();

    $('#marc_id').select2({
        dropdownParent: $('#formBusqueda')
    });
    combo_tipo_unidad_busquedad();







});




// Funciones para cargar combos
function combo_tipo_unidad_busquedad() {
    $.post("../../controller/bita.php?op=combo_tipo_unidad_busquedad", function(data) {
        $('#tiun_id').html(data);
    });
}

function combo_modelo_unidad_busquedad() {
    $.post("../../controller/bita.php?op=combo_modelo_busquedad", function(data) {
        $('#mode_id').html(data);
    });
}

function combo_marca_unidad_busquedad() {
    $.post("../../controller/bita.php?op=combo_marca_busquedad", function(data) {
        $('#marc_id').html(data);
    });
}



/*TODO al hacer click en el boton ver */
$(document).on('click', '.ver-btn', function() {
    var unid_id = $(this).data('id');

    $.ajax({
        url: "../../controller/bita.php?op=get_historial_unidad",
        type: "POST",
        data: { unid_id: unid_id },
        success: function(response) {
            // Insertar el historial recibido en el modal
            $('#historialContent').html(response);

            // Mostrar el modal con el historial
            $('#modalHistorial').modal('show');
        }
    });
});




init();