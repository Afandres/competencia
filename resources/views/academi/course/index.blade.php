@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Cursos</h2>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Programa</th>
                            <th>Codigo</th>
                            <th>Fecha Inicio</th>
                            <th>Estado</th>
                            <th><a href="" class="btn btn-success">Agregar</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->program->name }}</td>
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->state }}</td>
                                <td>
                                    <a href="" class="btn btn-primary">Editar</a>
                                    <a href="" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
