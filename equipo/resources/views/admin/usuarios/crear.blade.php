@extends('layouts.admin')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-user-plus"></i> Crear Usuario</h1>
        <p class="text-muted">Completa el formulario para registrar un nuevo usuario en el sistema.</p>
    </div>
    <form id="create-user-form" action="{{ route('admin.usuario.store') }}" method="POST" class="shadow-lg p-4 bg-white rounded">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label"><i class="fas fa-user"></i> Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" >
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label"><i class="fas fa-user"></i> Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" >
            @error('apellido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label"><i class="fas fa-phone-alt"></i> Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" >
            @error('telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" >
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
        </div>
        <div class="text-center">
            <button type="button" id="confirm-create" class="btn btn-danger btn-lg px-5">
                <i class="fas fa-save"></i> Registrar Usuario
            </button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('confirm-create').addEventListener('click', function () {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas registrar este usuario con la información ingresada?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fas fa-check-circle"></i> Sí, registrar',
            cancelButtonText: '<i class="fas fa-ban"></i> Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('create-user-form').submit();
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
