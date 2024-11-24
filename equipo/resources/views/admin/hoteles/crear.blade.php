@extends('layouts.admin')

@section('titulo', 'Agregar Hotel')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Agregar Nuevo Hotel</h2>
    <form method="POST" action="{{ route('admin.hotel.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Hotel</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
            @error('ubicacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría (Estrellas)</label>
            <input type="number" name="categoria" class="form-control" value="{{ old('categoria') }}" min="1" max="5">
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio_noche" class="form-label">Precio por Noche</label>
            <input type="number" name="precio_noche" class="form-control" value="{{ old('precio_noche') }}" step="0.01">
            @error('precio_noche')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad de Habitaciones</label>
            <input type="number" name="disponibilidad" class="form-control" value="{{ old('disponibilidad') }}" min="1">
            @error('disponibilidad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="servicios" class="form-label">Servicios</label>
            <div class="form-check">
                @foreach($servicios as $servicio)
                    <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" class="form-check-input" id="servicio_{{ $servicio->id }}">
                    <label class="form-check-label" for="servicio_{{ $servicio->id }}">{{ $servicio->nombre }}</label><br>
                @endforeach
            </div>
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
            <label for="fotografia" class="form-label">Fotografía del Hotel</label>
            <input type="file" name="fotografia" class="form-control" accept="images/*" >
            @error('fotografia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar Hotel</button>
    </form>
</div>
@endsection
