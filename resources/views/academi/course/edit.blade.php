<div class="modal fade" id="editcourse{{ $course->id }}" tabindex="-1" aria-labelledby="editcourse" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Actualizar Curso') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('course.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="program_id">Programa</label>
                        <select name="program_id" id="program_id" class="form-control" required>
                            <option value="" disabled selected>Seleccione el programa</option>
                            @foreach ($programs as $id => $name)
                                <option value="{{ $id }}" {{ $id == $course->program_id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Código</label>
                        <input type="number" name="code" id="code" class="form-control" placeholder="Ingrese el código" value="{{ $course->code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Fecha Inicio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Ingrese la fecha de inicio" value="{{ $course->start_date }}" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
