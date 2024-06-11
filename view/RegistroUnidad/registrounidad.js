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
    $('#comb_id').select2({
        dropdownParent: $('#registroMovil')
    });
    combo_combustible();


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

function combo_combustible() {
    $.post("../../controller/movil.php?op=combo_combustible", function(data) {
        $('#comb_id').html(data);
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



/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
function eliminar(unid_id) { //tener encuenta que el cur_id viene de la sentencia eliminar
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/modelo.php?op=eliminar", { unid_id, unid_id }, function(data) { // eliminamos el registro 
                $('#gestionunidades_data').DataTable().ajax.reload();
                swal.fire({
                    title: 'Correcto',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */

function tipo() {

    $('#modaltipo').modal('show');
}
init();