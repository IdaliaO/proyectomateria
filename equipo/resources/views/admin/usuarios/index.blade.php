@extends('admin.dashboard')

@section('content')
    <h2>Gestión de Usuarios</h2>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botón para agregar un nuevo usuario -->
    <a href="{{ route('admin.usuario.crear') }}" class="btn btn-primary mb-3">Agregar Usuario</a>

    <!-- Tabla de usuarios -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <form action="{{ route('admin.usuario.destroy', $usuario->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
