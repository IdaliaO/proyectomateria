@extends('layouts.app')
@section('titulo', 'Buscar Hoteles')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-search-location"></i> Buscar Hoteles</h1>
        <p class="text-muted">Encuentra el lugar perfecto para tu estadía.</p>
    </div>

    <form method="GET" action="{{ route('hoteles.resultados') }}" class="card shadow-lg p-4 border-0" style="border-radius: 15px;">
        <div class="row g-4">
            <div class="col-md-6">
                <label for="destino" class="form-label"><i class="fas fa-map-marker-alt"></i> Destino</label>
                <input type="text" name="destino" class="form-control" placeholder="Ciudad o ubicación" value="{{ old('destino') }}">
                @error('destino')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="categoria" class="form-label"><i class="fas fa-star"></i> Categoría (Estrellas)</label>
                <select name="categoria" class="form-select">
                    <option value="">Cualquiera</option>
                    <option value="1" {{ old('categoria') == '1' ? 'selected' : '' }}>1 Estrella</option>
                    <option value="2" {{ old('categoria') == '2' ? 'selected' : '' }}>2 Estrellas</option>
                    <option value="3" {{ old('categoria') == '3' ? 'selected' : '' }}>3 Estrellas</option>
                    <option value="4" {{ old('categoria') == '4' ? 'selected' : '' }}>4 Estrellas</option>
                    <option value="5" {{ old('categoria') == '5' ? 'selected' : '' }}>5 Estrellas</option>
                </select>
                @error('categoria')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="precio_noche_max" class="form-label"><i class="fas fa-dollar-sign"></i> Precio Máximo</label>
                <input type="number" class="form-control" name="precio_noche_max" placeholder="Ingrese su presupuesto" value="{{ old('precio_noche_max') }}">
            </div>

            <div class="col-md-6">
                <label for="distancia_centro_max" class="form-label"><i class="fas fa-ruler"></i> Distancia Máxima al Centro (km)</label>
                <input type="number" class="form-control" name="distancia_centro_max" placeholder="Ejemplo: 5" value="{{ old('distancia_centro_max') }}" step="0.01">
            </div>

            <div class="col-md-6">
                <label for="fecha_inicio" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
            </div>

            <div class="col-md-6">
                <label for="fecha_fin" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
            </div>

            <div class="col-md-12">
                <label for="servicios" class="form-label"><i class="fas fa-concierge-bell"></i> Servicios</label>
                <div class="row">
                    @foreach($servicios as $servicio)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" id="servicio_{{ $servicio->id }}" class="form-check-input" {{ in_array($servicio->id, old('servicios', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicio_{{ $servicio->id }}">{{ $servicio->nombre }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('servicios')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-search"></i> Buscar</button>
            </div>
        </div>
    </form>
</div>
@endsection
