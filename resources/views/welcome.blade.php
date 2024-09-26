<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BICICEFA</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* Estilos básicos */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        /* Estilos de navegación */
        nav {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .nav-button {
            background-color: #112441;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .nav-button:hover {
            background-color: #287d38;
            transform: translateY(-2px);
        }

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
</head>

<body>
    <header>
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-button">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-button">Log in</a>
                    @if (Route::has('user.register'))
                        <a href="{{ route('user.register') }}" class="nav-button">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

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
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
