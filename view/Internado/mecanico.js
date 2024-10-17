function init() {}


$(document).ready(function() {
    // Inicializamos los combos al cargar la página
    combo_motivo_de_mantenimiento();


    // Al mostrar el modal, obtenemos el correlativo, fecha y lista de repuestos
    $('#notificacionModal').on('show.bs.modal', function() {
        obtenerSiguienteCorrelativo();
        establecerFechaActual();
        obtenerRepuestos();

    });


    // Al abrir el modal
    $('#vehiculoModal').on('show.bs.modal', function() {

        cargarIngresoVehiculos(); // Llamar la función cuando se abre el modal
    });






    $('#almacenModal').on('show.bs.modal', function() {

        cargaAlmacen();
    });





    /* TODO tabla modal de respuestos */
    /* TODO tabla modal de respuestos */
    /* TODO tabla modal de respuestos */


    function cargaAlmacen() {
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
                url: "../../controller/mecanico.php?op=listarRepuestos", //ruta para recibir mi servicio que viene desde mi controller
                type: "post" // tipo de envio 
                    // data: { usu_id: usu_id }, //esta linea no porque en listar no tiene datos que enviar
            },
            /* LLAMANDO MI JSON */
            /* LLAMANDO MI JSON */


            "bDestroy": true,
            "responsive": true,
            "bInfo": false,
            "iDisplayLength": 5, //filas a mostrar
            "order": [
                [0, "desc"]
            ],
            "language": {
                "sSearch": "BUSCAR REPUESTO ",
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",

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
    }









    function cargarIngresoVehiculos() {

        // Limpiar la tabla antes de cargar los datos
        $("#tabla-ingreso-vehiculos tbody").empty();

        $.ajax({
            url: "../../controller/mecanico.php?op=listar_ingresos", // Cambia esta ruta si es necesario
            type: "GET",
            dataType: "json",
            success: function(data) {

                $.each(data, function(index, item) {
                    $("#tabla-ingreso-vehiculos tbody").append(
                        "<tr>" +
                        "<td><input type='radio' name='unidad_seleccionada' value='" + item.inun_id + "'></td>" + // Asegúrate de que estás usando la propiedad correcta
                        "<td>" + item.vehiculo + "</td>" + // Cambiar a minúsculas
                        "<td>" + item.fechadeingreso + "</td>" + // Cambiar a minúsculas
                        "<td>" + item.horadeingreso + "</td>" + // Cambiar a minúsculas

                        "</tr>"
                    );
                });



                // Verificar si el DataTable ya ha sido inicializado
                if ($.fn.dataTable.isDataTable('#tabla-ingreso-vehiculos')) {
                    // Si ya ha sido inicializado, destruirlo antes de volver a inicializarlo
                    $('#tabla-ingreso-vehiculos').DataTable().destroy();
                }


                // Inicializamos DataTables en la tabla después de cargar los datos
                $('#tabla-ingreso-vehiculos').DataTable({
                    "pageLength": 5, // Mostrar solo 5 filas por página
                    "lengthChange": false, // Ocultar opción de cambiar número de filas visibles
                    "language": {
                        "search": "Buscar:", // Cambia la etiqueta del buscador
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "emptyTable": "No hay datos disponibles"
                    }
                });

            },
            error: function(xhr, status, error) {
                console.error("Error al cargar los datos: " + error);
            }
        });
    }

    // Confirmar la selección de unidad
    $('#confirmarSeleccionUnidad').click(function() {
        const selectedUnidad = $('input[name="unidad_seleccionada"]:checked').val();
        // Obtener el nombre del vehículo seleccionado (de la segunda columna)
        const selectedVehiculo = $('input[name="unidad_seleccionada"]:checked').closest('tr').find('td:nth-child(2)').text();

        if (selectedUnidad) {
            // Mostrar el nombre del vehículo seleccionado como título en el área indicada
            $('#titulo-vehiculo-seleccionado').text(selectedVehiculo);

            // Mostrar el botón de "Solicitud a Almacén"
            $('#solicitud-almacen').show();

            // Asignar el inun_id al campo hidden
            $('#inun_id').val(selectedUnidad);

            // Habilitar los campos del formulario
            $('#detalle-form :input').prop('disabled', false); // Habilitar todos los campos

            // Cerrar el modal
            $('#vehiculoModal').modal('hide');

        } else {
            alert("Por favor, selecciona una unidad.");
        }
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




    // Función para obtener el siguiente correlativo de la base de datos
    function obtenerSiguienteCorrelativo() {
        $.ajax({
            url: "../../controller/mecanico.php?op=fetch_correlativo",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#correlativo').val(data.next_correlativo);
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener correlativo: " + error);
            }
        });
    }








    // Función para establecer la fecha actual
    function establecerFechaActual() {
        let hoy = new Date().toISOString().substr(0, 10);
        $('#fecha-solicitud').val(hoy);
    }

    // Función para obtener la lista de repuestos y llenar el dropdown
    function obtenerRepuestos() {
        $.ajax({
            url: "../../controller/mecanico.php?op=combolistarRepuestos",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let repuestoSelect = $('#repuesto_id');
                repuestoSelect.empty();
                $.each(data, function(index, item) {
                    repuestoSelect.append(new Option(item.repu_descripcion, item.repu_id));
                });
                repuestoSelect.select2(); // Aplicar buscador (si estás usando select2)
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener repuestos: " + error);
            }
        });
    }


    $('#enviarSolicitudAlmacen').off('click').on('click', function(e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado del formulario

        // Crear un objeto FormData desde el formulario
        var formData = new FormData();
        formData.append('sore_titulo', $("#sore_titulo").val());
        formData.append('repuesto_id', $("#repuesto_id").val());
        formData.append('cantidad_repuesto', $("#cantidad_repuesto").val());
        formData.append('sore_fecha', $("#fecha-solicitud").val());

        // Realizar la solicitud AJAX
        $.ajax({
            url: '../../controller/mecanico.php?op=guardarSolicitudRepuesto', // Llamar al controlador
            type: 'POST',
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el content-type
            success: function(response) {
                var result = JSON.parse(response);

                if (result.status === 'success') {
                    Swal.fire('¡Éxito!', result.message, 'success'); // Mostrar mensaje de éxito

                    // Inhabilitar los campos del formulario después del guardado exitoso
                    $('#correlativo').prop('disabled', true);
                    $('#fecha-solicitud').prop('disabled', true);
                    $('#cantidad_repuesto').prop('disabled', true);
                    $('#repuesto_id').prop('disabled', true);
                    $('#sore_titulo').prop('disabled', true);

                    $('#notificacionModal').modal('hide');
                    $('#enviarSolicitudAlmacen').prop('disabled', true);
                } else {
                    Swal.fire('Error', result.message, 'error'); // Mostrar mensaje de error
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Hubo un problema al enviar la solicitud.', 'error');
            }
        });
    });


});










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
    const selectedValue = this.value;

    // Si el valor seleccionado es "COMPONENTES" o "CORRECTIVO" 

    /*TODO OJO ACA LOS NMEROS SALEN DE LOS ID DE ESPECIALISDAD_MECANICA DE LA BASE DE DATOS */
    /*TODO OJO ACA LOS NMEROS SALEN DE LOS ID DE ESPECIALISDAD_MECANICA DE LA BASE DE DATOS */
    /*TODO OJO ACA LOS NMEROS SALEN DE LOS ID DE ESPECIALISDAD_MECANICA DE LA BASE DE DATOS */
    /*TODO OJO ACA LOS NMEROS SALEN DE LOS ID DE ESPECIALISDAD_MECANICA DE LA BASE DE DATOS */
    if (selectedValue === '1') {
        // Mantén el comportamiento actual que ya tienes para "COMPONENTES" y "CORRECTIVO"
        document.getElementById('ticket-section').classList.remove('hidden');
        document.getElementById('ticket-details').classList.add('hidden'); // Ocultar los detalles si ya se habían mostrado
        document.getElementById('detalle-form').classList.add('hidden'); // Ocultar el formulario detallado inicialmente
        document.getElementById('recibir-section').classList.add('hidden'); // Ocultar el botón "Recibir" inicialmente
    } else if (selectedValue === '13') {

        document.getElementById('ticket-section').classList.add('hidden'); // Ocultar la sección del ticket
        document.getElementById('ticket-details').classList.add('hidden'); // Ocultar los detalles del ticket
        document.getElementById('detalle-form').classList.remove('hidden'); // Mostrar el formulario
        document.getElementById('recibir-section').classList.add('hidden'); // Asegurarse de ocultar el botón "Recibir"
    } else {
        // Si es cualquier otra opción que no sea "COMPONENTES" o "CORRECTIVO"
        document.getElementById('ticket-section').classList.add('hidden'); // Ocultar la sección del ticket
        document.getElementById('ticket-details').classList.add('hidden'); // Ocultar los detalles del ticket
        document.getElementById('detalle-form').classList.remove('hidden'); // Mostrar el formulario
        document.getElementById('recibir-section').classList.add('hidden'); // Asegurarse de ocultar el botón "Recibir"
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




/* Validar y subir el formulario */
function validarFormulario() {
    let formData = new FormData(document.getElementById('detalle-form'));

    let fotoVehiculo = document.getElementById('foto-vehiculo').files[0];
    let imagenSalida = document.getElementById('imagen-salida').files[0];
    let informe = document.getElementById('informe').files[0];

    // Validar tamaño de archivos
    if (fotoVehiculo && fotoVehiculo.size > 4 * 1024 * 1024) {
        Swal.fire('Error', 'La imagen inicial del vehículo no debe exceder los 2MB.');
        return;
    }

    if (imagenSalida && imagenSalida.size > 4 * 1024 * 1024) {
        Swal.fire('Error', 'La imagen de salida del vehículo no debe exceder los 2MB.');
        return;
    }

    if (informe && informe.size > 4 * 1024 * 1024) {
        Swal.fire('Error', 'El informe no debe exceder los 2MB.');
        return;
    }

    // Enviar datos usando AJAX
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
                document.getElementById('detalle-form').reset(); // Limpia el formulario
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Hubo un problema al enviar el formulario.', 'error');
            console.error('Error AJAX:', error); // Añadido para depuración
        }
    });
}


$('#guardarFormulario').click(function(e) {
    e.preventDefault();

    let formData = new FormData(document.getElementById('detalle-form'));

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
                $('#detalle-form')[0].reset(); // Limpiar formulario
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Hubo un problema al enviar el formulario.', 'error');
            console.error('Error AJAX:', error);
        }
    });
});







init();