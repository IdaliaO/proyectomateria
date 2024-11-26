@extends('layouts.app')
@section('titulo', 'Buscar Vuelos')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Buscar Vuelos</h2>
    <form method="GET" action="{{ route('resultados.vuelos') }}">
        <div class="row">
            <div class="col-md-6">
                <label for="origen" class="form-label">Origen</label>
                <input type="text" name="origen" class="form-control" value="{{ old('origen') }}">
                @error('origen')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" name="destino" class="form-control" value="{{ old('destino') }}">
                @error('destino')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="fecha_salida" class="form-label">Fecha de salida</label>
                <input type="date" name="fecha_salida" class="form-control" value="{{ old('fecha_salida') }}">
                @error('fecha_salida')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="fecha_regreso" class="form-label">Fecha de regreso (opcional)</label>
                <input type="date" name="fecha_regreso" class="form-control" value="{{ old('fecha_regreso') }}">
                @error('fecha_regreso')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="pasajeros" class="form-label">Número de Pasajeros</label>
                <input type="number" name="pasajeros" class="form-control" min="1" value="{{ old('pasajeros') }}">
                @error('pasajeros')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="clase" class="form-label">Clase</label>
                <select name="clase" class="form-select">
                    <option value="economica" {{ old('clase') == 'economica' ? 'selected' : '' }}>Económica</option>
                    <option value="ejecutiva" {{ old('clase') == 'ejecutiva' ? 'selected' : '' }}>Ejecutiva</option>
                    <option value="primera" {{ old('clase') == 'primera' ? 'selected' : '' }}>Primera Clase</option>
                </select>
                @error('clase')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="aerolinea" class="form-label">Aerolínea</label>
                <input type="text" name="aerolinea" class="form-control" value="{{ old('aerolinea') }}">
                @error('aerolinea')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="precio" class="form-label">Precio Máximo</label>
                <input type="number" name="precio" class="form-control" min="0" value="{{ old('precio') }}">
                @error('precio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="escalas" class="form-label">Escalas</label>
                <select name="escalas" class="form-select">
                    <option value="">Cualquiera</option>
                    <option value="0" {{ old('escalas') == '0' ? 'selected' : '' }}>Sin escalas</option>
                    <option value="1" {{ old('escalas') == '1' ? 'selected' : '' }}>1 Escala</option>
                    <option value="2" {{ old('escalas') == '2' ? 'selected' : '' }}>2 o más escalas</option>
                </select>
                @error('escalas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Buscar Vuelos</button>
            </div>
        </div>
    </form>
</div>
@endsection
