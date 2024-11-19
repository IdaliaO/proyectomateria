<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Los Cardenales')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
</head>

<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="navbar navbar-expand-lg navbar-dark">
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
                        <li class="nav-item"><a href="{{ route('inicio') }}" class="nav-link">Inicio</a></li>
                        <li class="nav-item"><a href="{{ route('buscar.vuelos') }}" class="nav-link">Buscar Vuelos</a></li>
                        <li class="nav-item"><a href="{{ route('hoteles.buscar') }}" class="nav-link">Buscar Hoteles</a></li>
                        @if(session('autenticado'))
                            <li class="nav-item">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Cerrar Sesión</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('registro.mostrar') }}" class="btn btn-outline-custom me-2">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login.mostrar') }}" class="btn btn-outline-custom">Iniciar sesión</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </header>
        <main class="flex-fill">
            @yield('contenido')
        </main>
        <footer class="footer bg-dark text-white text-center py-3 mt-auto">
            <p class="mb-0">&copy; 2024 Los Cardenales. Todos los derechos reservados.</p>
        </footer>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
