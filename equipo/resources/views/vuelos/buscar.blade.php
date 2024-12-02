@extends('layouts.app')
@section('titulo', 'Buscar Vuelos')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-plane-departure"></i> Buscar Vuelos</h1>
        <p class="text-muted">Encuentra el vuelo perfecto para tu próximo viaje.</p>
    </div>

    <div class="card shadow-lg border-0 p-4" style="border-radius: 15px;">
        <form method="GET" action="{{ route('vuelos.resultados') }}">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="origen" class="form-label"><i class="fas fa-map-marker-alt"></i> Origen</label>
                    <input type="text" name="origen" class="form-control" value="{{ old('origen') }}" placeholder="Ciudad de origen">
                    @error('origen')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="destino" class="form-label"><i class="fas fa-map-marker-alt"></i> Destino</label>
                    <input type="text" name="destino" class="form-control" value="{{ old('destino') }}" placeholder="Ciudad de destino">
                    @error('destino')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_salida" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha y Hora de Salida</label>
                    <input type="datetime-local" name="fecha_salida" class="form-control" value="{{ old('fecha_salida') }}">
                    @error('fecha_salida')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_llegada" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha y Hora de Llegada</label>
                    <input type="datetime-local" name="fecha_llegada" class="form-control" value="{{ old('fecha_llegada') }}">
                    @error('fecha_llegada')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="clase" class="form-label"><i class="fas fa-chair"></i> Clase</label>
                    <select name="clase" class="form-select">
                        <option value="economica" {{ old('clase') == 'economica' ? 'selected' : '' }}>Económica</option>
                        <option value="ejecutiva" {{ old('clase') == 'ejecutiva' ? 'selected' : '' }}>Ejecutiva</option>
                        <option value="primera" {{ old('clase') == 'primera' ? 'selected' : '' }}>Primera Clase</option>
                    </select>
                    @error('clase')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="aerolinea" class="form-label"><i class="fas fa-plane"></i> Aerolínea</label>
                    <input type="text" name="aerolinea" class="form-control" value="{{ old('aerolinea') }}" placeholder="Nombre de la aerolínea">
                    @error('aerolinea')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="precio" class="form-label"><i class="fas fa-dollar-sign"></i> Precio Máximo</label>
                    <input type="number" name="precio" class="form-control" min="0" value="{{ old('precio') }}" step="0.01" placeholder="Ingrese su presupuesto">
                    @error('precio')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="escalas" class="form-label"><i class="fas fa-exchange-alt"></i> Escalas</label>
                    <select name="escalas" class="form-select">
                        <option value="">Cualquiera</option>
                        <option value="0" {{ old('escalas') == '0' ? 'selected' : '' }}>Sin escalas</option>
                        <option value="1" {{ old('escalas') == '1' ? 'selected' : '' }}>Con escalas</option>
                    </select>
                    @error('escalas')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5"><i class="fas fa-search"></i> Buscar Vuelos</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
