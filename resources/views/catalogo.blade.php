<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            /* Ajusta la altura de las imágenes */
            object-fit: cover;
            /* Mantiene la proporción de la imagen */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Catálogo de Productos</h1>
        <div class="row">

            @foreach ($items as $item)
                <!-- Producto 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Nombre del producto 1">
                        <div class="card-body">
                            <h5 class="card-title">MARCA: {{$item->brand}}</h5>

                        </div>
                    </div>
                </div>
            @endforeach


            <!-- Añade más productos según sea necesario -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
