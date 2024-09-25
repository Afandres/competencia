@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Programas</h2>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th># Trimestres</th>
                            <th>Modalidad</th>
                            <th><a href="" class="btn btn-success">Agregar</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->code }}</td>
                                <td>{{ $program->quarter_number }}</td>
                                <td>{{ $program->modality }}</td>
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
