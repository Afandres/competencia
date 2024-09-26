@extends('layouts.master')

@section('content')

<div class="container">
    <h1>Registrar Aprendiz</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{route('apprentices.store')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Campo Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Ingrese el nombre" required>
                </div>

                <!-- Campo  Tipo de Documento -->
                <div class="mb-3">
                    <label for="document_type" class="form-label">Tipo de Documento</label>
                    <select name="document_type" class="form-select" id="document_type">
                        <option selected>Selecione su documento</option>
                        <option value="Tarjeta de identidad">Tarjeta de Identidad</option>
                        <option value="Cédula de ciudadanía">Cédula de Cuidadanía</option>
                        <option value="Cédula de extranjería">Cédula Extranjera</option>
                 </select>
                </div>


                <!-- Campo Número de Documento -->
                <div class="mb-3">
                    <label for="document_number" class="form-label">Número de Documento</label>
                    <input type="number" name="document_number" class="form-control" id="document_number" placeholder="Ingrese el número de documento" required>
                </div>

                <!-- Campo  Telefono -->
                <div class="mb-3">
                    <label for="telephone" class="form-label">Telefono</label>
                    <input type="number" name="telephone" class="form-control" id="telephone" placeholder="Ingrese el numero de telefono" required>
                </div>

                <!-- Campo  Email-->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electronico</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese el Correo Electronico" required>
                </div>

                <!-- Campo  Dirección-->
                <div class="mb-3">
                    <label for="addres" class="form-label">Dirección</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Ingrese la dirección" required>
                </div>

                <!-- Campo  Curso-->
                <div class="mb-3">
                    <label for="course_id" class="form-label">Curso</label>
                    <select name="course_id" class="form-select" id="course_id">
                        <option selected>Seleccione un curso</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->code }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo  Estado -->
                <div class="form-group">
                    <label for="state">Estado</label>
                    <select name="state" class="form-control">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>

                <!-- Botón de enviar -->
                <button type="submit" class="btn btn-primary">Agregar</button>

            </form>
        </div>
    </div>
</div>


@endsection
