function init() {}

$(document).ready(function() {
    // Inicializar funciones
    combo_motivo_de_mantenimiento();
    cargarMecanicos();
});





/* Función para llenar el combo desde el controlador */
function combo_motivo_de_mantenimiento() {
    $.post("../../controller/mecanico.php?op=combo_motivo_de_mantenimiento", function(data) {
        $('#esme_id').html(data); // Cambia 'esme_id' por 'category' ya que estamos llenando el combo de categoría
    });


    $.post("../../controller/mecanico.php?op=combo_mecanicos", function(data) {
        $('#mecanico_id').html(data); // Llenar el combo con los mecánicos
    });
}



// Mostrar el nombre del archivo seleccionado y vista previa de la imagen
document.getElementById('foto-vehiculo').addEventListener('change', function() {
    var file = document.getElementById('foto-vehiculo').files[0];

    if (file) {
        var fileName = file.name;
        document.getElementById('foto-vehiculo-nombre').innerText = "Archivo seleccionado: " + fileName;

        // Crear un objeto URL para la vista previa de la imagen
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-foto-vehiculo').src = e.target.result;
            document.getElementById('preview-foto-vehiculo').style.display = 'block'; // Mostrar la imagen
            document.getElementById('modal-foto-vehiculo').src = e.target.result; // Preparar la imagen ampliada en el modal
        }
        reader.readAsDataURL(file); // Leer el archivo como una URL
    } else {
        // Ocultar la vista previa si no hay imagen seleccionada
        document.getElementById('preview-foto-vehiculo').style.display = 'none';
    }
});

// Función para abrir el modal y mostrar la imagen ampliada
function openModal(modalId) {
    $('#' + modalId).modal('show'); // Usar jQuery para abrir el modal
}








// Mostrar el nombre del archivo seleccionado y vista previa de la imagen para "Foto de cómo sale el vehículo"
document.getElementById('imagen-salida').addEventListener('change', function() {
    var file = document.getElementById('imagen-salida').files[0];

    if (file) {
        var fileName = file.name;
        document.getElementById('imagen-salida-nombre').innerText = "Archivo seleccionado: " + fileName;

        // Crear un objeto URL para la vista previa de la imagen
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-imagen-salida').src = e.target.result;
            document.getElementById('preview-imagen-salida').style.display = 'block'; // Mostrar la imagen
            document.getElementById('modal-imagen-salida').src = e.target.result; // Preparar la imagen ampliada en el modal
        }
        reader.readAsDataURL(file); // Leer el archivo como una URL
    } else {
        // Ocultar la vista previa si no hay imagen seleccionada
        document.getElementById('preview-imagen-salida').style.display = 'none';
    }
});





/* Función para manejar el cambio en el combo */
document.getElementById('esme_id').addEventListener('change', function() {
    if (this.value === '12') { // Cambia '12' por el esme_id correspondiente a 'Componentes en la base de dato de prueba'
        // if (this.value === '4') { // Cambia '4' por el esme_id correspondiente a Componentes en la bd '
        document.getElementById('ticket-section').classList.remove('hidden');
        document.getElementById('ticket-details').classList.add('hidden'); // Ocultar los detalles si ya se habían mostrado
        document.getElementById('detalle-form').classList.add('hidden'); // Ocultar el formulario detallado inicialmente
        document.getElementById('recibir-section').classList.add('hidden'); // Ocultar el botón "Recibir" inicialmente
    } else {
        document.getElementById('ticket-section').classList.add('hidden');
        document.getElementById('ticket-details').classList.add('hidden'); // Ocultar los detalles del ticket
        document.getElementById('detalle-form').classList.add('hidden'); // Ocultar el formulario detallado
        document.getElementById('recibir-section').classList.add('hidden');
    }
});

// Función para buscar el ticket
// Función para buscar el ticket y mostrar la tabla


// Función para buscar el ticket y mostrar la tabla
function buscarTicket() {
    const ticketInput = document.getElementById('ticket').value;

    if (ticketInput) {
        // Llamada AJAX para buscar el ticket
        $.post("../../controller/mecanico.php?op=buscar_ticket", { ticketNumber: ticketInput }, function(response) {
            if (response !== "false") { // Verificamos si la respuesta no es "false"
                const ticketData = JSON.parse(response); // Parseamos el JSON recibido

                // Mostrar detalles del ticket
                document.getElementById('ticket-num').innerText = ticketData.tickdo_numtick;
                document.getElementById('ticket-fecha').innerText = ticketData.tickdo_fecha;
                document.getElementById('ticket-hora').innerText = ticketData.tickdo_hora;
                document.getElementById('ticket-cantidad').innerText = ticketData.tickdo_cantidad;
                document.getElementById('ticket-unidad').innerText = ticketData.unidad;

                // Ocultar el formulario cuando se muestre la tabla
                document.getElementById('detalle-form').classList.add('hidden');

                // Mostrar la tabla de detalles del ticket
                document.getElementById('ticket-details').classList.remove('hidden');

                // Mostrar el botón adecuado según el estado del ticket
                if (ticketData.tickdo_estado === 'R') {
                    document.getElementById('btn-editar').classList.remove('hidden'); // Mostrar botón "Editar"
                    document.getElementById('btn-recibir').classList.add('hidden'); // Ocultar botón "Recibir Ticket"
                } else {
                    document.getElementById('btn-recibir').classList.remove('hidden'); // Mostrar botón "Recibir Ticket"
                    document.getElementById('btn-editar').classList.add('hidden'); // Ocultar botón "Editar"
                }
            } else {
                // Si no se encuentra el ticket, mostramos la alerta
                Swal.fire('Error', 'El número de ticket no existe.', 'error');
            }
        });
    } else {
        Swal.fire('Advertencia', 'Por favor, ingrese un número de ticket.', 'warning');
    }
}





// Mostrar el formulario detallado cuando se haga clic en "Recibir Ticket" o "Editar"
function mostrarFormulario() {
    // Ocultar la tabla de detalles del ticket
    document.getElementById('ticket-details').classList.add('hidden');

    // Mostrar el formulario
    document.getElementById('detalle-form').classList.remove('hidden');
}

// Ocultar el formulario si se rechaza el ticket
function ocultarFormulario() {
    document.getElementById('detalle-form').classList.add('hidden');
    document.getElementById('ticket-details').classList.remove('hidden'); // Mostrar nuevamente la tabla de tickets
}



function recibirTicket() {
    const ticketNumber = document.getElementById('ticket-num').innerText;

    Swal.fire({
        title: '¿Estás seguro de recibir este ticket?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, recibir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llamada AJAX para actualizar el estado del ticket a 'R'
            $.post("../../controller/mecanico.php?op=actualizar_estado_ticket", { ticketNumber: ticketNumber }, function(response) {
                if (response === 'success') {
                    Swal.fire('¡Ticket recibido!', 'El ticket ha sido marcado como recibido.', 'success');

                    // Ocultar detalles del ticket después de recibirlo
                    document.getElementById('ticket-details').classList.add('hidden');

                    // Mostrar el formulario para realizar el mantenimiento
                    document.getElementById('detalle-form').classList.remove('hidden');
                } else {
                    Swal.fire('Error', 'Hubo un problema al recibir el ticket.', 'error');
                }
            });
        }
    });
}




function editarTicket() {
    Swal.fire({
        title: '¿Quieres editar este ticket?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Sí, editar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar el formulario de edición directamente
            document.getElementById('ticket-details').classList.add('hidden');
            document.getElementById('detalle-form').classList.remove('hidden');
        }
    });
}




function toggleEmpresa(show) {
    const empresaSection = document.getElementById('empresa-section');

    if (show) {
        empresaSection.style.display = 'block'; // Mostrar el formulario
    } else {
        empresaSection.style.display = 'none'; // Ocultar el formulario
    }
}



// Validar formatos permitidos en la carga de imágenes
document.getElementById('foto-vehiculo').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const fileType = file['type'];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validImageTypes.includes(fileType)) {
            alert('Solo se permiten imágenes en formato JPG, JPEG o PNG.');
            this.value = ''; // Limpiar el valor del input
        }
    }
});

document.getElementById('foto-salida-vehiculo').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const fileType = file['type'];
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validImageTypes.includes(fileType)) {
            alert('Solo se permiten imágenes en formato JPG, JPEG o PNG.');
            this.value = ''; // Limpiar el valor del input
        }
    }
});



/*TODO VALIDEMOS el formulario */


// Validar tamaño de imágenes y PDFs
function validarFormulario() {
    let formData = new FormData(document.getElementById('detalle-form'));

    let fotoVehiculo = document.getElementById('foto_vehiculo').files[0];
    let imagenSalida = document.getElementById('imagen_salida').files[0];
    let informe = document.getElementById('informe').files[0];

    // Validación de tamaño de archivos
    if (fotoVehiculo && fotoVehiculo.size > 2 * 1024 * 1024) {
        Swal.fire('Error', 'La imagen inicial del vehículo no debe exceder los 2MB.');
        return;
    }

    if (imagenSalida && imagenSalida.size > 2 * 1024 * 1024) {
        Swal.fire('Error', 'La imagen de salida del vehículo no debe exceder los 2MB.');
        return;
    }

    if (informe && informe.size > 2 * 1024 * 1024) {
        Swal.fire('Error', 'El informe no debe exceder los 2MB.');
        return;
    }

    // Enviar datos
    $.ajax({
        url: '../../controller/mecanico.php?op=guardar_formulario_mantenimiento',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                Swal.fire('¡Éxito!', res.message, 'success');
                // Recargar o limpiar el formulario
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        },
        error: function(err) {
            Swal.fire('Error', 'Hubo un problema al enviar el formulario.', 'error');
        }
    });
}






init();