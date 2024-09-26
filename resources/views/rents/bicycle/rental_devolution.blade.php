@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Formulario de Devolucion</h2>
    <div class="card">
        <div class="card-body">
            <h4>Bicicleta</h4>
            <h5 class="card-title">{{ $bicycle->brand }}</h5>
            <p class="card-text">
                <strong>Colores:</strong> {{ $bicycle->colors }}<br>
                <strong>Estado:</strong> {{ $bicycle->state }}<br>
                <strong>Prestada a:</strong> {{ $rental->person->name }}<br>
            </p>
            <form action="{{ route('rental.devolution.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="rental_id" value="{{ $rental->id }}">
                <div class="form-group">
                    <label for="end_time">Hora de Llegada</label>
                    <input type="time" name="end_time" class="form-control" value="{{ $rental->end_time }}" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection
