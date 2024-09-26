@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Formulario de Alquiler</h2>
    <div class="card">
        <div class="card-body">
            <h4>Bicicleta</h4>
            <h5 class="card-title">{{ $bicycle->brand }}</h5>
            <p class="card-text">
                <strong>Colores:</strong> {{ $bicycle->colors }}<br>
                <strong>Estado:</strong> {{ $bicycle->state }}<br>
            </p>
            <form action="{{ route('rental.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="bicycle_id" value="{{ $bicycle->id }}">
                <div class="form-group">
                    <label for="start_time">Hora de Salida</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_time">Hora de Llegada</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>
                <br>
                <!-- Latitud - Inicio (predefinida y visible) -->
                <div class="mb-3 row">
                    <label for="startLat" class="col-sm-2 col-form-label">Latitud (Inicio)</label>
                    <div class="col-sm-10">
                        <input required type="number" name="startLatitude" id="startLat" class="form-control" readonly value="3.43141">
                    </div>
                </div>

                <!-- Longitud - Inicio (predefinida y visible) -->
                <div class="mb-3 row">
                    <label for="startLng" class="col-sm-2 col-form-label">Longitud (Inicio)</label>
                    <div class="col-sm-10">
                        <input required type="number" name="startLongitude" id="startLng" class="form-control" readonly value="-76.52056">
                    </div>
                </div>

                <!-- Latitud - Fin (editable por el usuario) -->
                <div class="mb-3 row" hidden>
                    <label for="endLat" class="col-sm-2 col-form-label ">Latitud (Fin)</label>
                    <div class="col-sm-10">
                        <input required type="number" name="endLatitude" id="endLat" class="form-control" readonly>
                    </div>
                </div>

                <!-- Longitud - Fin (editable por el usuario) -->
                <div class="mb-3 row" hidden>
                    <label for="endLng" class="col-sm-2 col-form-label ">Longitud (Fin)</label>
                    <div class="col-sm-10">
                        <input required type="number" name="endLongitude" id="endLng" class="form-control" readonly>
                    </div>
                </div>
                <p><strong>Marcar el punto de llegada</strong></p>
                <div id="map" style="height: 600px;"></div>
                <br>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
    // Inicializar el mapa en un punto central
    const map = L.map('map').setView([3.43141, -76.52056], 13);

    // Añadir capa de mosaico de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Coordenadas de inicio predefinidas
    const startLatLng = [3.43141, -76.52056];

    // Agregar marcador en el punto de inicio predefinido
    const startMarker = L.marker(startLatLng).addTo(map);

    let endMarker = null;
    let routeControl = null;

    // Función para manejar el clic en el mapa
    map.on('click', function(e) {
        const coords = e.latlng; // Coordenadas del clic

        if (!endMarker) {
            // Crear el marcador de fin si no existe
            endMarker = L.marker(coords).addTo(map);
            document.getElementById('endLat').value = coords.lat;
            document.getElementById('endLng').value = coords.lng;

            // Crear la ruta entre el punto de inicio y el punto de llegada
            createRoute(L.latLng(startLatLng[0], startLatLng[1]), coords);
        } else {
            // Si ya existe el marcador de fin, actualizarlo
            map.removeLayer(endMarker);
            endMarker = L.marker(coords).addTo(map);
            document.getElementById('endLat').value = coords.lat;
            document.getElementById('endLng').value = coords.lng;

            // Crear la nueva ruta
            createRoute(L.latLng(startLatLng[0], startLatLng[1]), coords);
        }
    });

    // Función para crear la ruta entre el punto de inicio y el de llegada
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
@endsection
