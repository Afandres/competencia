@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Mis Comprobantes de Alquiler</h2>

    @if($rentals->isEmpty())
        <p>No has realizado ningún alquiler.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bicicleta</th>
                    <th>Fecha de Alquiler</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Precio Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rental->bicycle->brand }} - {{ $rental->bicycle->colors }}</td>
                        <td>{{ $rental->date }}</td>
                        <td>{{ $rental->start_time }}</td>
                        <td>{{ $rental->second_end_time ?? $rental->end_time }}</td>
                        <td>${{ number_format($rental->price, 0, ',', '.') }}</td>
                        <td>{{ $rental->state }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
