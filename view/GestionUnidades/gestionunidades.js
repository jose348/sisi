 console.log("si imprime");

 function init() {

     $("#movil_form_modal").on("submit", function(e) {
         guardaryeditar(e);
     });
 }




 function guardaryeditar(e) {
     console.log("test");
     e.preventDefault();
     var formData = new FormData($("#movil_form_modal")[0]);
     console.log(formData);
     $.ajax({
         url: "../../controller/movil.php?op=guardarEditarMovil",
         type: "POST",
         data: formData,
         contentType: false,
         processData: false,
         success: function(data) {
             console.log(data);
             $('#gestionunidades_data').DataTable().ajax.reload(); //para recargar mi tabla
             $('#modalresgitromovil').modal('hide'); //para limpiar mi modal
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

     $('#depe_id').select2({
         dropdownParent: $('#modalresgitromovil')
     });
     combo_area();


     $('#marc_id').select2({
         dropdownParent: $('#modalresgitromovil')

     });
     combo_marca();


     $('#tiun_id').select2({
         dropdownParent: $('#modalresgitromovil')

     });
     combo_tipo();


     $('#colo_id').select2({
         dropdownParent: $('#modalresgitromovil')
     });
     combo_color();

     $('#mode_id').select2({
         dropdownParent: $('#modalresgitromovil')
     });

     $('#comb_id').select2({
         dropdownParent: $('#modalresgitromovil')
     });
     combo_combustible();

     $("#marc_id").change(function() {
         $("#marc_id option:selected").each(function() {
             marc_id = $(this).val();
             combo_modelo2(marc_id); 
         });    
     });


     $('#gestionunidades_data').DataTable({

         "aProcessing": true,
         "aServerSide": true,
         dom: 'Bfrtip',
         buttons: [


         ],

         "ajax": {
             url: "../../controller/movil.php?op=listar",

             type: "post"

         },


         "bDestroy": true,
         "responsive": true,
         "bInfo": true,
         "iDisplayLength": 10,
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

 });



 function combo_area() {
     $.post("../../controller/movil.php?op=combo_area", function(data) {
         $('#depe_id').html(data);
     });
 }

 function combo_marca() {
     $.post("../../controller/movil.php?op=combo_marca", function(data) {
         $('#marc_id').html(data);
     });
 }

 function combo_tipo() {
     $.post("../../controller/movil.php?op=combo_tipo", function(data) {
         $('#tiun_id').html(data);
     });
 }

 function combo_color() {
     $.post("../../controller/movil.php?op=combo_color", function(data) {
         $('#colo_id').html(data);
     });
 }

 function combo_combustible() {
     $.post("../../controller/movil.php?op=combo_combustible", function(data) {
         $('#comb_id').html(data);
     });
 }




 function combo_modelo2(marc_id) {

     $.ajax({
         url: "../../controller/movil.php?op=combo_modelo",
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


 function eliminar(unid_id) {
     swal.fire({
         title: "Elimianr",
         text: "Deseas Eliminar Registro ?",
         icon: "error",
         confirmButtonText: "Si",
         showCancelButton: true,
         cancelButtonText: "No",
     }).then((result) => {
         if (result.value) {
             $.post("../../controller/movil.php?op=eliminarmovil", { unid_id, unid_id }, function(data) { // eliminamos el registro 
                 $('#gestionunidades_data').DataTable().ajax.reload();
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


 function editar(unid_id) {
     $.post("../../controller/movil.php?op=mostrarMovil", { unid_id: unid_id }, function(data) {
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
     $('#modalresgitromovil').modal('show');
 }

 function nuevo() {
     $('#lbltitulo').html('Nuevo Registro');
     $('#movil_form_modal')[0].reset();
     combo_area();
     combo_marca();
     combo_tipo();
     combo_color();
     combo_combustible();
     combo_modelo2();
     $('#modalresgitromovil').modal('show');
 }



 init();