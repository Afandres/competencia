<!-- Modal para editar aprendiz -->
<div class="modal fade" id="editapprentice{{ $apprentice->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Aprendiz</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('apprentice.course_update', $apprentice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $apprentice->person->name }}" required>
                    </div>

                    <!-- Campo Curso -->
                    <div class="form-group">
                        <label for="code">Curso</label>
                        <input type="text" name="code" id="code" class="form-control"  value="{{ $apprentice->course->code }}" required>
                    </div>

                    <!-- Campo Estado -->
                    <div class="form-group">
                        <label for="state">Estado</label>
                        <select name="state" id="state" class="form-control" value="{{ $apprentice->state }}" required>
                            <option value="Activo" {{ $apprentice->state == 'EN FORMACION' ? 'selected' : '' }}>Formación</option>
                            <option value="Inactivo" {{ $apprentice->state == 'RETIRADO' ? 'selected' : '' }}>Retirado</option>
                        </select>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>



