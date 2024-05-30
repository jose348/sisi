$(document).ready(function() {
    $('#depe_id').select2({
        dropdownParent: $('#registroMovil')
    });
    combo_area();


    $('#marc_id').select2({
        dropdownParent: $('#registroMovil')

    });
    combo_marca();


    $('#tiun_id').select2({
        dropdownParent: $('#registroMovil')

    });
    combo_tipo();


    $('#colo_id').select2({
        dropdownParent: $('#registroMovil')
    });
    combo_color();

    $('#mode_id').select2({
        dropdownParent: $('#registroMovil')
    });
    combo_modelo();

});

function combo_area() {
    $.post("../../controller/movil.php?op=combo_area", function(data) {
        $('#depe_id').html(data);
    });
}

function combo_marca() {
    $.post("../../controller/movil.php?op=combo_marca", function(data) {
        $('#marc_id').html(data);
    });
}

function combo_tipo() {
    $.post("../../controller/movil.php?op=combo_tipo", function(data) {
        $('#tiun_id').html(data);
    });
}

function combo_color() {
    $.post("../../controller/movil.php?op=combo_color", function(data) {
        $('#colo_id').html(data);
    });
}

function combo_modelo() {
    $.post("../../controller/movil.php?op=modelo_por_id", function(data) {
        $('#mode_id').html(data);
    });
}


function tipo() {

    $('#modaltipo').modal('show');
}