@extends('layouts.admin')

@section('titulo', 'Editar Hotel')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Editar Hotel</h2>
    <form method="POST" action="{{ route('admin.hotel.update', $hotel->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Hotel</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $hotel->nombre) }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $hotel->ubicacion) }}" required>
            @error('ubicacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría (Estrellas)</label>
            <input type="number" name="categoria" class="form-control" value="{{ old('categoria', $hotel->categoria) }}" min="1" max="5" required>
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio_noche" class="form-label">Precio por Noche</label>
            <input type="number" name="precio_noche" class="form-control" value="{{ old('precio_noche', $hotel->precio_noche) }}" step="0.01" required>
            @error('precio_noche')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad de Habitaciones</label>
            <input type="number" name="disponibilidad" class="form-control" value="{{ old('disponibilidad', $hotel->disponibilidad) }}" min="1" required>
            @error('disponibilidad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="servicios" class="form-label">Servicios</label>
            <div class="form-check">
                @foreach($servicios as $servicio)
                    <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" class="form-check-input" id="servicio_{{ $servicio->id }}"
                    {{ in_array($servicio->id, old('servicios', $hotelServicios)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="servicio_{{ $servicio->id }}">{{ $servicio->nombre }}</label><br>
                @endforeach
            </div>
            @error('servicios')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $hotel->descripcion) }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="politicas_cancelacion" class="form-label">Políticas de Cancelación</label>
            <textarea name="politicas_cancelacion" class="form-control" rows="4">{{ old('politicas_cancelacion', $hotel->politicas_cancelacion) }}</textarea>
            @error('politicas_cancelacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fotografia" class="form-label">Fotografía del Hotel</label>
            <input type="file" name="fotografia" class="form-control" accept="image/*">
            @error('fotografia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Hotel</button>
    </form>
</div>
@endsection
