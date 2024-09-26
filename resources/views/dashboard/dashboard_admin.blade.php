@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Panel de Control del Administrador</h1>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-bicycle fa-2x text-muted me-3"></i>
                    <div>
                        <h5 class="card-title">Total de Bicicletas</h5>
                        <p class="card-text">100</p> <!-- Aquí puedes insertar el dato dinámico -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x text-muted me-3"></i>
                    <div>
                        <h5 class="card-title">Total de Alquileres</h5>
                        <p class="card-text">250</p> <!-- Aquí puedes insertar el dato dinámico -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users fa-2x text-muted me-3"></i>
                    <div>
                        <h5 class="card-title">Total de Usuarios</h5>
                        <p class="card-text">150</p> <!-- Aquí puedes insertar el dato dinámico -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-muted me-3"></i>
                    <div>
                        <h5 class="card-title">Alquileres Activos</h5>
                        <p class="card-text">30</p> <!-- Aquí puedes insertar el dato dinámico -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
