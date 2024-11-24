@extends('layouts.admin')

@section('contenido')
<div class="container mt-4">
    <h2>Crear Usuario</h2>
    <form action="{{ route('admin.usuario.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
        @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}">
        @error('apellido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
        @error('telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Registrar Usuario</button>
</form>


</div>
@endsection
