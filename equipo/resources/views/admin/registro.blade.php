@extends('layouts.admin')
@section('titulo', 'Registro de Administrador')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-user-shield"></i> Registro de Administrador</h1>
        <p class="text-muted">Completa los datos para registrar un nuevo administrador en el sistema.</p>
    </div>
    <form id="register-admin-form" method="POST" action="{{ route('admin.registro.enviar') }}" class="shadow-lg p-4 bg-white rounded">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label"><i class="fas fa-user"></i> Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" >
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña</label>
            <input type="password" name="password" class="form-control" >
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" >
        </div>

        <div class="text-center">
            <button type="button" id="confirm-register" class="btn btn-danger btn-lg px-5">
                <i class="fas fa-save"></i> Registrar Administrador
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('confirm-register').addEventListener('click', function () {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas registrar este administrador con la información ingresada?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fas fa-check-circle"></i> Sí, registrar',
            cancelButtonText: '<i class="fas fa-ban"></i> Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('register-admin-form').submit();
            }
        });
    });
</script>
<style>
    .swal2-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .swal2-content {
        font-family: 'Roboto', sans-serif;
        font-size: 1rem;
    }

    .swal2-confirm {
        background-color: #d33 !important;
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }

    .swal2-cancel {
        background-color: #3085d6 !important;
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }
</style>
@endsection