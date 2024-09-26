@extends('layouts.catalogos')

@section('content')
<div class="container">
    <h2 class="my-4">Alquilar Bicicleta</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($bicycles as $bicycle)
        <div class="col">
            <div class="card h-100" style="max-width: 18rem;">
                <img src="{{ asset('img/bicisena.jpg')}}" class="card-img-top" alt="Imagen de Bicicleta" style="max-height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $bicycle->brand }}</h5>
                    <p class="card-text">
                        <strong>Colores:</strong> {{ $bicycle->colors }}<br>
                        <strong>Estado:</strong> {{ $bicycle->state }}<br>
                    </p>
                </div>
                <div class="card-footer text-center">

                        @if ($bicycle->state == 'Activa')
                            <form action="{{ route('rental.create', $bicycle->id)}}" method="GET">
                                @csrf
                                <button class="btn btn-primary w-100">Arquilar</button>
                            </form>
                        @else
                            <button class="btn btn-danger w-100 disabled"><i class="fa-solid fa-lock"></i></button>
                            @role('admin')
                            <br>
                            <br>
                            <form action="{{ route('rental.devolution', $bicycle->id)}}" method="GET">
                                @csrf
                                <button class="btn btn-primary w-100"><i class="fa-solid fa-door-open"></i></button>
                            </form>
                            @endrole
                        @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
