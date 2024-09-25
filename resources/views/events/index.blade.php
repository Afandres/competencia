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
                        <th>Name</th>
                        <th>Descricion</th>
                        <th>fecha de ejecucion</th>
                        <th><a href="{{route('EventCreate')}}" class="btn btn-success">Agregar</a></th>
                        @csrf
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
                                <a href="{{ route('eventEdit', $item->id) }}"  class="btn btn-primary">Editar</a>
                                @csrf
                                <form id="delete-form-{{ $item->id }}" action="{{ route('eventDestroy', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="#" class="btn btn-danger" onclick="if(confirm('¿Estás seguro de que deseas eliminar esta bicicleta?')) { event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit(); }">
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
