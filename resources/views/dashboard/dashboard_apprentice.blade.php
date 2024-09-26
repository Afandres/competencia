@extends('layouts.master')

@section('content')
<style>
    /* Contenedor de eventos */
    .events-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .event-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 10px;
        width: calc(33% - 20px);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    }

    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .event-content {
        padding: 15px;
    }

    .event-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0;
    }

    .event-description {
        color: #555;
        margin-top: 5px;
    }

    .event-date {
        font-size: 0.9rem;
        color: #999;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .event-card {
            width: calc(50% - 20px);
        }
    }

    @media (max-width: 480px) {
        .event-card {
            width: 100%;
        }
    }
</style>
<div class="container mt-4">
    <h1 class="mb-4">Panel de Control del Aprendiz</h1>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x text-muted me-3"></i>
                    <div>
                        <h5 class="card-title">Total de Alquileres</h5>
                        <p class="card-text">10</p> <!-- Aquí puedes insertar el dato dinámico -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>Eventos</h3>
<div class="events-container">

    @foreach ($events as $event)
        <div class="event-card">
            @if ($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-image">
            @endif

            <div class="event-content">
                <h2 class="event-title">{{ $event->name }}</h2>
                <p class="event-description">{{ $event->description }}</p>
                <p class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i A') }}</p>
                <!-- Muestra la fecha en un formato más legible -->

                <!-- Botón de participar -->
                <a href="{{ route('event.participate', $event->id) }}" class="btn btn-primary mt-3">Participar</a>
            </div>
        </div>
    @endforeach
</div>

</div>
@endsection
