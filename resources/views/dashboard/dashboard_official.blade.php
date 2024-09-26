@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Panel de Control del Funcionario</h1>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x text-muted me-3"></i>
                    <div>
                        <h5 class="card-title">Total de Alquileres</h5>
                        <p class="card-text">10</p> <!-- Aquí puedes insertar el dato dinámico -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
