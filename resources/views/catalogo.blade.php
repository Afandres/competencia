@extends('welcome')

@section('content')
    <div class="container mt-5 mx-auto">
        <h1 class="text-center mb-4">Catálogo de Productos</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
            <a href="#" class="flex flex-col items-center gap-4 rounded-lg bg-white p-6 shadow-lg ring-1 ring-gray-200 transition duration-300 hover:text-black/70 hover:ring-gray-300 focus:outline-none focus-visible:ring-indigo-500">
                <!-- Icono / Imagen centrada -->
                <div class="flex items-center justify-center">
                    <img src="https://via.placeholder.com/300" class="rounded-full card-img-top" alt="Imagen del producto">
                </div>

                <!-- Contenido del producto -->
                <div class="text-center">
                    <h2 class="text-xl font-semibold text-black">MARCA: {{$item->brand}}</h2>
                    <p class="mt-4 text-sm text-gray-600">Este es un breve resumen o descripción del producto. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>



