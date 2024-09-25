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
                            <th>
                                <a data-bs-toggle="modal" data-bs-target="#crearproyecto">
                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                        <i class="fas fa-plus-circle"></i>
                                    </b>
                                </a>
                            </th>
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
                                    <a  data-bs-toggle="modal" data-bs-target="#editcourse{{$course->id}}">
                                        <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Curso">
                                            <i class="fas fa-edit"></i>
                                        </b>
                                    </a>
                                    @include('academi.course.edit')
                                    <a class="delete-training_project"  data-trainingproject-id="{{ $course->id }}">
                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Proyecto Formativo">
                                            <i class="fas fa-trash-alt"></i>
                                        </b>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
