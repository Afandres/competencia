@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Eventos</h2>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de Ejecución</th>
                        <th>Imagen</th> <!-- Nueva columna para la imagen -->
                        <th><a href="{{ route('EventCreate') }}" class="btn btn-success">Agregar</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <!-- Mostrar la imagen -->
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Imagen del evento" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('addUbicacion', $item->id) }}" class="btn btn-primary">Ubicación</a>
                                <a href="{{ route('events.formUpdateImage', $item->id) }}" class="btn btn-primary">Imagen</a>
                                <a href="{{ route('eventEdit', $item->id) }}" class="btn btn-primary">Editar</a>
                                @csrf
                                <form id="delete-form-{{ $item->id }}" action="{{ route('eventDestroy', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="#" class="btn btn-danger" onclick="if(confirm('¿Estás seguro de que deseas eliminar este evento?')) { event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
