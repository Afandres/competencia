@extends('layouts.master')

@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Registrar una hubicacion para el elemento</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('addUbicacionStore') }}" method="POST" >
                    @csrf


                    <div class="mb-3 row"  hidden>
                        <label for="startLat" class="col-sm-2 col-form-label ">id</label>
                        <div class="col-sm-10">
                            <input required type="number" name="id" id="id" value="{{$id}}" class="form-control"
                                placeholder="id" readonly>
                        </div>
                    </div>


                    <!-- Latitud - Inicio -->
                    <div class="mb-3 row" hidden>
                        <label for="startLat" class="col-sm-2 col-form-label ">Latitud (Inicio)</label>
                        <div class="col-sm-10">
                            <input required type="number" name="startLatitude" id="startLat" class="form-control"
                                placeholder="Latitud (Inicio)" readonly>
                        </div>
                    </div>

                    <!-- Longitud - Inicio -->
                    <div class="mb-3 row" hidden>
                        <label for="startLng" class="col-sm-2 col-form-label ">Longitud (Inicio)</label>
                        <div class="col-sm-10">
                            <input required type="number" name="startLongitude" id="startLng" class="form-control"
                                placeholder="Longitud (Inicio)" readonly>
                        </div>
                    </div>

                    <!-- Latitud - Fin -->
                    <div class="mb-3 row" hidden>
                        <label for="endLat" class="col-sm-2 col-form-label ">Latitud (Fin)</label>
                        <div class="col-sm-10">
                            <input required type="number" name="endLatitude" id="endLat" class="form-control"
                                placeholder="Latitud (Fin)" readonly>
                        </div>
                    </div>

                    <!-- Longitud - Fin -->
                    <div class="mb-3 row" hidden>
                        <label for="endLng" class="col-sm-2 col-form-label ">Longitud (Fin)</label>
                        <div class="col-sm-10">
                            <input required type="number" name="endLongitude" id="endLng" class="form-control"
                                placeholder="Longitud (Fin)" readonly>
                        </div>
                    </div>

                    <!-- Botón que activa la modal -->
                    <div class="text-end mt-3" hidden>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#locationModal">
                            Seleccionar Ubicación
                        </button>
                    </div>

                    <!-- Botón de Crear -->
                    <div class="text-end mt-5" >
                        <button type="submit" class="btn btn-primary">Guardar hubicacion</button>
                    </div>
                </form>


                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
                <div id="map" style="height: 600px;"></div>

                <script>
                    // Inicializar el mapa en un punto central
                    const map = L.map('map').setView([3.43141, -76.52056], 13);

                    // Añadir capa de mosaico de OpenStreetMap
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    let startMarker = null;
                    let endMarker = null;
                    let routeControl = null;

                    // Función para manejar el clic en el mapa
                    map.on('click', function(e) {
                        const coords = e.latlng; // Coordenadas del clic

                        if (!startMarker) {
                            // Crear el marcador de inicio si no existe
                            startMarker = L.marker(coords).addTo(map);
                            document.getElementById('startLat').value = coords.lat;
                            document.getElementById('startLng').value = coords.lng;
                        } else if (!endMarker) {
                            // Crear el marcador de fin si no existe
                            endMarker = L.marker(coords).addTo(map);
                            document.getElementById('endLat').value = coords.lat;
                            document.getElementById('endLng').value = coords.lng;

                            // Crear la ruta entre los dos puntos
                            createRoute(startMarker.getLatLng(), endMarker.getLatLng());
                        } else {
                            // Si ya hay dos marcadores, reiniciar
                            map.removeLayer(startMarker);
                            map.removeLayer(endMarker);
                            startMarker = L.marker(coords).addTo(map);
                            endMarker = null; // Reiniciar el marcador de fin
                            routeControl && map.removeControl(routeControl); // Eliminar la ruta anterior
                            document.getElementById('startLat').value = coords.lat;
                            document.getElementById('startLng').value = coords.lng;
                            document.getElementById('endLat').value = '';
                            document.getElementById('endLng').value = '';
                        }
                    });

                    // Función para crear la ruta entre dos puntos
                    function createRoute(start, end) {
                        // Eliminar la ruta anterior si existe
                        if (routeControl) {
                            map.removeControl(routeControl);
                        }

                        // Crear la nueva ruta
                        routeControl = L.Routing.control({
                            waypoints: [
                                L.latLng(start.lat, start.lng),
                                L.latLng(end.lat, end.lng)
                            ],
                            routeWhileDragging: false, // No permitir arrastrar la ruta
                            createMarker: function() {
                                return null;
                            }, // No mostrar marcadores adicionales
                        }).addTo(map);
                    }
                </script>


            </div>
        </div>
    </div>
@endsection
