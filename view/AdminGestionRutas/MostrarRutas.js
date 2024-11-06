let map;
let drawnPolyline = null;
let editMode = false; // Modo edición
let routeCoordinates = []; // Coordenadas de la ruta

document.addEventListener("DOMContentLoaded", function() {
    initMap();
    cargarRutas();
    cargarHorarios();
    document.getElementById('editarRuta').addEventListener('click', habilitarEdicion);
    document.getElementById('guardarCambiosRuta').addEventListener('click', guardarCambiosRuta);
    document.getElementById('eliminarRuta').addEventListener('click', eliminarRuta);
    document.getElementById('limpiarRuta').addEventListener('click', limpiarRuta);
});

// Inicializa el mapa con Leaflet
function initMap() {
    map = L.map('map').setView([-6.771522781475656, -79.84315174789913], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
}

// Cargar las rutas y llenar el select
function cargarRutas() {
    const rutaSelect = document.getElementById('rutaSelect');
    rutaSelect.innerHTML = '<option value="">Seleccione una ruta</option>';

    fetch('../../controller/rutas.php?op=obtenerRutas')
        .then(response => response.json())
        .then(data => {
            data.forEach(ruta => {
                const option = document.createElement('option');
                option.value = ruta.ubic_id;
                option.textContent = ruta.ubic_nombre;
                option.dataset.geojson = ruta.ubic_geojson;
                option.dataset.horarioId = ruta.hora_id;
                rutaSelect.appendChild(option);
            });

            rutaSelect.addEventListener('change', mostrarRutaEnMapa);
        })
        .catch(error => console.error('Error al cargar rutas:', error));
}

// Cargar los horarios
function cargarHorarios() {
    fetch('../../controller/rutas.php?op=obtenerHorarios')
        .then(response => response.json())
        .then(data => {
            const horarioSelect = document.getElementById('horarioSelectEditar');
            horarioSelect.innerHTML = '<option value="">Seleccione un horario</option>';

            data.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario.hora_id;
                option.textContent = `${horario.hora_titulo} (${horario.hora_inicio} - ${horario.hora_fin})`;
                horarioSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar horarios:', error));
}

// Mostrar la ruta seleccionada en el mapa
function mostrarRutaEnMapa() {
    const selectedOption = document.getElementById('rutaSelect').selectedOptions[0];
    const geojson = JSON.parse(selectedOption.dataset.geojson);
    const horarioId = selectedOption.dataset.horarioId;

    document.getElementById('nombreRutaEditar').value = selectedOption.textContent;
    document.getElementById('horarioSelectEditar').value = horarioId;

    if (drawnPolyline) {
        map.removeLayer(drawnPolyline);
    }

    const coordinates = geojson.features[0].geometry.coordinates.map(coord => [coord[1], coord[0]]);
    routeCoordinates = coordinates;
    drawnPolyline = L.polyline(coordinates, { color: 'blue', weight: 3, dashArray: '10, 10' }).addTo(map);

    map.fitBounds(drawnPolyline.getBounds());
}

// Habilitar edición
function habilitarEdicion() {
    const rutaId = document.getElementById('rutaSelect').value;
    if (!rutaId) {
        Swal.fire('Error', 'Seleccione una ruta para editar.', 'error');
        return;
    }

    editMode = true;
    document.getElementById('nombreRutaEditar').disabled = false;
    document.getElementById('horarioSelectEditar').disabled = false;
    document.getElementById('guardarCambiosRuta').style.display = 'inline-block';
    map.on('click', agregarPuntoALinea);
}

// Agregar punto al hacer clic en el mapa
function agregarPuntoALinea(e) {
    if (editMode) {
        routeCoordinates.push([e.latlng.lat, e.latlng.lng]);

        if (drawnPolyline) {
            map.removeLayer(drawnPolyline);
        }

        drawnPolyline = L.polyline(routeCoordinates, { color: 'blue', weight: 3, dashArray: '10, 10' }).addTo(map);
    }
}

// Guardar cambios de la ruta
function guardarCambiosRuta() {
    const rutaId = document.getElementById('rutaSelect').value;
    const nuevoNombre = document.getElementById('nombreRutaEditar').value;
    const nuevoHorarioId = document.getElementById('horarioSelectEditar').value;

    if (!rutaId || !nuevoNombre || !nuevoHorarioId) {
        Swal.fire('Error', 'Complete todos los campos.', 'error');
        return;
    }

    const nuevoGeojson = {
        type: "FeatureCollection",
        features: [{
            type: "Feature",
            properties: {},
            geometry: {
                type: "LineString",
                coordinates: routeCoordinates.map(coord => [coord[1], coord[0]])
            }
        }]
    };

    fetch('../../controller/rutas.php?op=editarRuta', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: rutaId,
                nombre: nuevoNombre,
                horarioId: nuevoHorarioId,
                geojson: JSON.stringify(nuevoGeojson)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Éxito', 'Ruta editada correctamente.', 'success');
                actualizarRutaEnSelect(rutaId, nuevoNombre, nuevoGeojson);
                resetEditar();
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => console.error('Error:', error));
}

// Actualizar la ruta en el select
function actualizarRutaEnSelect(id, nuevoNombre, nuevoGeojson) {
    const option = document.querySelector(`option[value="${id}"]`);
    if (option) {
        option.textContent = nuevoNombre;
        option.dataset.geojson = JSON.stringify(nuevoGeojson);
    }
}

// Limpiar la ruta
function limpiarRuta() {
    if (drawnPolyline) {
        map.removeLayer(drawnPolyline);
        drawnPolyline = null;
        routeCoordinates = [];
    }
    editMode = true;
    Swal.fire('Limpieza', 'La ruta ha sido limpiada. Ahora puede volver a trazar.', 'info');
    map.on('click', agregarPuntoALinea);
}

// Resetear edición
function resetEditar() {
    editMode = false;
    document.getElementById('nombreRutaEditar').disabled = true;
    document.getElementById('horarioSelectEditar').disabled = true;
    document.getElementById('guardarCambiosRuta').style.display = 'none';
    map.off('click', agregarPuntoALinea);
}

// Eliminar ruta
function eliminarRuta() {
    const rutaId = document.getElementById('rutaSelect').value;
    if (!rutaId) {
        Swal.fire('Error', 'Seleccione una ruta para eliminar.', 'error');
        return;
    }

    Swal.fire({
        title: '¿Está seguro?',
        text: 'No podrás revertir esto.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../../controller/rutas.php?op=eliminarRuta', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ id: rutaId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Eliminado', 'Ruta eliminada correctamente.', 'success');
                        eliminarRutaDelSelect(rutaId);
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
}

// Eliminar la ruta del select
function eliminarRutaDelSelect(id) {
    const option = document.querySelector(`option[value="${id}"]`);
    if (option) {
        option.remove();
    }
}