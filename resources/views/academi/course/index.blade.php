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
                            <th>Codigo</th>
                            <th>Programa</th>
                            <th>Fecha Inicio</th>
                            <th>Estado</th>
                            <th>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearcurso">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->program->name }}</td>
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->state }}</td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarcurso_{{ $course->id }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-danger " onclick="if(confirm('¿Estás seguro de que deseas eliminar este curso?')) { event.preventDefault(); document.getElementById('delete-form-{{ $course->id }}').submit(); }">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $course->id }}" action="{{ route('course.destroy', $course->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Curso -->
    <div class="modal fade" id="crearcurso" tabindex="-1" aria-labelledby="crearcurso" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/course/store" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="program_id">Programa</label>
                            <select name="program_id" class="form-control">
                                <option value="">Seleccione el programa</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="number" name="code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Fecha Inicio</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select name="state" class="form-control">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Edición Curso -->
    @foreach($courses as $course)
    <div class="modal fade" id="editarcurso_{{ $course->id }}" tabindex="-1" aria-labelledby="editarcurso" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/course/update/{{ $course->id }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="program_id">Programa</label>
                            <select name="program_id" class="form-control">
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ $program->id == $course->program_id ? 'selected' : '' }}>
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="number" name="code" class="form-control" value="{{ $course->code }}" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Fecha Inicio</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $course->start_date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select name="state" class="form-control">
                                <option value="Activo" {{ $course->state == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ $course->state == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
