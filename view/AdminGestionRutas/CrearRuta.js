let map, userMarker;
let drawnPolyline = null;
let routeCoordinates = [];

const defaultLat = -6.771522781475656;
const defaultLng = -79.84315174789913;

document.addEventListener("DOMContentLoaded", function() {
    initMap(defaultLat, defaultLng);


    $('#horarioSelect').select2(); // Inicializa Select2
    cargarHorarios(); // Cargar horarios desde el backend
});
// Cargar horarios desde el backend y añadirlos al select2
function cargarHorarios() {
    fetch('../../controller/rutas.php?op=obtenerHorarios')
        .then(response => response.json())
        .then(data => {
            const horarioSelect = document.getElementById('horarioSelect');
            data.forEach(horario => {
                const option = document.createElement('option');
                option.value = horario.hora_id;
                option.textContent = `${horario.hora_titulo} (${horario.hora_inicio} - ${horario.hora_fin})`;
                horarioSelect.appendChild(option);
            });

            // Refrescar Select2 para que muestre las opciones cargadas
            $('#horarioSelect').trigger('change');
        })
        .catch(error => console.error('Error al cargar horarios:', error));
}




function initMap(lat, lng) {
    map = L.map('map').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    userMarker = L.marker([lat, lng], { title: "Ubicación inicial" }).addTo(map)
        .bindPopup('Ubicación inicial.').openPopup();

    // Evento para capturar clics en el mapa
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;
        routeCoordinates.push([lat, lng]);

        if (drawnPolyline) {
            map.removeLayer(drawnPolyline); // Elimina la línea anterior
        }

        // Crear una polilínea punteada con estilo
        drawnPolyline = L.polyline(routeCoordinates, {
            color: 'blue', // Color de la línea
            weight: 3, // Grosor de la línea
            dashArray: '10, 10', // Patrón de puntos: 10px línea, 10px espacio
            lineJoin: 'round' // Esquinas redondeadas en la línea
        }).addTo(map);

        // Llamar a la función de geocodificación inversa
        obtenerNombreCalle(lat, lng);
    });
}

// Función para mostrar las coordenadas y nombres de calle en el textarea
function mostrarCoordenadasEnTextarea(nombreCalle, lat, lng) {
    const textarea = document.getElementById('ubicacionesSeleccionadas');
    const texto = `Calle: ${nombreCalle || 'Desconocida'}, Lat: ${lat}, Lng: ${lng}\n`;
    textarea.value += texto; // Añade la nueva línea al textarea
}

// Función para obtener el nombre de la calle a partir de las coordenadas
function obtenerNombreCalle(lat, lng) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Intentar obtener el nombre de la calle o alguna información alternativa
            const nombreCalle = data.address.road ||
                data.address.neighbourhood ||
                data.address.suburb ||
                data.address.city ||
                'Desconocida';
            mostrarCoordenadasEnTextarea(nombreCalle, lat, lng);
        })
        .catch(error => {
            console.error('Error al obtener el nombre de la calle:', error);
            mostrarCoordenadasEnTextarea('Desconocida', lat, lng);
        });
}






function guardarRuta() {
    const nombre = document.getElementById('nombreRuta').value;
    const estado = document.getElementById('estadoRuta').value;

    if (!nombre || routeCoordinates.length === 0) {
        alert('Por favor, completa los campos y dibuja una ruta.');
        return;
    }

    console.log('Nombre:', nombre);
    console.log('Estado:', estado);
    console.log('Coordenadas:', routeCoordinates);

    fetch('/public/index.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                nombre: nombre,
                estado: estado,
                coordenadas: routeCoordinates
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Ruta guardada correctamente.');
                routeCoordinates = [];
                if (drawnPolyline) map.removeLayer(drawnPolyline);
                document.getElementById('ubicacionesSeleccionadas').value = ''; // Limpiar textarea
            } else {
                alert('Error al guardar la ruta.');
            }
        })
        .catch(error => console.error('Error:', error));
}