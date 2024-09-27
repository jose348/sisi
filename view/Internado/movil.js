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


 /*TODO aqui va todo */



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


     /*TODO aqui llenamos los combos de mi formulario tickets   */

     combo_lubricador_mecanico();




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
             var iconSteps = ['fa-car', 'fa-credit-card', 'fa-check-circle']; // Añade tus íconos aquí
             $('#wizard1 .steps ul li').each(function(index) {
                 $(this).find('.icon i').attr('class', 'fa ' + iconSteps[index]);
             });
             return true;
         },
         onInit: function(event, currentIndex) {
             var iconSteps = ['fa-car', 'fa-credit-card', 'fa-check-circle']; // Añade tus íconos aquí
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
         }).fail(function(xhr, status, error) {
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


 /*  function guardar() {
      // Obtener los datos del formulario principal
      var fechaIngreso = $('#fechaIngreso').val();
      var horaIngreso = $('#horaIngreso').val();
      var diagnostico = $('#descripcion').val();
      var diagnosticoEspecializado = $('#descripDiagnos').val();
      var fechaDiagnostico = $('#fechaDiagnostico').val();
      var MovilSeleccionadacombo = $('#unid_id').val();
      var MovileSeleccionadoNuevo = MovilSeleccionadacombo.split("/")[0].trim();
      var estadoVehiculo = $('input[name="estado"]:checked').val();
      var estadoValor = (estadoVehiculo === 'Activo') ? 1 : 0;

      // Verificar si los campos requeridos están completos
      if (!fechaIngreso || !horaIngreso || !diagnostico || !diagnosticoEspecializado || !fechaDiagnostico || !MovileSeleccionadoNuevo) {
          Swal.fire({
              title: '<i class="fa fa-exclamation-circle"></i> Error',
              html: '<strong>Faltan datos requeridos. Por favor completa todos los campos.</strong>',
              icon: 'warning',
              confirmButtonText: 'Aceptar'
          });
          return;
      }

      // Enviar la solicitud para guardar el ingreso de vehículo
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
              inun_estado: estadoValor
          },
          success: function(response) {
              var respuesta = JSON.parse(response);

              if (respuesta.success) {
                  // Obtener el `inun_id` desde la respuesta
                  var inun_id = respuesta.inun_id;

                  // Establecer el valor del campo oculto en el formulario de ticket
                  $('#inun_id_ticket').val(inun_id);

                  // Mostrar mensaje de éxito
                  Swal.fire({
                      title: '<i class="fa fa-check-circle"></i> Guardado',
                      html: '<strong>Los datos han sido guardados exitosamente.</strong>',
                      icon: 'success',
                      confirmButtonText: 'Aceptar'
                  });

                  // Limpiar los campos del formulario
                  $('#descripcion').val('');
                  $('#descripDiagnos').val('');
                  $('input[type="radio"]').prop('checked', false);
                  $('#unid_id').val('');

                  // Restablecer la fecha y hora actuales en los campos de ingreso
                  var currentDate = new Date();
                  $('#fechaIngreso').val(currentDate.toISOString().slice(0, 10));
                  $('#horaIngreso').val(currentDate.toTimeString().slice(0, 5));

                  // Deshabilitar el botón Guardar y habilitar el botón de registrar mecánica
                  $('#botonGuardar').prop('disabled', true);
                  $('#botonRegistrarMecanica').prop('disabled', false);

                  // Habilitar el botón para guardar ticket
                  $('#guardarButton').prop('disabled', false); // Habilitar el botón de guardar ticket

              } else {
                  // Mostrar mensaje de error
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
  } */

 function guardar() {
     // Obtener los datos del formulario
     var fechaIngreso = $('#fechaIngreso').val();
     var horaIngreso = $('#horaIngreso').val();
     var diagnostico = $('#descripcion').val();
     var diagnosticoEspecializado = $('#descripDiagnos').val();
     var fechaDiagnostico = $('#fechaDiagnostico').val();
     var MovilSeleccionado = $('#unid_id').val();
     var estadoVehiculo = $('input[name="estado"]:checked').val();
     var estadoValor = (estadoVehiculo === 'Activo') ? 1 : 0;

     // Validar que los campos requeridos estén completos
     if (!fechaIngreso || !horaIngreso || !diagnostico || !MovilSeleccionado) {
         Swal.fire({
             title: '<i class="fa fa-exclamation-circle"></i> Error',
             html: '<strong>Faltan datos requeridos. Por favor completa todos los campos.</strong>',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         });
         return;
     }

     // Enviar el formulario mediante AJAX
     $.ajax({
         url: '../../controller/intermovilregistro.php?op=guardar_ing_vehi', // Reemplaza con la URL adecuada
         type: 'POST',
         data: {
             inun_fecha: fechaIngreso,
             inun_hora: horaIngreso,
             inun_diagnostico: diagnostico,
             unid_id: MovilSeleccionado,
             inun_diagnostico_especializado: diagnosticoEspecializado,
             inun_fecha_diagnostico_especializado: fechaDiagnostico,
             inun_estado: estadoValor
         },
         success: function(response) {
             var respuesta = JSON.parse(response);

             if (respuesta.success) {
                 // Mostrar mensaje de éxito con SweetAlert
                 Swal.fire({
                     title: '<i class="fa fa-check-circle"></i> Guardado',
                     html: '<strong>Los datos se han guardado correctamente.</strong>',
                     icon: 'success',
                     confirmButtonText: 'Aceptar'
                 });
                 // Limpiar los campos del formulario
                 $('#descripcion').val('');
                 $('#descripDiagnos').val('');
                 $('input[type="radio"]').prop('checked', false);
                 $('#unid_id').val('');

                 // Restablecer la fecha y hora actuales en los campos de ingreso
                 var currentDate = new Date();
                 $('#fechaIngreso').val(currentDate.toISOString().slice(0, 10));
                 $('#horaIngreso').val(currentDate.toTimeString().slice(0, 5));

                 // Deshabilitar el botón Guardar y habilitar el botón de registrar mecánica
                 $('#botonGuardar').prop('disabled', true);
                 $('#botonRegistrarMecanica').prop('disabled', false);

                 // Obtener el último inun_id tras el guardado y mostrarlo en el input de id_unidad
                 obtenerUltimoIngresoUnidad();

             } else {
                 Swal.fire({
                     title: '<i class="fa fa-times-circle"></i> Error',
                     html: '<strong>Hubo un error al guardar los datos. Inténtelo de nuevo.</strong>',
                     icon: 'error',
                     confirmButtonText: 'Aceptar'
                 });
             }
         },
         error: function() {
             Swal.fire({
                 title: '<i class="fa fa-times-circle"></i> Error',
                 html: '<strong>Hubo un error al guardar los datos. Inténtelo de nuevo.</strong>',
                 icon: 'error',
                 confirmButtonText: 'Aceptar'
             });
         }
     });
 }






 // Función para llenar el campo "Vehículo" con la descripción completa
 function updateVehiculoName() {
     var selectedValue = document.getElementById("unid_id").value;

     // Verificar si la opción seleccionada contiene la descripción completa
     if (selectedValue.includes(" / ")) {
         var description = selectedValue.split(" / ").slice(1).join(" / ");
         document.getElementById("vehiculo").value = description;
     } else {
         // Si no contiene la descripción completa, dejamos el campo vacío
         document.getElementById("vehiculo").value = "";
     }
 }


 /*TODO AHORA TRABAJAMDS CON EL FORMULARIO TICKETS */
 /*TODO AHORA TRABAJAMDS CON EL FORMULARIO TICKETS */
 /*TODO =========================================================== 
  =======================================================AREGAMOS LOC COMBOS DE LOS IPO DE COMPONENSTE */
 $(document).ready(function() {
     // Cargar el primer combo cuando se cargue la página
     combo_tipo_componente();

     // Evento para cuando cambie el valor en el combo de 'Tipo de Componente'
     $('#componente').on('change', function() {
         var componente_id = $(this).val(); // Obtener el valor seleccionado

         if (componente_id !== '') {
             // Llamar a la función para llenar el combo de componente específico
             combo_tipo_componente_especifico(componente_id);

             // Habilitar el campo de cantidad
             $('#cantidad').prop('disabled', false);
         } else {
             // Si no hay nada seleccionado, deshabilitar el segundo combo e input de cantidad
             $('#Componente_espec').prop('disabled', true);
             $('#cantidad').prop('disabled', true);
         }
     });
 });

 // Función para llenar el combo de tipo componente
 function combo_tipo_componente() {
     $.post("../../controller/intermovilregistro.php?op=combo_tipo_componente", function(data) {
         $('#componente').html(data); // Rellenar el combo con los datos obtenidos
     }).fail(function() {
         alert('Error al cargar los componentes');
     });
 }



 // Función para llenar el combo de componente específico según el componente seleccionado
 function combo_tipo_componente_especifico(componente_id) {
     $.post("../../controller/intermovilregistro.php?op=combo_tipo_componente_especifico", { componente_id: componente_id }, function(data) {
         $('#Componente_espec').html(data); // Rellenar el combo con los datos obtenidos
         $('#Componente_espec').prop('disabled', false); // Habilitar el combo
     }).fail(function() {
         alert('Error al cargar los componentes específicos');
     });
 }

 function combo_lubricador_mecanico() {
     $.post("../../controller/intermovilregistro.php?op=combo_lubricador_mecanico", function(data) {
         console.log("Respuesta del servidor: ", data); // Verifica la respuesta aquí
         $('#responsable').html(data); // Llena el <select> con los datos recibidos
     }).fail(function(jqXHR, textStatus, errorThrown) {
         console.error("Error al cargar los responsables: " + textStatus);
     });
 }





 /*TODO para validar que el responble y el token coincidad  */
 // Evento cuando se selecciona un responsable
 // Evento cuando se selecciona un responsable o cuando se ingresa el token
 // Variable para controlar si ya se mostró la alerta de error
 // Variable para controlar si ya se mostró la alerta de error
 var errorAlertShown = false;
 var debounceTimer;

 function confirmarToken() {
     clearTimeout(debounceTimer);

     debounceTimer = setTimeout(function() {
         var direct_id = $('#responsable').val();
         var token = $('#token').val();

         if (direct_id && token.length > 0) {
             $.ajax({
                 url: "../../controller/intermovilregistro.php?op=validar_token",
                 type: "POST",
                 data: {
                     direct_id: direct_id,
                     token: token
                 },
                 beforeSend: function() {
                     $('#ticketButton').html('<i class="fa fa-spinner fa-spin"></i> Validando...');
                     $('#guardarButton').prop('disabled', true);
                     $('#ticketButton').prop('disabled', true);
                     errorAlertShown = false;
                 },
                 success: function(response) {
                     var result = JSON.parse(response);

                     if (result.status === 'success') {
                         // Habilitar el botón Guardar
                         $('#guardarButton').prop('disabled', false);
                         $('#ticketButton').html('<i class="fa fa-ticket"></i> Ticket');
                         errorAlertShown = false;
                     } else {
                         if (!errorAlertShown) {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Error',
                                 text: result.message
                             });
                             errorAlertShown = true;
                         }
                         $('#guardarButton').prop('disabled', true);
                         $('#ticketButton').html('<i class="fa fa-ticket"></i> Ticket');
                     }
                 },
                 error: function() {
                     if (!errorAlertShown) {
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: 'Ocurrió un error en la validación del token'
                         });
                         errorAlertShown = true;
                     }
                     $('#guardarButton').prop('disabled', true);
                     $('#ticketButton').html('<i class="fa fa-ticket"></i> Ticket');
                 }
             });
         } else {
             $('#guardarButton').prop('disabled', true);
             $('#ticketButton').html('<i class="fa fa-ticket"></i> Ticket');
         }
     }, 500);
 }




 /*TODO generara el codigo del ticket */
 function cargarCodigoTicket() {
     // Hacer una solicitud AJAX para obtener el nuevo número de ticket
     $.ajax({
         url: "../../controller/intermovilregistro.php?op=generar_codigo_ticket",
         type: "POST",
         success: function(response) {
             var result = JSON.parse(response);
             if (result.codigo_ticket) {
                 // Mostrar el número de ticket en el campo correspondiente
                 $('#ticketNumber').val(result.codigo_ticket);
             }
         },
         error: function() {
             console.error('Error al generar el código del ticket');
         }
     });
 }

 // Llamar a esta función cuando se cargue el formulario
 $(document).ready(function() {
     cargarCodigoTicket();
 });



 /*TODO buscamos el dni del chofer */
 // Función para buscar chofer por DNI
 function buscarChoferPorDNI() {
     var dni = $('#dniChoferInput').val();

     if (dni.length === 8) {
         // Hacer la solicitud AJAX para obtener el `pers_id`
         $.ajax({
             url: '../../controller/intermovilregistro.php?op=buscar_chofer_por_dni', // Cambiar por la URL adecuada
             type: 'POST',
             data: { dni: dni },
             success: function(response) {
                 var respuesta = JSON.parse(response);
                 if (respuesta.length > 0) {
                     // Llenar los campos con el nombre del chofer y el `pers_id`
                     $('#nombreChofer').val(respuesta[0].nombre_completo);
                     $('#pers_id').val(respuesta[0].pers_id); // Aquí se guarda el ID del chofer en el campo oculto
                 } else {
                     Swal.fire({
                         title: 'Chofer no encontrado',
                         text: 'No se encontró un chofer con ese DNI.',
                         icon: 'warning',
                         confirmButtonText: 'Aceptar'
                     });
                 }
             },
             error: function() {
                 Swal.fire({
                     title: 'Error',
                     text: 'Ocurrió un error al buscar el chofer.',
                     icon: 'error',
                     confirmButtonText: 'Aceptar'
                 });
             }
         });
     }
 }






 /*TODO OBTENIENDO EL ULTIMO  ID unid_id */

 function obtenerUltimoIngresoUnidad() {
     $.ajax({
         url: '../../controller/intermovilregistro.php?op=obtener_ultimo_inun_id', // URL del backend que obtiene el último inun_id
         type: 'GET',
         success: function(response) {
             var respuesta = JSON.parse(response);

             if (respuesta.success) {
                 // Mostrar el último inun_id en el campo correspondiente
                 $('#id_unidad').val(respuesta.ultimo_inun_id);
             } else {
                 Swal.fire({
                     title: '<i class="fa fa-times-circle"></i> Error',
                     html: '<strong>No se pudo obtener el último inun_id.</strong>',
                     icon: 'error',
                     confirmButtonText: 'Aceptar'
                 });
             }
         },
         error: function() {
             Swal.fire({
                 title: '<i class="fa fa-times-circle"></i> Error',
                 html: '<strong>Error en la solicitud para obtener el último inun_id.</strong>',
                 icon: 'error',
                 confirmButtonText: 'Aceptar'
             });
         }
     });
 }



 /*TODO GUARDANDOE EL TICKETE */

 function guardarFormulario() {
     // Obtener los datos del formulario
     var idUnidad = $('#id_unidad').val();
     var ticketNumber = $('#ticketNumber').val();
     var fecha = $('#fecha').val();
     var horaIngreso = $('#horaIngreso').val();
     var componenteEspecifico = $('#Componente_espec').val(); // coti_id
     var cantidad = $('#cantidad').val();
     var pers_id = $('#pers_id').val(); // Usar el pers_id del campo oculto, no el DNI
     var responsable = $('#responsable').val(); // direct_id

     // Validar que todos los campos requeridos estén completos
     if (!fecha || !horaIngreso || !componenteEspecifico || !cantidad || !pers_id || !responsable || !idUnidad) {
         Swal.fire({
             title: '<i class="fa fa-exclamation-circle"></i> Error',
             html: '<strong>Faltan datos requeridos. Por favor completa todos los campos.</strong>',
             icon: 'warning',
             confirmButtonText: 'Aceptar'
         });
         return;
     }

     // Enviar los datos mediante AJAX
     $.ajax({
         url: '../../controller/intermovilregistro.php?op=guardar_ticket', // Cambiar por la URL adecuada
         type: 'POST',
         data: {
             ticketNumber: ticketNumber,
             fecha: fecha,
             horaIngreso: horaIngreso,
             coti_id: componenteEspecifico, // Guardamos el coti_id que asocia al componente
             cantidad: cantidad,
             pers_id: pers_id, // Aquí usamos el pers_id del chofer
             direct_id: responsable, // Se pasa el direct_id asociado al responsable
             inun_id: idUnidad // Se pasa el inun_id, que es el último ID del ingreso de unidad
         },
         success: function(response) {
             var respuesta = JSON.parse(response);

             if (respuesta.success) {
                 // Mostrar mensaje de éxito
                 Swal.fire({
                     title: '<i class="fa fa-check-circle"></i> Guardado',
                     html: '<strong>El ticket se ha guardado correctamente.</strong>',
                     icon: 'success',
                     confirmButtonText: 'Aceptar'
                 });

                 // Deshabilitar los campos y botones
                 $('#guardarButton').prop('disabled', true); // Deshabilitar el botón de guardar
                 $('#imprimirTicketButton').prop('disabled', false); // Habilitar el botón de imprimir

                 // Deshabilitar los campos del formulario
                 $('#fecha').prop('disabled', true);
                 $('#horaIngreso').prop('disabled', true);
                 $('#componente').prop('disabled', true);
                 $('#Componente_espec').prop('disabled', true);
                 $('#cantidad').prop('disabled', true);
                 $('#dniChoferInput').prop('disabled', true);
                 $('#nombreChofer').prop('disabled', true);
                 $('#responsable').prop('disabled', true);
                 $('#token').prop('disabled', true);
             } else {
                 Swal.fire({
                     title: '<i class="fa fa-times-circle"></i> Error',
                     html: '<strong>No se pudo guardar el ticket. Inténtelo de nuevo.</strong>',
                     icon: 'error',
                     confirmButtonText: 'Aceptar'
                 });
             }
         },
         error: function() {
             Swal.fire({
                 title: '<i class="fa fa-times-circle"></i> Error',
                 html: '<strong>Error al intentar guardar los datos. Inténtelo de nuevo.</strong>',
                 icon: 'error',
                 confirmButtonText: 'Aceptar'
             });
         }
     });
 }




 /*TODO a generamos el ticket en pdf */

 // JS para imprimir el ticket en formato PDF
 function imprimirTicket() {
     var ticketNumber = $('#ticketNumber').val();

     // Redirigir a la página que genera el PDF con los datos pasados en la URL
     window.open('../../controller/intermovilregistro.php?op=generar_ticket_pdf&ticketNumber=' + ticketNumber, '_blank');
     limpiarCamposFormulario();
 }


 function limpiarCamposFormulario() {
     // Limpiar los campos del formulario
     $('#fecha').val('');
     $('#horaIngreso').val('');
     $('#componente').val('');
     $('#Componente_espec').val('');
     $('#cantidad').val('');
     $('#dniChoferInput').val('');
     $('#nombreChofer').val('');
     $('#responsable').val('');
     $('#token').val('');

     // Habilitar los campos del formulario para un nuevo ingreso
     $('#fecha').prop('disabled', false);
     $('#horaIngreso').prop('disabled', false);
     $('#componente').prop('disabled', false);
     $('#Componente_espec').prop('disabled', false);
     $('#cantidad').prop('disabled', false);
     $('#dniChoferInput').prop('disabled', false);
     $('#nombreChofer').prop('disabled', false);
     $('#responsable').prop('disabled', false);
     $('#token').prop('disabled', false);

     // Volver a habilitar el botón de guardar y deshabilitar el botón de imprimir
     $('#guardarButton').prop('disabled', false);
     $('#imprimirTicketButton').prop('disabled', true);
 }



 init();