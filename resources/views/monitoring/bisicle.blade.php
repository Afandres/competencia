<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<style>
    #map {
        height: 70vh;
        width: 100%;
    }
</style>

@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Usuarios</h2>
        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
                <script>
                    const originalLatitude = 3.43141; // Latitud del Parque de los Gatos
                    const originalLongitude = -76.52056; // Longitud del Parque de los Gatos

                    // Rango para generar ubicaciones aleatorias
                    const range = 0.01; // Rango en grados (aproximadamente 1.11 km en latitud)
                    const numberOfLocations = 10; // Número de ubicaciones aleatorias a generar

                    // Inicializar el array de destinos
                    const destinations = [
                        { name: "Zoológico de Cali", coords: [3.42766, -76.52203] },
                        { name: "Cristo Rey", coords: [3.43028, -76.54519] }
                    ];

                    // Llenar el array de destinos con ubicaciones aleatorias
                    for (let i = 0; i < numberOfLocations; i++) {
                        const randomLat = originalLatitude + (Math.random() * range * 2) - range;
                        const randomLng = originalLongitude + (Math.random() * range * 2) - range;
                        destinations.push({
                            name: `Destino Aleatorio ${i + 1}`, // Nombre para identificar el destino
                            coords: [randomLat, randomLng]
                        });
                    }

                    const numberOfUsers = 10; // Número de usuarios/bicicletas
                    const markers = []; // Array para almacenar los marcadores

                    var map = L.map('map').setView([originalLatitude, originalLongitude], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    // URL de la imagen de la bicicleta
                    const bikeIcon = L.icon({
                        iconUrl: 'https://img.icons8.com/ios-filled/50/000000/bicycle.png',
                        iconSize: [32, 32], // Tamaño del ícono
                        iconAnchor: [16, 32], // Anclaje del ícono
                        popupAnchor: [0, -32] // Anclaje del popup
                    });

                    // URL de la imagen de la casa
                    const houseIcon = L.icon({
                        iconUrl: 'https://www1.funcionpublica.gov.co/documents/28587425/42384076/logoSena.png/b8131ab9-4c1f-4ef9-8dd4-569d6b7169b6?t=1701956509586', // Cambia esta URL a la imagen de la casa que desees usar
                        iconSize: [32, 32], // Tamaño del ícono
                        iconAnchor: [16, 32], // Anclaje del ícono
                        popupAnchor: [0, -32] // Anclaje del popup
                    });

                    // Agregar marcador de casa en el punto de inicio
                    L.marker([originalLatitude, originalLongitude], { icon: houseIcon }).addTo(map);

                    // Crear marcadores para cada usuario
                    for (let i = 0; i < numberOfUsers; i++) {
                        const marker = L.marker([originalLatitude, originalLongitude], { icon: bikeIcon }).addTo(map);
                        markers.push(marker);
                        moveMarker(marker); // Mover cada marcador
                    }

                    function getRandomDestination() {
                        const randomIndex = Math.floor(Math.random() * destinations.length);
                        return destinations[randomIndex].coords;
                    }

                    function moveMarker(marker) {
                        const destinationCoords = getRandomDestination();

                        // Crear una ruta a un destino aleatorio
                        const routeControl = L.Routing.control({
                            waypoints: [
                                L.latLng(marker.getLatLng().lat, marker.getLatLng().lng),
                                L.latLng(destinationCoords[0], destinationCoords[1])
                            ],
                            routeWhileDragging: false,
                            createMarker: function() {
                                return null; // No mostrar marcadores
                            },
                            show: false // Desactiva la visualización de instrucciones
                        }).addTo(map);

                        routeControl.on('routesfound', function(e) {
                            if (e.routes.length > 0) {
                                const routeCoords = e.routes[0].coordinates;
                                moveMarkerAlongRoute(marker, routeCoords, routeControl);
                            }
                        });
                    }

                    function moveMarkerAlongRoute(marker, routeCoords, routeControl) {
                        const stepTime = 100; // Tiempo entre pasos en milisegundos
                        const totalSteps = routeCoords.length;
                        let step = 0;

                        const interval = setInterval(() => {
                            if (step >= totalSteps) {
                                clearInterval(interval);
                                map.removeControl(routeControl); // Eliminar el control de enrutamiento
                                moveBackToStart(marker); // Mover de regreso al punto de inicio
                                return;
                            }

                            const { lat, lng } = routeCoords[step];
                            marker.setLatLng([lat, lng]);
                            step++;
                        }, stepTime);
                    }

                    function moveBackToStart(marker) {
                        const returnCoords = [originalLatitude, originalLongitude];
                        const returnRoute = L.Routing.control({
                            waypoints: [
                                marker.getLatLng(),
                                L.latLng(returnCoords[0], returnCoords[1])
                            ],
                            routeWhileDragging: false,
                            createMarker: function() {
                                return null; // No mostrar marcadores
                            },
                            show: false // Desactiva la visualización de instrucciones
                        }).addTo(map);

                        returnRoute.on('routesfound', function(e) {
                            if (e.routes.length > 0) {
                                const routeCoords = e.routes[0].coordinates;
                                moveMarkerAlongRoute(marker, routeCoords, returnRoute);
                            }
                        });

                        // Al llegar al punto de inicio, enviar nuevamente al marcador a un destino aleatorio
                        returnRoute.on('routesfound', function(e) {
                            if (e.routes.length > 0) {
                                const routeCoords = e.routes[0].coordinates;
                                moveMarkerAlongRoute(marker, routeCoords, returnRoute); // Mueve de regreso al punto de inicio
                                setTimeout(() => moveMarker(marker), 2000); // Espera 2 segundos antes de enviar a un nuevo destino
                            }
                        });
                    }
                </script>


        </div>
    </div>
@endsection
