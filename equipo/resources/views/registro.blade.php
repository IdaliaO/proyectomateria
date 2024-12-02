@extends('layouts.app')
@section('titulo', 'Registro de Usuario')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-user-plus"></i> Registro de Usuario</h1>
        <p class="text-muted">Crea tu cuenta para comenzar a disfrutar de nuestros servicios.</p>
    </div>
    <div class="card shadow-lg border-0 p-4" style="border-radius: 15px;">
        <form method="POST" action="{{ route('registro.enviar') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label"><i class="fas fa-user"></i> Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ingresa tu nombre">
                @error('nombre')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label"><i class="fas fa-user"></i> Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" placeholder="Ingresa tu apellido">
                @error('apellido')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="nombre@correo.com">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label"><i class="fas fa-phone-alt"></i> Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="Ingresa tu número de teléfono">
                @error('telefono')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Crea una contraseña">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Repite tu contraseña">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5"><i class="fas fa-check-circle"></i> Registrarse</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro Exitoso!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif
</div>
@endsection
