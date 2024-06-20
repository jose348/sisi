function init() {
    $("#repuesto_form").on("submit", function(e) {
        guardaryeditar(e);
        $('#repuesto_form')[0].reset(); //limpiando cada uno de los datos
        combo_resposable();
        combo_unidaMedida();
    });

    $("#repuesto_form").on("reset", function(e) {

        $('#repuesto_form')[0].reset(); //limpiando cada uno de los datos
        combo_resposable();
        combo_unidaMedida();
    });
}

function guardaryeditar(e) {

    e.preventDefault();
    var formData = new FormData($("#repuesto_form")[0]);
    $.ajax({
        url: "../../controller/repuesto.php?op=guardaryEditarRpuesto",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

            $('#repuesto_data').DataTable().ajax.reload();
            $('#modalRepuesto').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar',

            })
        }

    });
}
$(document).ready(function() {

    $('#alma_id').select2({
        dropdownParent: $('#modalRepuesto')
    });

    combo_resposable();

    $('#unme_id').select2({
        dropdownParent: $('#modalRepuesto')
    });

    combo_unidaMedida();



    /* TODO tabla de respuestos */
    /* TODO tabla de respuestos */
    /* TODO tabla de respuestos */
    $('#repuesto_data').DataTable({ //llamamos el nombre de la tabla

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
            url: "../../controller/repuesto.php?op=listarRepuestos", //ruta para recibir mi servicio que viene desde mi controller
            type: "post" // tipo de envio 
                // data: { usu_id: usu_id }, //esta linea no porque en listar no tiene datos que enviar
        },
        /* LLAMANDO MI JSON */
        /* LLAMANDO MI JSON */


        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10, //filas a mostrar
        "order": [
            [0, "desc"]
        ],
        "language": {
            "sSearch": "BUSCAR POR CODIGO/ REPUESTO/ FECHA :",
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",

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
        }

    });
    /* TODO tabla de respuestos */
    /* TODO tabla de respuestos */
    /* TODO tabla de respuestos */





    /*  para el formulario */
    /*  para el formulario */
    /*  para el formulario */
    /*  para el formulario */
    $('#alma_id').select2({
        dropdownParent: $('#repuesto_form')
    });

    combo_resposable();

    $('#unme_id').select2({
        dropdownParent: $('#repuesto_form')
    });

    combo_unidaMedida();






});


function combo_resposable() {
    $.post("../../controller/repuesto.php?op=comboResponsable", function(data) {
        $('#alma_id').html(data);
    });
}

function combo_unidaMedida() {
    $.post("../../controller/repuesto.php?op=comboUnidadMedida", function(data) {
        $('#unme_id').html(data);
    });
}

function editar(repu_id) {
    $.post("../../controller/repuesto.php?op=mostraEditar", { repu_id: repu_id }, function(data) {
        data = JSON.parse(data);
        $('#repu_id').val(data.repu_id);
        $('#repu_codigo').val(data.repu_codigo);
        $('#repu_descripcion').val(data.repu_descripcion);
        $('#alma_id').val(data.alma_id).trigger('change');
        $('#unme_id').val(data.unme_id).trigger('change');
        $('#repu_stock').val(data.repu_stock);
        $('#repu_precio_unitario').val(data.repu_precio_unitario);
        /*  $('#repu_stock_total').val(data.repu_stock_total); */
        $('#repu_ultimo_ingreso').val(data.repu_ultimo_ingreso);
        $('#repu_situacion').val(data.repu_situacion).trigger('change');
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalRepuesto').modal('show');
}


function eliminar(repu_id) {
    swal.fire({
        title: "Elimianr",
        text: "Deseas Eliminar Registro ?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => { // preguntamos si el boton presionado es si
        if (result.value) {
            $.post("../../controller/repuesto.php?op=eliminarRepuesto", { repu_id, repu_id }, function(data) { // eliminamos el registro 
                $('#repuesto_data').DataTable().ajax.reload();
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



init();