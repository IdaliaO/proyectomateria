@extends('layouts.app')
@section('titulo', 'Iniciar Sesión')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h1>
        <p class="text-muted">Accede a tu cuenta para gestionar tus reservaciones y más.</p>
    </div>

    <div class="card shadow-lg border-0 p-4" style="border-radius: 15px;">
        <form method="POST" action="{{ route('login.enviar') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="nombre@correo.com">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Inicio de sesión correcto!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-4">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif
</div>
@endsection
