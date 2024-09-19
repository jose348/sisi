function init() {
    // Inicializar select2 y cargar trabajadores
    $('#trabajador_id').select2({
        placeholder: "Seleccione un trabajador",
        width: '100%'
    });

    combo_trabajador(); // Llamar a la función para cargar los datos en el select


    // Inicializar select2 y cargar trabajadores
    $('#func_id').select2({
        placeholder: "Seleccione un Funcion",
        width: '100%'
    });

    combo_funciones(); // Llamar a la función para cargar los datos en el select
}







// Función para cargar el combo de funciones
function combo_funciones() {
    $.post("../../controller/directorio.php?op=combo_funcion", function(data) {
        $('#func_id').html(data); // Colocar los datos devueltos en el select
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error al cargar los trabajadores: " + textStatus);
    });
}

// Función para cargar el combo de trabajadores
function combo_trabajador() {
    $.post("../../controller/directorio.php?op=combo_trabajador", function(data) {
        $('#trabajador_id').html(data); // Colocar los datos devueltos en el select
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error al cargar los trabajadores: " + textStatus);
    });
}



$(document).ready(function() {

    $('#directorio').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [

        ],

        // Elimina la barra de búsqueda
        "searching": true,

        // Configuración para recibir los datos desde tu servicio (JSON)
        "ajax": {
            url: "../../controller/directorio.php?op=listarDirectorio",
            type: "post"
        },

        "bDestroy": true,
        "responsive": true,
        "bInfo": false,
        "iDisplayLength": 5, // Número de filas a mostrar
        "order": [
            [0, "desc"]
        ],
        "language": {
            "sProcessing": "Procesando...",

            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",


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

});


function editar(direct_id) {
    // Llamada AJAX para obtener los detalles del registro
    $.post("../../controller/directorio.php?op=obtenerDirectorio", { direct_id: direct_id }, function(data) {
        var registro = JSON.parse(data); // Convertir la respuesta a JSON

        // Cargar los datos en el formulario
        $('#trabajador_id').val(registro.pers_id).trigger('change');
        $('#func_id').val(registro.func_id).trigger('change');
        $('#descripcionTarea').val(registro.direct_descrip);
        $('#fechaAsignacion').val(registro.direct_fecha);
        $('#direct_id').val(registro.direct_id); // Almacenar el direct_id en el campo oculto

        // Habilitar el formulario
        habilitarFormulario();
    });
}

// Función para habilitar los campos del formulario
function habilitarFormulario() {
    $('#trabajador_id').prop('disabled', false);
    $('#func_id').prop('disabled', false);
    $('#descripcionTarea').prop('disabled', false);
    $('#fechaAsignacion').prop('disabled', false);
    $('#add_button').prop('disabled', false);
    $('#add_tonken').prop('disabled', false);
}






function actualizarFuncion() {
    // Obtener los datos del formulario
    var direct_id = $('#direct_id').val(); // ID del registro a actualizar
    var trabajador_id = $('#trabajador_id').val(); // ID del trabajador seleccionado
    var func_id = $('#func_id').val(); // ID de la función seleccionada
    var descripcionTarea = $('#descripcionTarea').val(); // Descripción de la tarea
    var fechaAsignacion = $('#fechaAsignacion').val(); // Fecha de asignación

    // Validaciones (verificar que todos los campos estén completos)
    if (!trabajador_id || !func_id || !descripcionTarea || !fechaAsignacion) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, completa todos los campos.',
        });
        return;
    }

    // Enviar los datos al backend para actualizar el registro
    $.ajax({
        url: "../../controller/directorio.php?op=updateDirectorio", // Ruta para la actualización
        type: "POST",
        data: {
            direct_id: direct_id,
            trabajador_id: trabajador_id,
            func_id: func_id,
            descripcionTarea: descripcionTarea,
            fechaAsignacion: fechaAsignacion
        },
        success: function(response) {
            // SweetAlert para mostrar éxito
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'El registro ha sido actualizado correctamente.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#directorio').DataTable().ajax.reload(); // Recargar la tabla para mostrar los cambios
                    limpiarFormulario(); // Limpiar el formulario después de la actualización
                }
            });
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al actualizar el registro.',
            });
        }
    });
}

// Función para limpiar el formulario
function limpiarFormulario() {
    $('#trabajador_id').val('').trigger('change');
    $('#func_id').val('').trigger('change');
    $('#descripcionTarea').val('');
    $('#fechaAsignacion').val('');
    $('#direct_id').val('');
    deshabilitarFormulario(); // Deshabilitar el formulario después de limpiar
}

// Deshabilitar el formulario
function deshabilitarFormulario() {
    $('#trabajador_id').prop('disabled', true);
    $('#func_id').prop('disabled', true);
    $('#descripcionTarea').prop('disabled', true);
    $('#fechaAsignacion').prop('disabled', true);
    $('#add_button').prop('disabled', true);
    $('#add_tonken').prop('disabled', true);
}






function eliminar(direct_id) {
    // Confirmar con SweetAlert antes de eliminar
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, enviar la solicitud para eliminar el registro
            $.ajax({
                url: "../../controller/directorio.php?op=deleteDirectorio",
                type: "POST",
                data: { direct_id: direct_id },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'El registro ha sido eliminado correctamente.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#directorio').DataTable().ajax.reload(); // Recargar la tabla después de eliminar
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al eliminar el registro.',
                    });
                }
            });
        }
    });
}


init(); // Ejecuta la inicialización al cargar el documento