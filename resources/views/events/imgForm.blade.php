@extends('layouts.master')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Editar Evento</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('events.updateImage', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Subir imagen</label>
                    <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                </div>
                <div class="mb-3">
                    <img id="imagePreview" src="{{ asset('storage/' . $event->image) }}" alt="Previsualización de la imagen" class="img-fluid" style="display: {{ $event->image ? 'block' : 'none' }}; max-width: 100%; margin-top: 10px;">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar imagen</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result; // Cambia la fuente de la imagen a la previsualización
                imagePreview.style.display = 'block'; // Muestra la imagen
            }
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
