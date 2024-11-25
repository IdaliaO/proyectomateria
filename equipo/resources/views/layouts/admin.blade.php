<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel de Administración para gestionar usuarios, vuelos, hoteles y reportes.">
    <meta name="keywords" content="administración, usuarios, vuelos, hoteles, reportes">
    <meta name="author" content="Equipo de Desarrollo">
    <title>@yield('title', 'Panel de Administración')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @yield('extra-styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f7f7f7; border-bottom: 2px solid #C41E3A;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-plane-departure" style="color: #003B70;"></i> Panel de Administración
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                @if(Session::has('admin_autenticado'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.administradores.index') }}">
                            <i class="fas fa-users-cog"></i> Administradores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
                            <i class="fas fa-user-friends"></i> Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.vuelos.index') }}">
                            <i class="fas fa-plane"></i> Vuelos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hoteles.index') }}">
                            <i class="fas fa-hotel"></i> Hoteles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.reportes') }}">
                            <i class="fas fa-chart-line"></i> Reportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.registro') }}">
                            <i class="fas fa-user-plus"></i> Registrar Administrador
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.usuario.crear') }}">
                            <i class="fas fa-user-plus"></i> Registrar Usuario
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="color: #C41E3A;">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>




    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-scripts')
</body>
</html>
