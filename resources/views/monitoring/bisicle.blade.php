@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Bicicletas Alquiladas</h2>
    <div class="card">
        <div class="card-body">
            <div id="map" style="height: 400px;"></div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const originalLatitude = 3.43141; // Latitud del Parque de los Gatos
        const originalLongitude = -76.52056; // Longitud del Parque de los Gatos

        // Inicializa el mapa solo después de que el DOM esté listo
        var map = L.map('map').setView([originalLatitude, originalLongitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const bikeIcon = L.icon({
            iconUrl: 'https://img.icons8.com/ios-filled/50/000000/bicycle.png',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        // Obtener los alquileres desde el servidor (enviados como JSON desde el controlador)
        const rentals = @json($rentals);

        // Crear marcadores y rutas para cada bicicleta alquilada con simulación de movimiento
        rentals.forEach(rental => {
            const startLat = rental.start_latitude; // Latitud de inicio
            const startLng = rental.start_longitude; // Longitud de inicio
            const endLat = rental.end_latitude; // Latitud de destino
            const endLng = rental.end_longitude; // Longitud de destino

            // Crear marcador de inicio
            const bikeMarker = L.marker([startLat, startLng], { icon: bikeIcon }).addTo(map);
            
            bikeMarker.bindPopup(`
                <b>Bicicleta: ${rental.bicycle.brand}</b><br>
                Usuario: ${rental.person.name}<br>
                Estado: ${rental.state}
            `);

            // Si tienes coordenadas de destino, crear la ruta
            if (endLat && endLng) {
                const routeControl = L.Routing.control({
                    waypoints: [
                        L.latLng(startLat, startLng), // Punto de partida
                        L.latLng(endLat, endLng) // Punto de destino
                    ],
                    routeWhileDragging: false,
                    show: false, 
                    createMarker: function() { return null; } // No crear marcadores adicionales
                }).addTo(map);

                // Simular movimiento de la bicicleta a lo largo de la ruta
                routeControl.on('routesfound', function(e) {
                    let route = e.routes[0];
                    let coordinates = route.coordinates;
                    let i = 0;

                    // Actualizar la posición del marcador en intervalos de tiempo
                    let moveBike = setInterval(function() {
                        if (i < coordinates.length) {
                            bikeMarker.setLatLng([coordinates[i].lat, coordinates[i].lng]);
                            i++;
                        } else {
                            clearInterval(moveBike); // Detener la simulación cuando termine la ruta
                        }
                    }, 100); // Intervalo de 100ms entre actualizaciones
                });
            }
        });
    });
</script>
@endsection
