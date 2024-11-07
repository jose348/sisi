$(document).ready(function() {
    // Inicializar Select2 para los combos de Chofer y Ayudante
    $('#chofer').select2({
        placeholder: "Buscar Chofer",
        allowClear: true,
        ajax: {
            url: "../../controller/asignacionrutachofer.php?op=buscar_chofer",
            type: "POST",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return { searchTerm: params.term };
            },
            processResults: function(data) {
                return { results: data };
            },
            cache: true
        }
    });

    $('#ayudante').select2({
        placeholder: "Buscar Ayudante",
        allowClear: true,
        ajax: {
            url: "../../controller/asignacionrutachofer.php?op=buscar_ayudante",
            type: "POST",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return { searchTerm: params.term };
            },
            processResults: function(data) {
                return { results: data };
            },
            cache: true
        }
    });

    cargarRutasDisponibles();

    function cargarRutasDisponibles() {
        $.ajax({
            url: "../../controller/asignacionrutachofer.php?op=listar_rutas",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let html = '';
                data.forEach((ruta) => {
                    html += `<tr>
                                <td>${ruta.ruta}</td>
                                <td>${ruta.hora_inicio}</td>
                                <td>${ruta.hora_fin}</td>
                                <td><input type="radio" name="rutaSeleccionada" value="${ruta.ubic_id}"></td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="verRutaEnMapa(${ruta.ubic_id})">
                                    <i class="fa fa-map"></i> <!-- Icono de mapa -->
                                </button>
                            </td>
                             </tr>`;
                });
                $("#ruta-list").html(html);

                // Inicializar DataTables con el buscador habilitado
                $('#rutaTable').DataTable({
                    "searching": true,
                    "paging": true,
                    "pageLength": 5, // Limita el número de registros visibles a 5
                    "lengthChange": false, // Oculta el selector "Show entries"
                    "ordering": true,
                    "info": false, // Oculta el texto de "Showing X to Y of Z entries"


                    "destroy": true, // Esto permite volver a inicializar DataTables sin error
                    "language": {
                        "search": "Buscar ruta:",
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
                console.error("Error al cargar las rutas:", error);
            }
        });
    }


    let map, geojsonLayer;

    // Inicializa el mapa solo cuando se muestra el modal
    // Inicializa el mapa solo cuando se muestra el modal
    $('#mapModal').on('shown.bs.modal', function() {
        if (!map) {
            map = L.map('map').setView([0, 0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
        } else {
            map.invalidateSize(); // Ajusta el tamaño del mapa cuando se muestra el modal
        }
    });




    // Función para mostrar la ruta en el mapa
    window.verRutaEnMapa = function(ubic_id) {
        $.ajax({
            url: "../../controller/asignacionrutachofer.php?op=obtenerRutaGeoJSON",
            type: "POST",
            data: { ubic_id: ubic_id },
            dataType: "json",
            success: function(response) {
                if (response.success && response.data) {
                    // Mostrar el modal del mapa
                    $('#mapModal').modal('show');

                    // Eliminar la capa anterior si existe
                    if (geojsonLayer) {
                        map.removeLayer(geojsonLayer);
                    }

                    // Crear la nueva capa de GeoJSON
                    geojsonLayer = L.geoJSON(response.data, {
                        style: function() {
                            return {
                                color: "blue",
                                weight: 3,
                                opacity: 0.7,
                                dashArray: "5, 5"
                            };
                        }
                    }).addTo(map);

                    // Ajustar el mapa para mostrar la ruta completa
                    map.fitBounds(geojsonLayer.getBounds());
                } else {
                    console.error("No se encontraron datos de GeoJSON para esta ruta.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener la ruta:", error);
            }
        });
    };





    /*TODO CARGANDO MIS UNIDADES PERO SOLO CON area_id =148 porque solo son de residuos solidos  */
    cargarUnidadesMoviles();

    function cargarUnidadesMoviles() {
        $.ajax({
            url: "../../controller/asignacionrutachofer.php?op=listar_unidades",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let html = '';
                data.forEach((unidad) => {
                    html += `<tr>
                               
                                <td>${unidad.unid_placa}</td>
                                 
                                <td>${unidad.tiun_descripcion}</td>
                                <td>${unidad.marc_descripcion}</td>
                                <td>${unidad.mode_descripcion}</td>
                                 
                                <td><input type="radio" name="unidadSeleccionada" value="${unidad.unid_id}"></td>
                            </tr>`;
                });
                $("#unidades-list").html(html);
                $('#unidadesMovilesTable').DataTable({
                    "searching": true,
                    "paging": true,
                    "pageLength": 5, // Limita el número de registros visibles a 5
                    "lengthChange": false, // Oculta el selector "Show entries"
                    "ordering": true,
                    "info": false, // Oculta el texto de "Showing X to Y of Z entries"
                    "ordering": true,
                    "language": {
                        "search": "Buscar:",
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
                console.error("Error al cargar las unidades móviles:", error);
            }
        });
    }
});