function init() {}


function tokens() {


    const direct_id = $('#direct_id').val(); // Obtenemos el direct_id del campo oculto
    if (direct_id) {
        $('#tokenModal').modal('show'); // Mostramos el modal

        // Si es necesario, puedes cargar más información del direct_id antes de abrir el modal.
        // Ejemplo: cargar información adicional desde el servidor para mostrar en el modal.

        // Limpiamos los campos de contraseña en el modal
        $('#token_actual').val('');
        $('#token_nuevo').val('');
        $('#token_confirma').val('');
    } else {
        alert("Debe seleccionar un elemento primero.");
    }
}

// Función para actualizar el token

function cambiarToken() {
    // Obtener los valores de los campos
    const direct_id = $('#direct_id').val(); // Obtenemos el direct_id
    const token_actual = $('#token_actual').val();
    const token_nuevo = $('#token_nuevo').val();
    const token_confirma = $('#token_confirma').val();

    // Verificar si las contraseñas nuevas coinciden
    if (token_nuevo !== token_confirma) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden'
        });
        return;
    }

    // Enviar la solicitud al servidor
    $.ajax({
        url: "../../controller/token.php?op=update_token", // URL del controlador PHP para actualizar el token
        type: "POST",
        data: {
            direct_id: direct_id,
            token_actual: token_actual,
            token_nuevo: token_nuevo
        },
        success: function(response) {
            const res = JSON.parse(response); // Parsear la respuesta del servidor

            if (res.status === "success") {
                // Si la contraseña se actualizó con éxito
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: res.message // Mostrar el mensaje del servidor
                }).then((result) => {
                    $('#tokenModal').modal('hide');
                    location.reload(); // Recargar la página o realizar otra acción
                });
            } else if (res.status === "error") {
                // Si hubo un error, mostrar el mensaje del servidor
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.message // Mostrar el mensaje de error del servidor
                });
            }
        },
        error: function(xhr, status, error) {
            // Mostrar alerta de error en caso de fallo en la solicitud AJAX
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al actualizar la contraseña. Inténtalo de nuevo.'
            });
        }
    });
}



init();