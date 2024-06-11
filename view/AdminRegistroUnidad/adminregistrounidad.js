function init() {

}



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





function modaltipo() {

    $('#modaltipo').modal('show');
}

function modalmarca() {
    $('#modalmarca').modal('show');
}

function modalmodelo() {
    $('#modalmodelo').modal('show');


    var combo = document.getElementById("marc_id"); // Reemplaza "producto" con el ID de tu combobox
    var selectedValue = combo.value; // se guarda el id del combo

    var selectedText = combo.options[combo.selectedIndex].text;

    var input = document.getElementById("marcmod_id"); // Reemplaza "txt" con el ID de tu input
    input.value = selectedText;


}









/* TODO PARA MI AREA */
/* TODO PARA MI AREA */
/* TODO PARA MI AREA */

$(function() {
    'use strict';

    $('#datatable1').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    });

    $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
    });

    // Select2
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
});


init();