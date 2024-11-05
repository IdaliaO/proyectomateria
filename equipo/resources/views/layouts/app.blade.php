<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Los Cardenales')</title>
    
    <!-- Añadir Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-whatever" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Estilos Personalizados -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
        header {
            background-color: #004080;
            color: white;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-nav {
            display: flex;
            gap: 1rem;
        }
        .nav-link {
            color: white;
            text-decoration: none;
        }
        .nav-link:hover {
            color: #cccccc;
        }
        .footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <!-- Encabezado con logo y menú de navegación -->
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo Los Cardenales" style="height: 50px;">
        </div>
        <nav class="navbar-nav">
            <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
            <a class="nav-link" href="{{ route('buscar.vuelos') }}">Buscar Vuelos</a>
            <a class="nav-link" href="{{ route('buscar.hoteles') }}">Buscar Hoteles</a>
            @guest
                <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                <a class="nav-link" href="{{ route('registro') }}">Registrarse</a>
            @else
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="content">
        @yield('contenido')
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <p>&copy; 2024 Los Cardenales. Todos los derechos reservados.</p>
    </footer>
</body>
</html>