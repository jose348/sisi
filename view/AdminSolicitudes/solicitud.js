function init() {

}


$(document).ready(function() {


    /*     function showMore() {
            const contenidoOculto = document.querySelector('.contenido-oculto');
            contenidoOculto.style.visibility = 'visible';
        } */

    $.post("../../controller/repuesto.php?op=mostarDetalleSolicitud", function(data) {

        $('#lblDetalle').html(data);
    });



});

function rechazar(sore_id) { //tener encuenta que el marc_id viene de la sentencia eliminar

    swal.fire({
        title: "Rechazar",
        text: "Deseas Cerrar la Solicitud ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/repuesto.php?op=rechazar", { sore_id, sore_id }, function(data) { // eliminamos el registro 
                $.post("../../controller/repuesto.php?op=mostarDetalleSolicitud", function(data) {

                    $('#lblDetalle').html(data);
                });
                swal.fire({
                    title: 'Correcto',
                    text: 'Se Cerro la Solicitud',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}

function atender(sore_id) {
    window.open('http://localhost/sisi/view/DetalleSolicitud/?ID=' + sore_id + " ");
}

init();