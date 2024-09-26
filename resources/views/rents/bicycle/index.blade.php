@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Bicicletas</h2>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Marca</th>
                        <th>Color</th>
                        <th>Estado</th>
                        <th>Precio x Hora</th>
                        <th><a href="{{route('bicycle.create')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a></th>
                        @csrf
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bicycles as $bicycle)
                        <tr>
                            <td>{{ $bicycle->id }}</td>
                            <td>{{ $bicycle->brand }}</td>
                            <td>{{ $bicycle->colors }}</td>
                            <td>{{ $bicycle->state }}</td>
                            <td>{{ $bicycle->rental_price }}</td>
                            <td>
                                <a href="{{ route('bicycle.edit', $bicycle->id) }}"  class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                @csrf
                                <form id="delete-form-{{ $bicycle->id }}" action="{{ route('bicycle.destroy', $bicycle->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="#" class="btn btn-danger" onclick="if(confirm('¿Estás seguro de que deseas eliminar esta bicicleta?')) { event.preventDefault(); document.getElementById('delete-form-{{ $bicycle->id }}').submit(); }">
                                    <i class="fa-solid fa-trash"></i>
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
