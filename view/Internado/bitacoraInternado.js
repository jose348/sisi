function init() {}



$(document).ready(function() {

    var table = $('#bitacoraTable').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [],
        "searching": false,
        "ajax": {
            url: "../../controller/bita.php?op=listar_bitacora",
            type: "post",
            data: function(d) {
                d.tiun_id = $('#tiun_id').val();
                d.mode_id = $('#mode_id').val();
                d.marc_id = $('#marc_id').val();
                d.placaUnidad = $('#placaUnidad').val(); // Valor de placaUnidad
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
            }
        }
    });

    // Botón de búsqueda
    $('#btnBuscar').on('click', function() {
        table.ajax.reload(); // Recargar la tabla con los nuevos datos
    });




    // Generar reporte en PDF
    $('#btnGenerarPDF').on('click', function() {
        var tiun_id = $('#tiun_id').val();
        var mode_id = $('#mode_id').val();
        var marc_id = $('#marc_id').val();
        var placaUnidad = $('#placaUnidad').val();
        var fechaDesde = $('#fechaDesde').val();
        var fechaHasta = $('#fechaHasta').val();

        // Redirigir a la ruta para generar el reporte en PDF
        window.open(`../../controller/bita.php?op=generar_reporte_pdf&tiun_id=${tiun_id}&mode_id=${mode_id}&marc_id=${marc_id}&placaUnidad=${placaUnidad}&fechaDesde=${fechaDesde}&fechaHasta=${fechaHasta}`, '_blank');
    });

    // Generar reporte en Excel
    $('#btnGenerarExcel').on('click', function() {
        var tiun_id = $('#tiun_id').val();
        var mode_id = $('#mode_id').val();
        var marc_id = $('#marc_id').val();
        var placaUnidad = $('#placaUnidad').val();
        var fechaDesde = $('#fechaDesde').val();
        var fechaHasta = $('#fechaHasta').val();

        // Redirigir a la ruta para generar el reporte en Excel
        window.open(`../../controller/bita.php?op=generar_reporte_excel&tiun_id=${tiun_id}&mode_id=${mode_id}&marc_id=${marc_id}&placaUnidad=${placaUnidad}&fechaDesde=${fechaDesde}&fechaHasta=${fechaHasta}`, '_blank');
    });








    // Llenar los combos
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