@extends('layouts.master')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Registrar Nueva Bicicleta</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('bicycle.store') }}" method="POST">
                @csrf

                <!-- Marca -->
                <div class="mb-3 row">
                    <label for="brand" class="col-sm-2 col-form-label">Marca</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand" id="brand" required
                            class="form-control @error('brand') is-invalid @enderror"
                            placeholder="Ingrese la marca de la bicicleta">
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Colores -->
                <div class="mb-3 row">
                    <label for="colors" class="col-sm-2 col-form-label">Color</label>
                    <div class="col-sm-10">
                        <input type="text" name="colors" id="colors" required
                            class="form-control @error('colors') is-invalid @enderror"
                            placeholder="Ingrese el color de la bicicleta">
                        @error('colors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Estado -->
                <div class="mb-3 row">
                    <label for="state" class="col-sm-2 col-form-label">Estado</label>
                    <div class="col-sm-10">
                        <select name="state" id="state" required
                            class="form-select @error('state') is-invalid @enderror">
                            <option value="Activa">Activa</option>
                            <option value="Inactiva">Inactiva</option>
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Precio de Alquiler -->
                <div class="mb-3 row">
                    <label for="rental_price" class="col-sm-2 col-form-label">Precio de Alquiler</label>
                    <div class="col-sm-10">
                        <input type="number" name="rental_price" id="rental_price" min="0" step="1" required
                            class="form-control @error('rental_price') is-invalid @enderror"
                            placeholder="Ingrese el precio de alquiler">
                        @error('rental_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Botón de Crear -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Crear Bicicleta</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
