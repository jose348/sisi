function init() {

}



$(document).ready(function() {











    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
    $('#marca_data').DataTable({ //llamamos el nombre de la tabla

        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        /* LLAMANDO LOS DATOS DE MI Controller / usuario osea mi json -- 
           de este codigo case "listar_cursos": */


        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */
        "ajax": {
            url: "../../controller/movil.php?op=listaMarca", //ruta para recibir mi servicio que viene desde mi controller
            type: "post" // tipo de envio 
                // data: { usu_id: usu_id }, //esta linea no porque en listar no tiene datos que enviar
        },
        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */


        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5, //filas a mostrar
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

    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */
    /* TODO PARA MI TIPO DE MARCA */








    /* TODO PARA MI COLOR */
    /* TODO PARA MI COLOR */
    /* TODO PARA MI COLOR*/

    $('#color_data').DataTable({ //llamamos el nombre de la tabla

        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        /* LLAMANDO LOS DATOS DE MI Controller / usuario osea mi json -- 
           de este codigo case "listar_cursos": */


        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */
        "ajax": {
            url: "../../controller/movil.php?op=listaColores", //ruta para recibir mi servicio que viene desde mi controller
            type: "post" // tipo de envio 
                // data: { usu_id: usu_id }, //esta linea no porque en listar no tiene datos que enviar
        },
        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */


        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5, //filas a mostrar
        "order": [
            [0, "asc"]
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

    /* TODO PARA MI COLOR */
    /* TODO PARA MI COLOR */
    /* TODO PARA MI COLOR */






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