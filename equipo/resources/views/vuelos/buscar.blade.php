@extends('layouts.app')
@section('titulo', 'Buscar Vuelos')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Buscar Vuelos</h2>
    <form method="GET" action="{{ route('vuelos.resultados') }}">
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
                <label for="fecha_salida" class="form-label">Fecha y Hora de Salida</label>
                <input type="datetime-local" name="fecha_salida" class="form-control" value="{{ old('fecha_salida') }}">
                @error('fecha_salida')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="fecha_llegada" class="form-label">Fecha y Hora de Llegada</label>
                <input type="datetime-local" name="fecha_llegada" class="form-control" value="{{ old('fecha_llegada') }}">
                @error('fecha_llegada')
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
                <input type="number" name="precio" class="form-control" min="0" value="{{ old('precio') }}" step="0.01">
                @error('precio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="escalas" class="form-label">Escalas</label>
                <select name="escalas" class="form-select">
                    <option value="">Cualquiera</option>
                    <option value="0" {{ old('escalas') == '0' ? 'selected' : '' }}>Sin escalas</option>
                    <option value="1" {{ old('escalas') == '1' ? 'selected' : '' }}>Con escalas</option>
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

