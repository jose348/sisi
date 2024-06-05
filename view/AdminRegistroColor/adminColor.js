function init() {
    $("#color_form_modal").on("submit", function(e) {
        guardaryeditarColor(e);
    });
}

function guardaryeditarColor(e) {
    console.log("test");
    e.preventDefault();
    var formData = new FormData($("#color_form_modal")[0]);
    console.log(formData);
    $.ajax({
        url: "../../controller/color.php?op=guardaryeditarColor",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#color_data').DataTable().ajax.reload(); //para recargar mi tabla
            $('#modalcolor').modal('hide'); //para limpiar mi modal
            Swal.fire({
                title: 'Correcto',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}
$(document).ready(function() {

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
            url: "../../controller/color.php?op=listaColores", //ruta para recibir mi servicio que viene desde mi controller
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

    /* TODO PARA MI COLOR */
    /* TODO PARA MI COLOR */
    /* TODO PARA MI COLOR */
});


/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* cuando le demos editar nos llama al modal con la informacion cargada */
function editar(colo_id) {
    $.post("../../controller/color.php?op=mostrar", { colo_id: colo_id }, function(data) {
        data = JSON.parse(data);
        $('#colo_id').val(data.colo_id);
        $('#colo_descripcion').val(data.colo_descripcion);


    });
    $('#lbltitulo').html('Editar Registro'); //este para cambiarle el titulo al modal que clickeo en editar
    $('#modalcolor').modal('show'); //para traer mi modal
}
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */
/* AHORA FUNCION PARA EDITAR */




/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
/* AHORA FUNCION PARA ELIMINAR */
function eliminar(colo_id) { //tener encuenta que el cur_id viene de la sentencia eliminar
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/color.php?op=eliminar", { colo_id, colo_id }, function(data) { // eliminamos el registro 
                $('#color_data').DataTable().ajax.reload();
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

function nuevoColor() {
    $('#colo_id').val('');
    $('#lbltitulo').html('Nuevo Registro'); //esto solo aparecera cuando llame a nuevo registro como titulo
    $('#color_form_modal')[0].reset(); //limpiando cada uno de los datos
    $('#modalcolor').modal('show');
}


init();