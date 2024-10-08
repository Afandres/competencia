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
                            <th>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearprograma">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </th>
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
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarprograma_{{ $program->id }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-danger " onclick="if(confirm('¿Estás seguro de que deseas eliminar este programa?')) { event.preventDefault(); document.getElementById('delete-form-{{ $program->id }}').submit(); }">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $program->id }}" action="{{ route('program.destroy', $program->id) }}" method="POST" style="display: none;">
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
    <!-- Modal Programa -->
    <div class="modal fade" id="crearprograma" tabindex="-1" aria-labelledby="crearprograma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Programa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/program/store" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="number" name="code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="quarter_number">Número Trimestres</label>
                            <input type="number" name="quarter_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="modality">Modalidad</label>
                            <select name="modality" class="form-control">
                                <option value="Sin Espesificar">Sin Espesificar</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Virtual">Virtual</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Edición Programa -->
    @foreach ($programs as $program)
    <div class="modal fade" id="editarprograma_{{ $program->id }}" tabindex="-1" aria-labelledby="editarprograma_" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Programa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/program/update/{{ $program->id }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ $program->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="number" name="code" class="form-control" value="{{ $program->code }}" required>
                        </div>
                        <div class="form-group">
                            <label for="quarter_number">Número Trimestres</label>
                            <input type="number" name="quarter_number" class="form-control" value="{{ $program->quarter_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="modality">Modalidad</label>
                            <select name="modality" class="form-control">
                                <option value="Sin Espesificar" {{ $program->modality == 'Sin Espesificar' ? 'selected' : '' }}>Sin Espesificar</option>
                                <option value="Presencial" {{ $program->modality == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="Virtual" {{ $program->modality == 'Virtual' ? 'selected' : '' }}>Virtual</option>
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
