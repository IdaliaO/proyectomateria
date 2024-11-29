@extends('layouts.app')
@section('titulo', 'Buscar Hoteles')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Buscar Hoteles</h2>
    <form method="GET" action="{{ route('hoteles.resultados') }}">
        <div class="row">
            <div class="col-md-6">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" name="destino" class="form-control" value="{{ old('destino') }}">
                @error('destino')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
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
            <div class="col-md-6">
                <label for="precio_maximo" class="form-label">Precio Máximo</label>
                <input type="number" class="form-control" name="precio_noche_max" placeholder="Precio máximo" value="{{ request('precio_noche_max') }}">
                </div>
            <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" >
        </div>
            <div class="col-md-6">
                <label for="servicios" class="form-label">Servicios</label>
                @foreach($servicios as $servicio)
                    <div class="form-check">
                        <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" 
                               id="servicio_{{ $servicio->id }}" 
                               class="form-check-input"
                               {{ in_array($servicio->id, old('servicios', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="servicio_{{ $servicio->id }}">{{ $servicio->nombre }}</label>
                    </div>
                @endforeach
                @error('servicios')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>
@endsection
