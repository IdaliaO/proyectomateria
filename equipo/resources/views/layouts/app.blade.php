<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Los Cardenales')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @yield('scripts')
</head>

<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('inicio') }}">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo Los Cardenales" style="height: 50px;">
                    <h1 class="ms-3 text-white mb-0">Los Cardenales</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContenido">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item">
                            <a href="{{ route('inicio') }}" class="nav-link"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vuelos.buscar') }}" class="nav-link"><i class="fas fa-plane-departure"></i> Buscar Vuelos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hoteles.buscar') }}" class="nav-link"><i class="fas fa-hotel"></i> Buscar Hoteles</a>
                        </li>
                        @if(session('autenticado'))
                            <li class="nav-item">
                            <a href="{{ route('carrito') }}" class="nav-link"><i class="fas fa-calendar-check"></i> Reservaciones</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('registro.mostrar') }}" class="btn btn-outline-custom me-2"><i class="fas fa-user-plus"></i> Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login.mostrar') }}" class="btn btn-outline-custom"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </header>
        <main class="flex-fill">
            <div class="container my-5">
                @yield('contenido')
            </div>
        </main>
        <footer class="footer text-white">
            <div class="container">
                <p class="mb-0">
                    &copy; 2024 Los Cardenales. Todos los derechos reservados. 
                    <i class="fas fa-heart text-danger"></i>
                </p>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
