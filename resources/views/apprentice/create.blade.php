<!-- Modal para crear un nuevo aprendiz -->
<div class="modal fade" id="createApprenticeModal" tabindex="-1" role="dialog" aria-labelledby="createApprenticeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createApprenticeModalLabel">Crear Aprendiz</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('apprentices.store') }}" method="POST">
                    @csrf

                    <!-- Seleccionar Persona -->
                    <div class="form-group">
                        <label for="person_id">Nombre</label>
                        <select name="person_id" class="form-control" required>
                            @foreach($apprentices as $apprentices)
                                <option value="{{ $apprentice->id }}">{{ $apprentice->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seleccionar Curso -->
                    <div class="form-group">
                        <label for="course_id">Curso</label>
                        <select name="course_id" class="form-control" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seleccionar Estado -->
                    <div class="form-group">
                        <label for="state">Estado</label>
                        <select name="state" class="form-control" required>
                            <option value="EN FORMACIÓN">Formación</option>
                            <option value="RETIRADO">Retirado</option>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success">Crear Aprendiz</button>
                </form>
            </div>
        </div>
    </div>
</div>
