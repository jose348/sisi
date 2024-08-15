function init() {}
$(document).ready(function() {

    $('#repu_id').select2({
        dropdownParent: $('#repu_form')
    });
    combo_repuesto();

    var deso_id = getUrlParameter('ID');



    $.post("../../controller/solicitud.php?op=mostrarSolicitud", { deso_id: deso_id }, function(data) {
        data = JSON.parse(data);
        $('#numsolici').html("SOLICITUD - N° " + data.sore_id);

        $('#fechsoli').html(data.sore_fecha);
        $('#lblestado').html(data.deso_estado);
        $('#sore_titulo').html(data.sore_titulo);
        $('#deso_cantidad').html(data.deso_cantidad);
        $('#sore_fecha').html(data.sore_fecha);
        $('#repu_descripcion').html(data.repu_descripcion);

        if (data.deso_cantidad_text != 1) {
            $('#atenderSolicitud').hide();
            $('#cerrarSolicitud').hide();
        }

    });


    /* TODO PARA RECARGAR LA LISTA DE MIS SOLICITUDES */

});


/* TODO Capturamos el ID que viene de mi solictud del mecanico deso_id en el boton (ver) */
/* TODO Capturamos el ID que viene de mi tabla consultar ticke_id en el boton (ver) */
/* TODO Capturamos el ID que viene de mi tabla consultar ticke_id en el boton (ver) */
/* captura el ID que viene por url de mi consultarTicket */
var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[i] === undefined ? true : sParameterName[1];
            }
        }
    }
    /* TODO Capturamos el ID que viene de mi tabla consultar ticke_id en el boton (ver) */
    /* TODO Capturamos el ID que viene de mi tabla consultar ticke_id en el boton (ver) */
    /* TODO Capturamos el ID que viene de mi tabla consultar ticke_id en el boton (ver) */


function combo_repuesto() {
    $.post("../../controller/solicitud.php?op=comboRepuesto", function(data) {
        $('#repu_id').html(data);
    });
}

$(document).on("click", "#cerrarSolicitud", function() {
    var deso_id = getUrlParameter('ID');
    swal.fire({
        title: "Rechazar",
        text: "Deseas Rechazar Solicitud?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/solicitud.php?op=rechazar", { deso_id: deso_id }, function(data) {
                $.post("../../controller/solicitud.php?op=mostrarSolicitud", { deso_id: deso_id }, function(data) {
                    data = JSON.parse(data);
                    $('#numsolici').html("SOLICITUD - N° " + data.sore_id);

                    $('#fechsoli').html(data.sore_fecha);
                    $('#lblestado').html(data.deso_estado);
                    $('#sore_titulo').html(data.sore_titulo);
                    $('#deso_cantidad').html(data.deso_cantidad);
                    $('#sore_fecha').html(data.sore_fecha);
                    $('#repu_descripcion').html(data.repu_descripcion);
                    if (data.deso_cantidad_text != 1) {
                        $('#atenderSolicitud').hide();


                    }
                });
                swal.fire({
                    title: 'Correcto',
                    text: 'Se Rechazo Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',


                })

            });


        }
    });


});

init();