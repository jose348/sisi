function init() {}

document.addEventListener("DOMContentLoaded", function() {
    // Función para mostrar/ocultar botones de acciones
    $('.toggle-buttons').on('click', function() {
        $('.acciones').toggleClass('ocultar');
    });
});





$(document).ready(function() {

    combo_marca_unidad_busquedad();
    combo_modelo_unidad_busquedad;
    combo_tipo_unidad_busquedad();

});

// Funciones para cargar combos
function combo_tipo_unidad_busquedad() {
    $.post("../../controller/intermovilregistro.php?op=combo_tipo_unidad_busquedad", function(data) {
        $('#tiun_id').html(data);
    });
}

function combo_modelo_unidad_busquedad() {
    $.post("../../controller/intermovilregistro.php?op=combo_modelo_busquedad", function(data) {
        $('#mode_id1').html(data);
    });
}

function combo_marca_unidad_busquedad() {
    $.post("../../controller/intermovilregistro.php?op=combo_marca_busquedad", function(data) {
        $('#marc_id').html(data);
    });
}








init();