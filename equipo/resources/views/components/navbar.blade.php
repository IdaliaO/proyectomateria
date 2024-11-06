<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('inicio') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Los Cardenales" style="width: 50px;">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('buscar.vuelos') }}">Buscar Vuelos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('buscar.hoteles') }}">Buscar Hoteles</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('registro') }}">Registrarse</a>
                </li>
            @else
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display: inline; padding: 0;">Cerrar Sesión</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
