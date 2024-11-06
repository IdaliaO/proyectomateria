<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Los Cardenales')</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-whatever" crossorigin="anonymous">

    <!-- Estilo Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Vite Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Encabezado -->
    <header class="navbar">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo Los Cardenales" style="height: 50px;">
            <h1 class="ms-3 text-white">Los Cardenales</h1>
        </div>
        <ul class="navbar-menu d-flex align-items-center">
            <li><a href="{{ route('inicio') }}">Inicio</a></li>
            <li><a href="{{ route('buscar.vuelos') }}">Buscar Vuelos</a></li>
            <li><a href="{{ route('hoteles.buscar') }}">Buscar Hoteles</a></li>
            
            @if(session('autenticado'))
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-light">Cerrar Sesión</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <li><a href="{{ route('registro.mostrar') }}" class="btn btn-outline-light">Registrarse</a></li>
                <li><a href="{{ route('login.mostrar') }}" class="btn btn-outline-light ms-2">Iniciar sesión</a></li>
            @endif
        </ul>
    </header>

    <!-- Contenido Principal -->
    <main class="content my-4">
        @yield('contenido')
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <p>&copy; 2024 Los Cardenales. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-whatever" crossorigin="anonymous"></script>
</body>
</html>
