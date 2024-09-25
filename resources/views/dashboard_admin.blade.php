@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Panel de Control del Administrador</h1>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total de Bicicletas</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total de Alquileres</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total de Usuarios</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Alquileres Activos</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
