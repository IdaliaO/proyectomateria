@extends('layouts.admin')

@section('titulo', 'Agregar Hotel')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Agregar Nuevo Hotel</h2>
    <form method="POST" action="{{ route('admin.hotel.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Hotel</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}" required>
            @error('ubicacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría (Estrellas)</label>
            <input type="number" name="categoria" class="form-control" value="{{ old('categoria') }}" min="1" max="5" required>
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio_noche" class="form-label">Precio por Noche</label>
            <input type="number" name="precio_noche" class="form-control" value="{{ old('precio_noche') }}" step="0.01" required>
            @error('precio_noche')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad de Habitaciones</label>
            <input type="number" name="disponibilidad" class="form-control" value="{{ old('disponibilidad') }}" min="1" required>
            @error('disponibilidad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="servicios" class="form-label">Servicios (separados por comas)</label>
            <input type="text" name="servicios" class="form-control" value="{{ old('servicios') }}">
            @error('servicios')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="politicas_cancelacion" class="form-label">Políticas de Cancelación</label>
            <textarea name="politicas_cancelacion" class="form-control" rows="4">{{ old('politicas_cancelacion') }}</textarea>
            @error('politicas_cancelacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="numero_estrellas" class="form-label">Número de Estrellas</label>
            <input type="number" name="numero_estrellas" class="form-control" value="{{ old('numero_estrellas') }}" min="1" max="5" required>
            @error('numero_estrellas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="check_in" class="form-label">Fecha de Check-In</label>
            <input type="date" name="check_in" class="form-control" value="{{ old('check_in') }}" required>
            @error('check_in')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="check_out" class="form-label">Fecha de Check-Out</label>
            <input type="date" name="check_out" class="form-control" value="{{ old('check_out') }}" required>
            @error('check_out')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="numero_habitaciones" class="form-label">Número de Habitaciones</label>
            <input type="number" name="numero_habitaciones" class="form-control" value="{{ old('numero_habitaciones') }}" min="1" required>
            @error('numero_habitaciones')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="numero_huespedes" class="form-label">Número de Huéspedes</label>
            <input type="number" name="numero_huespedes" class="form-control" value="{{ old('numero_huespedes') }}" min="1" required>
            @error('numero_huespedes')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fotografia" class="form-label">Fotografía del Hotel</label>
            <input type="file" name="fotografia" class="form-control" accept="image/*" required>
            @error('fotografia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar Hotel</button>
    </form>
</div>
@endsection
