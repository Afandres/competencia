@extends('layouts.master')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Editar Evento</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('eventUpdate', $event->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ingrese el nombre del evento">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Descripción</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" required
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Ingrese la descripción del evento">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Fecha -->
                <div class="mb-3 row">
                    <label for="date" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-sm-10">
                        <input type="date" name="date" id="date" value="{{ old('date', $event->date) }}" required
                            class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Ubicación (Latitud) -->
                <div class="mb-3 row">
                    <label for="start_latitude" class="col-sm-2 col-form-label">Latitud de Inicio</label>
                    <div class="col-sm-10">
                        <input type="text" name="start_latitude" id="startLat" value="{{ old('start_latitude', $event->start_latitude) }}" required
                            class="form-control" readonly>
                    </div>
                </div>

                <!-- Ubicación (Longitud) -->
                <div class="mb-3 row">
                    <label for="start_longitude" class="col-sm-2 col-form-label">Longitud de Inicio</label>
                    <div class="col-sm-10">
                        <input type="text" name="start_longitude" id="startLng" value="{{ old('start_longitude', $event->start_longitude) }}" required
                            class="form-control" readonly>
                    </div>
                </div>

                <!-- Ubicación (Latitud Final) -->
                <div class="mb-3 row">
                    <label for="end_latitude" class="col-sm-2 col-form-label">Latitud Final</label>
                    <div class="col-sm-10">
                        <input type="text" name="end_latitude" id="endLat" value="{{ old('end_latitude', $event->end_latitude) }}" required
                            class="form-control" readonly>
                    </div>
                </div>

                <!-- Ubicación (Longitud Final) -->
                <div class="mb-3 row">
                    <label for="end_longitude" class="col-sm-2 col-form-label">Longitud Final</label>
                    <div class="col-sm-10">
                        <input type="text" name="end_longitude" id="endLng" value="{{ old('end_longitude', $event->end_longitude) }}" required
                            class="form-control" readonly>
                    </div>
                </div>

                   <!-- Botón que activa la modal -->
                   <div class="text-end mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#locationModal">
                        Seleccionar Ubicación
                    </button>
                </div>

                <!-- Botón de Actualización -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Actualizar Evento</button>
                </div>
            </form>

                 <!-- Modal para seleccionar ubicación -->
                 <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="locationModalLabel">Seleccionar Ubicación</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
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
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                             <button type="button" class="btn btn-primary" id="confirmLocation">Confirmar Ubicación</button>
                         </div>
                     </div>
                 </div>
             </div>


             <!-- Bootstrap JS and Popper.js -->
             <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
             <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>


        </div>
    </div>
</div>
@endsection
