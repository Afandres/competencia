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
                        <a href="#?start_latitude={{$item->start_latitude}}&start_longitude={{$item->start_longitude}}&end_latitude={{$item->end_latitude}}&end_longitude={{$item->end_longitude}}" class="list-group-item list-group-item-action">{{$item->name}}</a>
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
                            const map = L.map('map').setView([3.43141, -76.52056], 13); // Configura el mapa

                            // Capa de mosaico
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '© OpenStreetMap'
                            }).addTo(map);

                            // URL de la imagen de la bicicleta
                            const bikeIcon = L.icon({
                                iconUrl: 'https://img.icons8.com/ios-filled/50/000000/bicycle.png',
                                iconSize: [32, 32],
                                iconAnchor: [16, 32],
                                popupAnchor: [0, -32]
                            });

                            let startMarker = null; // Marcador de inicio
                            let endMarker = null; // Marcador de fin
                            let routeControl = null; // Control de enrutamiento
                            let movingMarker = null; // Marcador en movimiento

                            // Función para manejar el clic en el mapa
                            map.on('click', function(e) {
                                const coords = e.latlng; // Obtiene las coordenadas del clic

                                if (!startMarker) {
                                    // Si no hay un marcador de inicio, crea uno
                                    startMarker = L.marker(coords, {
                                        icon: bikeIcon
                                    }).addTo(map);
                                } else if (!endMarker) {
                                    // Si ya hay un marcador de inicio, crea uno de fin
                                    endMarker = L.marker(coords).addTo(map);

                                    // Llama a la función para crear la ruta
                                    createRoute(startMarker.getLatLng(), endMarker.getLatLng());
                                } else {
                                    // Si ambos marcadores existen, reinicia
                                    map.removeLayer(startMarker);
                                    map.removeLayer(endMarker);
                                    startMarker = L.marker(coords, {
                                        icon: bikeIcon
                                    }).addTo(map);
                                    endMarker = null; // Reinicia el marcador de fin
                                }
                            });

                            // Función para crear la ruta
                            function createRoute(start, end) {
                                // Elimina la ruta anterior si existe
                                if (routeControl) {
                                    map.removeControl(routeControl);
                                }

                                // Crea una nueva ruta
                                routeControl = L.Routing.control({
                                    waypoints: [
                                        L.latLng(start.lat, start.lng),
                                        L.latLng(end.lat, end.lng)
                                    ],
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

                                const stepTime = 100; // Tiempo entre pasos en milisegundos
                                let step = 0;

                                const interval = setInterval(() => {
                                    if (step >= routeCoords.length) {
                                        clearInterval(interval); // Detener el movimiento al final
                                        return;
                                    }

                                    const {
                                        lat,
                                        lng
                                    } = routeCoords[step];
                                    movingMarker.setLatLng([lat, lng]); // Mover el marcador a la nueva posición
                                    step++;
                                }, stepTime);
                            }
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
