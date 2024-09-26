@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Aprendices</h2>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>
                                <!-- Botón que abre el modal de crear -->
                                <a data-bs-toggle="modal" data-bs-target="#createApprenticeModal">
                                    <b class="text-success" data-toggle="tooltip" data-placement="top" title="Agregar Aprendiz">
                                        <i class="fas fa-plus"></i>
                                 </b>
                                </a>
                                @include('apprentice.create')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apprentices as $apprentice)
                            <tr>
                                <td>{{ $apprentice->id }}</td>
                                <td>{{ $apprentice->person->name}}</td>
                                <td>{{ $apprentice->course->program->code }}</td>
                                <td>{{ $apprentice->state }}</td>
                                <td>
                                    <!-- Botón de editar que abre el modal -->
                                    <a data-bs-toggle="modal" data-bs-target="#editapprentice{{$apprentice->id}}">
                                        <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Aprendiz">
                                            <i class="fas fa-edit"></i>
                                        </b>
                                    </a>
                                    @include('apprentice.edit')


                                    <!-- Botón de eliminar con JavaScript -->
                                    <a class="delete-apprentice" data-apprentice-id="{{ $apprentice->id }}">
                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Aprendiz">
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

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            // Eliminar aprendiz con confirmación de JavaScript
            $('.delete-apprentice').on('click', function(e){
                e.preventDefault();
                var apprenticeId = $(this).data('apprentice-id');
                var url = '/apprentice/' + apprenticeId;

                if(confirm('¿Estás seguro de que quieres eliminar este aprendiz?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert('Aprendiz eliminado exitosamente');
                            // Puedes eliminar la fila de la tabla o recargar la página si lo prefieres.
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Hubo un error al eliminar el aprendiz');
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@endsection


