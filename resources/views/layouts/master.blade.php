<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SENABIC</title>

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

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #287d38;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
      </li>
    </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4"    >
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" style="text-decoration: none;" class="brand-link">
                <i style="margin-left:40px" class="fa-solid fa-person-biking"></i>
                <span class="brand-text font-weight-light" >SENABIC</span>
            </a>
            <!-- Sidebar -->
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <!-- Si tienes una imagen de usuario, descomenta la línea siguiente y proporciona la ruta -->
                    <!-- <img src="{{ asset('ruta/a/imagen.jpg') }}" class="img-circle elevation-2" alt="User Image"> -->
                </div>
                <div class="info">
                  <a href="#" class="d-block" style="text-decoration: none;">Usuario: {{ Auth::user()->name }}</a>
                        @if(Auth::user()->roles->isNotEmpty())
                          <a href="#" class="d-block" style="text-decoration: none;"> Rol: {{ Auth::user()->roles->first()->name }}</a>
                           
                        @else
                            Sin rol asignado
                        @endif
                    </span>
                </div>
            </div>
          </div>



            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         @role('admin')
         <li class="nav-item menu-open">
            <a href="" class="nav-link ">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Academia
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('program.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Programas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('course.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cursos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('inicio_aprendiz')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aprendices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('official.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Funcionarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('event')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Eventos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fa-bicycle"></i>
              <p>
                Gestion de alquiler
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('bicycle.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Administrar Bicicleta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('rental.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Alquilar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('rental.invoices')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Facturas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('rental.earnings')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ganancias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('rental.earnings.pdf')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-brands fa-watchman-monitoring"></i>
              <p>
                Monitoreo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('monitoringBisicles')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bicicletas Activas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('monitoringEvent')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Eventos</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="" class="nav-link">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Seguridad
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
              <p>
                Cerrar Sesión
              </p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
          @endrole
          @role('aprendiz')
          <li class="nav-item">
            <a href="{{route('rental.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Alquilar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('monitoringEvent')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Eventos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
              <p>
                Cerrar Sesión
              </p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
          @endrole
          @role('funcionario')
          <li class="nav-item">
            <a href="{{route('rental.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Alquilar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('monitoringEvent')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Eventos</p>
            </a>
          </li>
          <li class="nav-item">
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                <p>
                  Cerrar Sesión
                </p>
              </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
          @endrole
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    <!-- /.sidebar -->
    </aside>



 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @yield('content')
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="bg-green-field text-white text-center py-4" style="margin-left: 50px">
  <div class="container d-flex flex-column align-items-center justify-content-center con">
      <h5>Servicio Nacional de Aprendizaje - SENA</h5>
      <p>
          Formamos profesionales competentes para el desarrollo del país.
          <br> Cali, Colombia
      </p>
      <div class="social-icons mb-3 d-flex justify-content-center">
          <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
      </div>
      <p class="mt-3">&copy; 2024 SENA. Todos los derechos reservados.</p>
  </div>
</footer>

<style>
  
  footer {
      background-color: #287d38; /* Color verde de campo */
  }

  .con{
    margin-left: 200px;
  }
  .social-icons {
      display: flex; /* Usar flexbox para centrar los íconos */
      justify-content: center; /* Centrar horizontalmente */
  }
  .social-icons a {
      font-size: 20px; /* Tamaño de íconos */
      transition: color 0.3s; /* Efecto de transición */
  }
  .social-icons a:hover {
      color: #FFCC00; /* Color amarillo para el hover */
  }
</style>


</div>
</div>
<!-- ./wrapper -->
</div>
<!-- REQUIRED SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: true,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: {!! json_encode(session('error')) !!},
            showConfirmButton: true,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif
</body>

</html>
