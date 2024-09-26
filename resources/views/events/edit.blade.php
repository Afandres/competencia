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
                <input type="submit" value="Actualizar" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
