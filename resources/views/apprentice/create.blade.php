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
                <form action="{{ route('apprentice.course_create') }}" method="POST">
                    @csrf

                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre" required>
                    </div>

                    <!-- Campo Curso -->
                    <div class="form-group">
                        <label for="code">Curso</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Ingrese el curso" required>
                    </div>

                    <!-- Campo Estado -->
                    <div class="form-group">
                        <label for="state">Estado</label>
                        <select name="state" id="state" class="form-control" required>
                            <option value="Activo">Formación</option>
                            <option value="Inactivo">Retirado</option>
                        </select>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-success">Crear Aprendiz</button>
                </form>
            </div>
        </div>
    </div>
</div>
