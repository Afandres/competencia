<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BICICEFA</title>

         <!-- Google Font: Source Sans Pro -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



         <!-- Font Awesome Icons -->
         <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

         <!-- Theme style -->
         <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

         <!-- Imagen -->
         <link rel="shortcut icon" href="{{ asset('img/logobike.png') }}" type="image/x-icon">

         <!-- Bootstrap CSS -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">

         <!-- CSS adicional -->
         <link rel="stylesheet" href="{{ asset('css/app.css') }}">

         <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
      <script src="https://kit.fontawesome.com/dcb1bbced2.js" crossorigin="anonymous"></script>
      </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Catálogo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categorías</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Contenido dinámico -->
        @yield('content')
    </div>

    <footer class="text-center py-4 bg-light">
        <p>&copy; {{ date('Y') }} - Catálogo de Productos</p>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
