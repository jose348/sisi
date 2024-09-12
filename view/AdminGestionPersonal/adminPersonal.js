function actualizar_cargo(event) {
    // Prevent the form from submitting and the page from reloading
    event.preventDefault();

    var carg_id = $('#combo_cargo').val();
    var pers_id = $('#idpersona1').text();

    $.post("../../controller/personal.php?op=update_personal", { pers_id: pers_id, carg_id: carg_id }, function(data) {
        cargarData();
        $.post("../../controller/personal.php?op=mostrarPersonalEditar", { pers_id: pers_id }, function(data) { /* llamamos a nuestro controlado lo que esta el case*/

            data = JSON.parse(data);
            //console.log(data); //consumimos el resultado en este caso es el id y lo muestra en json
            $('#idpersona1').text(data.pers_id);
            $('#nombre_persona1').text(data.nombre_persona);
            $('#pers_dni1').text(data.pers_dni);
            $('#depe_id1').text(data.depe_id);
            $('#depe_denominacion1').text(data.depe_denominacion);
            $('#carg_id1').text(data.carg_id);
            $('#carg_denominacion1').text(data.carg_denominacion);
            $('#perf_nombre1').text(data.perf_nombre);
            $('#sist_id1').text(data.sist_id);
            $('#sist_denominacion1').text(data.sist_denominacion);
            $('#perm_fechacrea1').text(data.perm_fechacrea);

            console.log(data);
        });
        Swal.fire({
            title: 'Correcto',
            text: 'Se registró correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    }).fail(function() {
        Swal.fire({
            title: 'Error',
            text: 'No se pudo registrar',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
}


function actualizar_perfil(event) {
    // Prevent the form from submitting and the page from reloading
    event.preventDefault();

    var perf_id = $('#combo_perfil').val();
    var pers_id = $('#idpersona1').text();

    $.post("../../controller/personal.php?op=update_personal_update", { pers_id: pers_id, perf_id: perf_id }, function(data) {
        cargarData();
        $.post("../../controller/personal.php?op=mostrarPersonalEditar", { pers_id: pers_id }, function(data) { /* llamamos a nuestro controlado lo que esta el case*/

            data = JSON.parse(data);
            //console.log(data); //consumimos el resultado en este caso es el id y lo muestra en json
            $('#idpersona1').text(data.pers_id);
            $('#nombre_persona1').text(data.nombre_persona);
            $('#pers_dni1').text(data.pers_dni);
            $('#depe_id1').text(data.depe_id);
            $('#depe_denominacion1').text(data.depe_denominacion);
            $('#carg_id1').text(data.carg_id);
            $('#carg_denominacion1').text(data.carg_denominacion);
            $('#perf_nombre1').text(data.perf_nombre);
            $('#sist_id1').text(data.sist_id);
            $('#sist_denominacion1').text(data.sist_denominacion);
            $('#perm_fechacrea1').text(data.perm_fechacrea);

            console.log(data);
        });
        Swal.fire({
            title: 'Correcto',
            text: 'Se registró correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    }).fail(function() {
        Swal.fire({
            title: 'Error',
            text: 'No se pudo registrar',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
}





$(document).ready(function() {

    /* TODO COMBO PARA CARGOS DEL PERSONAL*/

    $('#combo_cargo').select2({
        dropdownParent: $('#personal_form_modal')
    });
    combo_cargo();

    $('#combo_perfil').select2({
        dropdownParent: $('#personal_form_modal')
    });
    combo_perfil();
    cargarData();
});


function cargarData() {
    $('#personal_data').DataTable({ //llamamos el nombre de la tabla

        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [

        ],
        /* LLAMANDO LOS DATOS DE MI Controller / usuario osea mi json -- 
           de este codigo case "listar_cursos": */


        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */
        "ajax": {
            url: "../../controller/personal.php?op=listarPersonal", //ruta para recibir mi servicio que viene desde mi controller
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
            "sSearch": "Buscar Personal:",
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
}

function ver(pers_id) {

    $('#titulo').html('Datos del Trabajador');

    $('#modalpersonal').modal('show');


    $.post("../../controller/personal.php?op=mostrarPersonal", { pers_id: pers_id }, function(data) { /* llamamos a nuestro controlado lo que esta el case*/

        data = JSON.parse(data);
        //console.log(data); //consumimos el resultado en este caso es el id y lo muestra en json
        $('#idpersona').text(data.pers_id);
        $('#nombre_persona').text(data.nombre_persona);
        $('#pers_dni').text(data.pers_dni);
        $('#depe_id').text(data.depe_id);
        $('#depe_denominacion').text(data.depe_denominacion);
        $('#carg_id').text(data.carg_id);
        $('#carg_denominacion').text(data.carg_denominacion);
        $('#perf_nombre').text(data.perf_nombre);
        $('#sist_id').text(data.sist_id);
        $('#sist_denominacion').text(data.sist_denominacion);
        $('#perm_fechacrea').text(data.perm_fechacrea);

        console.log(data);
    });
}

function edit(pers_id) {

    $('#combo_cargo').select2({
        dropdownParent: $('#personal_form_modal')
    });
    combo_cargo();

    $('#combo_perfil').select2({
        dropdownParent: $('#personal_form_modal')
    });
    combo_perfil();

    $('#lblTitutloedit').html('Editar Cargo del Trabajador');

    $('#modelaEdi').modal('show');


    $.post("../../controller/personal.php?op=mostrarPersonalEditar", { pers_id: pers_id }, function(data) { /* llamamos a nuestro controlado lo que esta el case*/

        data = JSON.parse(data);
        //console.log(data); //consumimos el resultado en este caso es el id y lo muestra en json
        $('#idpersona1').text(data.pers_id);
        $('#nombre_persona1').text(data.nombre_persona);
        $('#pers_dni1').text(data.pers_dni);
        $('#depe_id1').text(data.depe_id);
        $('#depe_denominacion1').text(data.depe_denominacion);
        $('#carg_id1').text(data.carg_id);
        $('#carg_denominacion1').text(data.carg_denominacion);
        $('#perf_nombre1').text(data.perf_nombre);
        $('#sist_id1').text(data.sist_id);
        $('#sist_denominacion1').text(data.sist_denominacion);
        $('#perm_fechacrea1').text(data.perm_fechacrea);

        console.log(data);
    });
}


function combo_cargo() {
    $.post("../../controller/personal.php?op=combo_cargo", function(data) {
        $('#combo_cargo').html(data);
    });
}


function combo_perfil() {
    $.post("../../controller/personal.php?op=combo_perfil", function(data) {
        $('#combo_perfil').html(data);
    });

}

function eliminar(pers_id) {
    swal.fire({
        title: "Dar de Baja",
        text: "Deseas Dar de Baja al Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/personal.php?op=dar_baja_personal", { pers_id, pers_id }, function(data) { // eliminamos el registro 
                $('#personal_data').DataTable().ajax.reload();
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