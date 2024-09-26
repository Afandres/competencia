@extends('layouts.master')

@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Registrar un nuevo evento</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('eventStore') }}" method="POST">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label text-nowrap">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" required
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Ingrese el nombre del ítem">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label text-nowrap">Descripción</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" rows="3" required
                                class="form-control @error('description') is-invalid @enderror" placeholder="Ingrese una descripción"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha -->
                    <div class="mb-3 row">
                        <label for="date" class="col-sm-2 col-form-label text-nowrap">Fecha</label>
                        <div class="col-sm-10">
                            <input type="date" name="date" id="date" required
                                class="form-control @error('date') is-invalid @enderror">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="start_time" class="col-sm-2 col-form-label text-nowrap">Hora Inicio</label>
                        <div class="col-sm-10">
                            <input type="time" name="start_time" id="start_time" required
                                class="form-control @error('start_time') is-invalid @enderror">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="end_time" class="col-sm-2 col-form-label text-nowrap">Hora Fin</label>
                        <div class="col-sm-10">
                            <input type="time" name="end_time" id="end_time" required
                                class="form-control @error('end_time') is-invalid @enderror">
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                   <input type="submit" value="Crear" class="btn btn-primary">

            </div>
        </div>
    </div>
@endsection
