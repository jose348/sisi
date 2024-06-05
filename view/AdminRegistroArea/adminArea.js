function init() {

}
$(document).ready(function() {

    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */
    $('#area_data').DataTable({ //llamamos el nombre de la tabla

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
            url: "../../controller/area.php?op=listaArea", //ruta para recibir mi servicio que viene desde mi controller
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
    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */
    /* TODO PARA MI AREA */



});


/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
function eliminar(depe_id) { //tener encuenta que el cur_id viene de la sentencia eliminar
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/area.php?op=eliminarArea", { depe_id, depe_id }, function(data) { // eliminamos el registro 
                $('#area_data').DataTable().ajax.reload();
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


function nuevoArea() {
    $('#modalarea').modal('show');
}

init();