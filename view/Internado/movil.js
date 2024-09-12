 function init() {

     /* TODO para verificar la hora */

     function setDefaultTime() {
         var now = new Date();
         var hours = ("0" + now.getHours()).slice(-2); // Asegura que la hora tenga dos dígitos
         var minutes = ("0" + now.getMinutes()).slice(-2); // Asegura que los minutos tengan dos dígitos

         var defaultTime = hours + ":" + minutes;
         document.getElementById('horaIngreso').value = defaultTime;
     }

     // Llama a la función cuando el documento esté listo
     document.addEventListener('DOMContentLoaded', setDefaultTime);



     /*TODO para la hora actual  */
     function setDefaultDate() {
         var today = new Date();
         var year = today.getFullYear();

         var month = ("0" + (today.getMonth() + 1)).slice(-2); // Asegura que el mes tenga dos dígitos
         var day = ("0" + today.getDate()).slice(-2); // Asegura que el día tenga dos dígitos

         var defaultDate = year + "-" + month + "-" + day;
         document.getElementById('fechaIngreso').value = defaultDate;

     }

     // Llama a la función cuando el documento esté listo
     document.addEventListener('DOMContentLoaded', setDefaultDate);

     $("#movil_form_modal").on("submit", function(e) {
         guardaryeditar(e);
     });

 }

 function guardar() {


     event.preventDefault(); // Evita el envío del formulario para realizar validación primero

     // Obtener los valores de los campos

     var fechaIngreso = document.getElementById('fechaIngreso').value;
     var horaIngreso = document.getElementById('horaIngreso').value;
     var descripcion = document.getElementById('descripcion').value;
     var estado = document.querySelector('input[name="estado"]:checked');
     var unidad = document.getElementById('unid_id').value;
     var descripDiagnos = document.getElementById('descripDiagnos').value;
     var fechaDiagnostico = document.getElementById('fechaDiagnostico').value;

     // Validaciones

     if (fechaIngreso === '') {
         alert("Por favor, ingrese la fecha de ingreso.");
         return false;
     }



     if (horaIngreso === '') {
         alert("Por favor, ingrese la hora de ingreso.");
         return false;
     }

     if (descripcion.trim() === '') {
         swal.fire({
             title: 'Advertencia',
             text: 'Ingrese Descripcion',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         })
         return false;
     }

     if (!estado) {
         swal.fire({
             title: 'Advertencia',
             text: 'Seleccione Estado',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         })
         return false;
     }

     if (unidad === '') {
         swal.fire({
             title: 'Advertencia',
             text: 'Seleccione Unidad Movil',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         })
         return false;
     }
     if (descripDiagnos.trim() === '') {
         swal.fire({
             title: 'Advertencia',
             text: 'Ingrese El Diagnostico',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         })
         return false;
     }

     if (fechaDiagnostico === '') {
         swal.fire({
             title: 'Advertencia',
             text: 'Ingrese Fecha de Diagnostico',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         })
         return false;

     }
     // Si todas las validaciones pasan, muestra el segundo botón


     // Puedes proceder con el guardado o envío del formulario aquí si es necesario
     alert("Formulario validado y guardado correctamente.");

 }


 function guardaryeditar(e) {
     console.log("test");
     e.preventDefault();
     var formData = new FormData($("#movil_form_modal")[0]);
     console.log(formData);
     $.ajax({
         url: "../../controller/intermovilregistro.php?op=guardarEditar",
         type: "POST",
         data: formData,
         contentType: false,
         processData: false,
         success: function(data) {
             console.log(data);
             $('#moviles_data').DataTable().ajax.reload(); //para recargar mi tabla
             $('#resgitrarmovil').modal('hide'); //para limpiar mi modal
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

     $('#tiun_id').select2({
         dropdownParent: $('#resgitrarmovil')

     });
     combo_tipo();

     $('#mode_id').select2({
         dropdownParent: $('#resgitrarmovil')
     });


     $('#marc_id').select2({
         dropdownParent: $('#resgitrarmovil')

     });
     combo_marca();
     $("#marc_id").change(function() {
         $("#marc_id option:selected").each(function() {
             marc_id = $(this).val();
             combo_modelo2(marc_id); 
         });    
     });

     $('#depe_id').select2({
         dropdownParent: $('#resgitrarmovil')
     });
     combo_area();


     $('#colo_id').select2({
         dropdownParent: $('#resgitrarmovil')
     });
     combo_color();

     $('#comb_id').select2({
         dropdownParent: $('#resgitrarmovil')
     });
     combo_combustible();

     $('#esme_id').select2({
         dropdownParent: $('#modalRegistrarMecanica')
     });
     combo_espe();

     'use strict';

     /*    $('#wizard6').steps({
            headerTag: 'h4',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span>   <span class="title">#title#</span>',

            cssClass: 'wizard wizard-style-2'
        }); */


     $('#wizard1').steps({

         headerTag: 'h4',
         bodyTag: 'section',
         autoFocus: true,
         titleTemplate: '<span class="number icon">  <i class="fa fa-iconName"></i>  </span> <span class="title">#title#</span>',
         labels: {
             next: "Siguiente",
             previous: "Anterior",
             finish: "Final"
         },
         cssClass: 'wizard wizard-style-2',
         onStepChanging: function(event, currentIndex, newIndex) {
             // Aquí puedes cambiar los íconos según el índice del paso
             var iconSteps = ['fa-car', 'fa-credit-card', 'fa-check-circle', 'fa-car']; // Añade tus íconos aquí
             $('#wizard1 .steps ul li').each(function(index) {
                 $(this).find('.icon i').attr('class', 'fa ' + iconSteps[index]);
             });
             return true;
         },
         onInit: function(event, currentIndex) {
             var iconSteps = ['fa-car', 'fa-credit-card', 'fa-check-circle', 'fa-car']; // Añade tus íconos aquí
             $('#wizard1 .steps ul li').each(function(index) {
                 $(this).find('.icon i').attr('class', 'fa ' + iconSteps[index]);
             });
         }
     });


     $('#moviles_data').DataTable({

         "aProcessing": true,
         "aServerSide": true,
         dom: 'Bfrtip',
         buttons: [


         ],

         "ajax": {
             url: "../../controller/intermovilregistro.php?op=listar",

             type: "post"

         },


         "bDestroy": true,
         "responsive": true,
         "bInfo": true,
         "iDisplayLength": 5,
         "order": [
             [6, "desc"]
         ],
         "language": {
             "sProcessing": "Procesando...",
             "sLengthMenu": "Mostrar _MENU_ registros",
             "sZeroRecords": "No se encontraron resultados",
             "sEmptyTable": "Ningún dato disponible en esta tabla",
             "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "sInfoEmpty": "Registros del 0 al 0 de un total de 0 registros",
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

     function cancelar() {
         // Limpiar los campos de texto excepto los de fecha y hora
         $('#descripcion').val('');
         $('#descripDiagnos').val('');
         $('input[type="radio"]').prop('checked', false); // Desmarca todos los radio buttons
         $('#unid_id').val(''); // Limpia el campo de Unidad Movil

         // Habilitar el botón "Registrar Mecánica"
         $('#botonRegistrarMecanica').prop('disabled', false);

         // Deshabilitar el botón "Guardar"
         $('#botonGuardar').prop('disabled', true);
     }

     // Vincula la función cancelar al botón con ID "cancelar"
     $('#cancelar').on('click', cancelar);

     function combo_UNIDADMOVIL() {
         $.post("../../controller/intermovilregistro.php?op=combo_UNIDADMOVIL", function(data) {
                 console.log(data); // Verificar los datos devueltos en la consola
                 $('#unid_options').html(data.trim()); // Cargar los datos en el datalist
             })
             .fail(function(xhr, status, error) {
                 console.error("Error en la solicitud AJAX: ", status, error);
             });
     }

     // Llamada a la función para cargar los datos al iniciar
     combo_UNIDADMOVIL();

 });




 function combo_tipo() {
     $.post("../../controller/intermovilregistro.php?op=combo_tipo", function(data) {
         $('#tiun_id').html(data);
     });
 }

 function combo_marca() {
     $.post("../../controller/intermovilregistro.php?op=combo_marca", function(data) {
         $('#marc_id').html(data);
     });
 }

 function combo_area() {
     $.post("../../controller/intermovilregistro.php?op=combo_area", function(data) {
         $('#depe_id').html(data);
     });
 }


 function combo_color() {
     $.post("../../controller/intermovilregistro.php?op=combo_color", function(data) {
         $('#colo_id').html(data);
     });
 }



 function combo_combustible() {
     $.post("../../controller/intermovilregistro.php?op=combo_combustible", function(data) {
         $('#comb_id').html(data);
     });
 }


 function combo_modelo2(marc_id) {

     $.ajax({
         url: "../../controller/intermovilregistro.php?op=combo_modelo",
         type: "POST",
         data: { marc_id: marc_id },
         dataType: "html",
         success: function(data) {
             $('#mode_id').html(data);
         },
         error: function(xhr, status, error) {
             console.error("Error en la solicitud AJAX:", status, error);     
         }
     });
 }

 function combo_espe() {
     $.post("../../controller/intermovilregistro.php?op=combo_esme", function(data) {
         $('#esme_id').html(data);
     });
 }



 function editar() {
     var selectedRadio = document.querySelector('input[name="select-row"]:checked');

     if (selectedRadio) {
         // Obtén el valor del radio button seleccionado (el ID)
         var unid_id = selectedRadio.value;

         // Llama a la función editar con el ID del radio button seleccionado
         $.post("../../controller/intermovilregistro.php?op=mostrarMovil", { unid_id: unid_id }, function(data) {
             data = JSON.parse(data);
             console.log(data);
             $('#unid_id').val(data.unid_id);
             $('#tiun_id').val(data.tiun_id).trigger('change');;
             $('#unid_codigo').val(data.unid_codigo);
             $('#marc_id').val(data.marc_id).trigger('change');
             $('#mode_id').val(data.mode_id).trigger('change');
             $('#depe_id').val(data.depe_id).trigger('change');
             $('#unid_placa').val(data.unid_placa);
             $('#colo_id').val(data.colo_id).trigger('change');
             $('#unid_anio').val(data.unid_anio);
             $('#comb_id').val(data.comb_id).trigger('change');
             $('#unid_adquisicion').val(data.unid_adquisicion);
             $('#unid_motor').val(data.unid_motor);
             $('#unid_observacion').val(data.unid_observacion);

         });
         $('#lbltitulo').html('Editar Registro');
         $('#resgitrarmovil').modal('show');
     } else {
         Swal.fire({
             title: 'Advertencia',
             text: 'Seleccione Movil',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         })
     }
 }


 function eliminar() {
     var selectedRadio = document.querySelector('input[name="select-row"]:checked');
     if (selectedRadio) {
         var unid_id = selectedRadio.value;

         swal.fire({
             title: "Elimianr",
             text: "Deseas Eliminar Registro ?",
             icon: "error",
             confirmButtonText: "Si",
             showCancelButton: true,
             cancelButtonText: "No",
         }).then((result) => {
             if (result.value) {
                 $.post("../../controller/intermovilregistro.php?op=eliminarMovil", { unid_id, unid_id }, function(data) { // eliminamos el registro 
                     $('#moviles_data').DataTable().ajax.reload();
                     swal.fire({
                         title: 'Correcto',
                         text: 'Se Elimino Correctamente',
                         icon: 'success',
                         confirmButtonText: 'Aceptar'
                     })
                 });
             }
         });
     } else {
         Swal.fire({
             title: 'Advertencia',
             text: 'Seleccione Movil',
             icon: 'error',
             confirmButtonText: 'Aceptar'
         })
     }

 }

 function nuevoMovil() {
     $('#lbltitulo').html('Registrar Nueva Unidad');
     $('#movil_form_modal')[0].reset();
     /*  combo_area();
      combo_marca();
      combo_tipo();
      combo_color();
      combo_combustible();
      combo_modelo2(); */
     $('#resgitrarmovil').modal('show');
 }

 function pdf() {
     window.open('../../controller/intermovilregistro.php?op=reportePDF', '_blank');
 }



 function ModalProgMeca() {

     $('#prma_diagnostico_inicial').val('');
     $('#esme_id').val('').trigger('change');
     // Obtener el valor del input 'Unidad Movil'
     var unidadMovilSeleccionada = $('#unid_id').val();

     // Verificar si el valor ingresado coincide con alguna opción del datalist
     var isValid = false;
     $('#unid_options option').each(function() {
         if ($(this).val() === unidadMovilSeleccionada) {
             isValid = true;
             return false; // Termina el bucle si encuentra una coincidencia
         }
     });

     if (unidadMovilSeleccionada === '') {
         // Mostrar mensaje de error si no se seleccionó nada
         Swal.fire({
             title: '<i class="fa fa-car"></i> Advertencia', // Incluye el ícono de carrito en el título
             html: '<strong>Por favor, seleccione un Vehículo de la lista.</strong>', // Utiliza HTML para el texto de la alerta
             icon: 'warning', // Icono de advertencia
             confirmButtonText: 'Aceptar'
         });
     } else if (isValid) {
         // Mostrar los datos en el modal si la entrada es válida
         $('#datosUnidadMovil').text('' + unidadMovilSeleccionada);

         // Abrir el modal
         $('#modalRegistrarMecanica').modal('show');
     } else if (unidadMovilSeleccionada == null) {
         // Mostrar mensaje de error si el valor ingresado no es válido
         Swal.fire({
             title: '<i class="fa fa-car"></i> Advertencia', // Incluye el ícono de carrito en el título
             html: '<strong>Seleccione un Vehículo</strong>', // Utiliza HTML para el texto de la alerta
             icon: 'warning', // Icono de advertencia
             confirmButtonText: 'Aceptar'
         });
     } else {
         Swal.fire({
             title: '<i class="fa fa-car"></i> Advertencia', // Incluye el ícono de carrito en el título
             html: '<strong>Seleccione un Vehículo válido de la lista</strong>', // Utiliza HTML para el texto de la alerta
             icon: 'warning', // Icono de advertencia
             confirmButtonText: 'Aceptar'
         });
     }
 }


 function setDefaultTime() {
     var now = new Date();
     var hours = ("0" + now.getHours()).slice(-2); // Asegura que la hora tenga dos dígitos
     var minutes = ("0" + now.getMinutes()).slice(-2); // Asegura que los minutos tengan dos dígitos

     var defaultTime = hours + ":" + minutes;
     document.getElementById('prma_hora').value = defaultTime;
 }

 // Llama a la función cuando el documento esté listo
 document.addEventListener('DOMContentLoaded', setDefaultTime);



 /*TODO para la hora actual  */
 function setDefaultDate() {
     var today = new Date();
     var year = today.getFullYear();

     var month = ("0" + (today.getMonth() + 1)).slice(-2); // Asegura que el mes tenga dos dígitos
     var day = ("0" + today.getDate()).slice(-2); // Asegura que el día tenga dos dígitos

     var defaultDate = year + "-" + month + "-" + day;
     document.getElementById('prma_fecha').value = defaultDate;

 }

 // Llama a la función cuando el documento esté listo
 document.addEventListener('DOMContentLoaded', setDefaultDate);







 /*TODO EMPEZAMOS A GUARDAR LA PROGRAMACION DEL MANTENIMIENTO  */
 function guardarDatos() {
     // Obtener los datos del formulario del modal
     var diagnosticoInicial = $('#prma_diagnostico_inicial').val();
     var fecha = $('#prma_fecha').val();
     var hora = $('#prma_hora').val();
     var especialidadMecanica = $('#esme_id').val();
     var MovilSeleccionadacombo = $('#unid_id').val();
     MovileSeleccionadoNuevo = MovilSeleccionadacombo.split("/");
     MovileSeleccionadoNuevo = MovileSeleccionadoNuevo[0].trim();


     if (!diagnosticoInicial || !fecha || !hora || !especialidadMecanica || !MovileSeleccionadoNuevo) {
         Swal.fire({
             title: '<i class="fa fa-exclamation-circle"></i> Error',
             html: '<strong>Faltan datos requeridos. Por favor completa todos los campos.</strong>',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         });
         return; // Detener ejecución si falta algún dato
     }

     // Realizar la llamada AJAX para guardar los datos
     $.ajax({
         url: "../../controller/intermovilregistro.php?op=guardar_prog_mante",
         type: 'POST',
         data: {
             prma_diagnostico_inicial: diagnosticoInicial,
             prma_fecha: fecha,
             prma_hora: hora,
             unid_id: MovileSeleccionadoNuevo,
             esme_id: especialidadMecanica
         },
         success: function(response) {
             var respuesta = JSON.parse(response);
             if (respuesta.success) {
                 // Almacena el nuevo prma_id generado
                 var nuevoID = respuesta.id;
                 $('#prma_id').val(nuevoID);
                 // Asignar el ID al campo oculto del formulario modal

                 // También actualizar el campo oculto del formulario principal
                 $('#miFormulario #prma_id').val(nuevoID);
                 $('#miFormulario #unid_id').val(MovileSeleccionadoNuevo);



                 console.log('Nuevo ID:', nuevoID); // Verifica el nuevo ID
                 console.log('Valor de prma_id en formulario principal antes de asignar:', $('#miFormulario #prma_id').val());
                 $('#miFormulario #prma_id').val(nuevoID);
                 console.log('Valor de prma_id en formulario principal después de asignar:', $('#miFormulario #prma_id').val());



                 // Mostrar mensaje de éxito
                 Swal.fire({
                     title: '<i class="fa fa-check-circle"></i> Guardado',
                     html: '<strong>Los datos han sido guardados exitosamente.</strong>',
                     icon: 'success',
                     confirmButtonText: 'Aceptar'
                 });

                 $('#botonGuardar').prop('disabled', false);
                 $('#botonRegistrarMecanica').prop('disabled', true);
                 $('#modalRegistrarMecanica').modal('hide');
             } else {
                 Swal.fire({
                     title: '<i class="fa fa-times-circle"></i> Error',
                     html: '<strong>Hubo un error al guardar los datos. Inténtelo de nuevo.</strong>',
                     icon: 'error',
                     confirmButtonText: 'Aceptar'
                 });
             }
         },
         error: function(error) {
             Swal.fire({
                 title: '<i class="fa fa-times-circle"></i> Error',
                 html: '<strong>Hubo un error al guardar los datos. Inténtelo de nuevo.</strong>',
                 icon: 'error',
                 confirmButtonText: 'Aceptar'
             });
         }
     });
 }








 /*TODO GUARDAMOS EL FORMULARIO PRINCIPAL DE miFormulario */

 function guardar() {
     // Obtener los datos del formulario
     var fechaIngreso = $('#fechaIngreso').val();
     var horaIngreso = $('#horaIngreso').val();
     var diagnostico = $('#descripcion').val();
     var diagnosticoEspecializado = $('#descripDiagnos').val();
     var fechaDiagnostico = $('#fechaDiagnostico').val();
     var MovilSeleccionadacombo = $('#unid_id').val();
     MovileSeleccionadoNuevo = MovilSeleccionadacombo.split("/");
     MovileSeleccionadoNuevo = MovileSeleccionadoNuevo[0].trim();

     // Obtener el estado del vehículo
     var estadoVehiculo = $('input[name="estado"]:checked').val();
     var estadoValor = (estadoVehiculo === 'Activo') ? 1 : 0; // Convertir el estado a 1 o 0

     if (!fechaIngreso || !horaIngreso || !diagnostico || !diagnosticoEspecializado || !fechaDiagnostico || !MovileSeleccionadoNuevo) {
         Swal.fire({
             title: '<i class="fa fa-exclamation-circle"></i> Error',
             html: '<strong>Faltan datos requeridos. Por favor completa todos los campos.</strong>',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         });
         return; // Detener la ejecución si falta algún dato
     }

     // Realizar la llamada AJAX para guardar los datos
     $.ajax({
         url: "../../controller/intermovilregistro.php?op=guardar_ing_vehi",
         type: 'POST',
         data: {
             inun_fecha: fechaIngreso,
             inun_hora: horaIngreso,
             inun_diagnostico: diagnostico,
             unid_id: MovileSeleccionadoNuevo,
             inun_diagnostico_especializado: diagnosticoEspecializado,
             inun_fecha_diagnostico_especializado: fechaDiagnostico,
             inun_estado: estadoValor // Enviar el valor 1 o 0 dependiendo del estado
         },
         success: function(response) {
             var respuesta = JSON.parse(response);
             if (respuesta.success) {
                 Swal.fire({
                     title: '<i class="fa fa-check-circle"></i> Guardado',
                     html: '<strong>Los datos han sido guardados exitosamente.</strong>',
                     icon: 'success',
                     confirmButtonText: 'Aceptar'
                 });

                 // Limpiar el formulario después de guardar



                 $('#descripcion').val('');
                 $('#descripDiagnos').val('');
                 $('input[type="radio"]').prop('checked', false); // Desmarca todos los radio buttons
                 $('#unid_id').val(''); // Limpia el campo de Unidad Movil

                 // Actualizar la fecha y hora a la actual
                 var currentDate = new Date();
                 var formattedDate = currentDate.toISOString().slice(0, 10); // YYYY-MM-DD
                 var formattedTime = currentDate.toTimeString().slice(0, 5); // HH:MM

                 $('#fechaIngreso').val(formattedDate);
                 $('#horaIngreso').val(formattedTime);


                 // Deshabilitar el botón "Guardar" y habilitar el botón "Registrar Mecánica"
                 $('#botonGuardar').prop('disabled', true);
                 $('#botonRegistrarMecanica').prop('disabled', false);


             } else {
                 Swal.fire({
                     title: '<i class="fa fa-times-circle"></i> Error',
                     html: '<strong>Hubo un error al guardar los datos. Inténtelo de nuevo.</strong>',
                     icon: 'error',
                     confirmButtonText: 'Aceptar'
                 });
             }
         },
         error: function(error) {
             Swal.fire({
                 title: '<i class="fa fa-times-circle"></i> Error',
                 html: '<strong>Hubo un error al guardar los datos. Inténtelo de nuevo.</strong>',
                 icon: 'error',
                 confirmButtonText: 'Aceptar'
             });
         }

     });


 }



 init();