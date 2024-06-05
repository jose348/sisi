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



    $("#marc_id").change(function() {
        $("#marc_id option:selected").each(function() {
            marc_id = $(this).val();
            combo_modelo2(marc_id); 
        });    
    });
    //combo_modelo();

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



/* 
TODO LLENANDO COMBO MODELO APARTIR DEL COMBO MARCA */

function combo_modelo2(marc_id) {

    $.ajax({
        url: "../../controller/movil.php?op=combo_modelo",
        type: "POST",
        data: { marc_id: marc_id },
        dataType: "html",
        success: function(data) {
            $('#mode_id').html(data);
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);     
        }    
    });
}





function tipo() {

    $('#modaltipo').modal('show');
}