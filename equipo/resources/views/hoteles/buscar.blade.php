@extends('layouts.app')

@section('titulo', 'Buscar Hoteles')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Buscar Hoteles</h2>
    <form method="GET" action="{{ route('resultados.hoteles') }}">
        <div class="row">
            <div class="col-md-6">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" name="destino" class="form-control" value="{{ old('destino') }}">
                @error('destino')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="fecha_checkin" class="form-label">Fecha de Check-in</label>
                <input type="date" name="fecha_checkin" class="form-control" value="{{ old('fecha_checkin') }}">
                @error('fecha_checkin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="fecha_checkout" class="form-label">Fecha de Check-out</label>
                <input type="date" name="fecha_checkout" class="form-control" value="{{ old('fecha_checkout') }}">
                @error('fecha_checkout')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="huespedes" class="form-label">Huéspedes</label>
                <input type="number" name="huespedes" class="form-control" min="1" value="{{ old('huespedes') }}">
                @error('huespedes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="categoria" class="form-label">Categoría (Estrellas)</label>
                <select name="categoria" class="form-select">
                    <option value="">Cualquiera</option>
                    <option value="1">1 Estrella</option>
                    <option value="2">2 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option value="5">5 Estrellas</option>
                </select>
                @error('categoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="precio_maximo" class="form-label">Precio Máximo</label>
                <input type="number" name="precio_maximo" class="form-control" min="0" value="{{ old('precio_maximo') }}">
                @error('precio_maximo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="servicios" class="form-label">Servicios</label>
                <select name="servicios[]" class="form-select" multiple>
                    <option value="wifi">WiFi</option>
                    <option value="piscina">Piscina</option>
                    <option value="desayuno">Desayuno incluido</option>
                </select>
                @error('servicios')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Buscar Hoteles</button>
            </div>
        </div>
    </form>
</div>
@endsection
