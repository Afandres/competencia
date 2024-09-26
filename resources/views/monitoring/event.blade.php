<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<style>
    #map {
        height: 100vh;
        width: 100%;
    }
</style>

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Columna para la lista de eventos -->
            <div class="col-md-4">
                <h2>Lista de Eventos</h2>
                <div class="list-group">
                    @forelse ($items as $item)
                        <a href="event?start_latitude={{ $item->start_latitude }}&start_longitude={{ $item->start_longitude }}&end_latitude={{ $item->end_latitude }}&end_longitude={{ $item->end_longitude }}"
                            class="list-group-item list-group-item-action">{{ $item->name }}</a>
                    @empty
                        <p>No existen eventos registrados</p>
                    @endforelse

                </div>
            </div>

            <!-- Columna para el mapa -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="height: 600px;"></div>
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                        <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
                        <script>
                            // Constantes para configuración del mapa
                            const MAP_CENTER = [3.43141, -76.52056];
                            const ZOOM_LEVEL = 13;
                            const TILE_LAYER_URL = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                            const MAX_ZOOM = 19;
                            const BIKE_ICON_URL = 'https://img.icons8.com/ios-filled/50/000000/bicycle.png';
                            const ICON_SIZE = [32, 32];
                            const ICON_ANCHOR = [16, 32];
                            const POPUP_ANCHOR = [0, -32];
                            const STEP_TIME = 100; // Tiempo entre pasos en milisegundos
                        
                            const map = L.map('map').setView(MAP_CENTER, ZOOM_LEVEL); // Configura el mapa
                        
                            // Capa de mosaico
                            L.tileLayer(TILE_LAYER_URL, {
                                maxZoom: MAX_ZOOM,
                                attribution: '© OpenStreetMap'
                            }).addTo(map);
                        
                            // URL de la imagen de la bicicleta
                            const bikeIcon = L.icon({
                                iconUrl: BIKE_ICON_URL,
                                iconSize: ICON_SIZE,
                                iconAnchor: ICON_ANCHOR,
                                popupAnchor: POPUP_ANCHOR
                            });
                        
                            let movingMarker = null; // Marcador en movimiento
                            let routeControl = null; // Control de enrutamiento
                        
                            const search = window.location.search;
                        
                            // Asegurarse de que hay parámetros en la URL después del '?'
                            let startLatitude, startLongitude, endLatitude, endLongitude;
                            if (search) {
                                const urlParams = new URLSearchParams(search);
                        
                                startLatitude = urlParams.get('start_latitude');
                                startLongitude = urlParams.get('start_longitude');
                                endLatitude = urlParams.get('end_latitude');
                                endLongitude = urlParams.get('end_longitude');
                        
                                if (startLatitude && startLongitude && endLatitude && endLongitude) {
                                    console.log('Start Latitude:', startLatitude);
                                    console.log('Start Longitude:', startLongitude);
                                    console.log('End Latitude:', endLatitude);
                                    console.log('End Longitude:', endLongitude);
                                } else {
                                    console.error('Error: Falta uno o más parámetros en la URL.');
                                }
                            }
                        
                            // Asegúrate de que las coordenadas no sean null antes de intentar usarlas
                            if (startLatitude && startLongitude && endLatitude && endLongitude) {
                                // Array que define la ruta de movimiento [Inicio, Fin]
                                const routePoints = [
                                    L.latLng(startLatitude, startLongitude), // Inicio
                                    L.latLng(endLatitude, endLongitude) // Fin
                                ];
                        
                                // Función para crear la ruta desde el array
                                function createRouteFromArray(points) {
                                    if (routeControl) {
                                        map.removeControl(routeControl); // Elimina la ruta anterior si existe
                                    }
                        
                                    // Crea una nueva ruta con los puntos del array
                                    routeControl = L.Routing.control({
                                        waypoints: points,
                                        routeWhileDragging: false,
                                        createMarker: function() {
                                            return null; // No mostrar marcadores
                                        }
                                    }).addTo(map);
                        
                                    // Iniciar el movimiento del marcador
                                    routeControl.on('routesfound', function(e) {
                                        if (e.routes.length > 0) {
                                            const routeCoords = e.routes[0].coordinates;
                                            moveMarker(routeCoords);
                                        }
                                    });
                                }
                        
                                // Función para mover el marcador a lo largo de la ruta
                                function moveMarker(routeCoords) {
                                    if (movingMarker) {
                                        map.removeLayer(movingMarker); // Elimina el marcador de movimiento anterior
                                    }
                        
                                    movingMarker = L.marker(routeCoords[0], {
                                        icon: bikeIcon
                                    }).addTo(map); // Crea el marcador en la posición inicial
                        
                                    let step = 0;
                        
                                    const interval = setInterval(() => {
                                        if (step >= routeCoords.length) {
                                            clearInterval(interval); // Detener el movimiento al final
                                            return;
                                        }
                        
                                        const { lat, lng } = routeCoords[step];
                                        movingMarker.setLatLng([lat, lng]); // Mover el marcador a la nueva posición
                                        step++;
                                    }, STEP_TIME);
                                }
                        
                                // Llama a la función para crear la ruta usando el array 'routePoints'
                                createRouteFromArray(routePoints);
                            } else {
                                console.error('Error: No se pudieron obtener las coordenadas.');
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
