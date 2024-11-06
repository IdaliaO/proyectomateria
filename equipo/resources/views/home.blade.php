@extends('layouts.app')

@section('titulo', 'Inicio | Los Cardenales')

@section('contenido')
<div class="container my-4">
    <!-- Sección de Encabezado -->
    <div class="text-center mb-4">
        <h1 class="mt-3">Explora y Reserva con Los Cardenales</h1>
        <p class="lead">Encuentra los mejores vuelos y alojamientos para tu viaje</p>
    </div>

    <!-- Formulario de Búsqueda -->
    <div class="card p-4 mb-5 shadow-sm">
        <h3 class="mb-4 text-center">Busca tu viaje ideal</h3>
        <ul class="nav nav-tabs mb-3 justify-content-center" id="searchTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link @if(old('form_type') === 'vuelos' || !old('form_type')) active @endif" id="vuelos-tab" data-bs-toggle="tab" data-bs-target="#vuelos" type="button" role="tab" aria-controls="vuelos" aria-selected="true">Vuelos</button>
            </li>
            <li class="nav-item">
                <button class="nav-link @if(old('form_type') === 'hoteles') active @endif" id="hoteles-tab" data-bs-toggle="tab" data-bs-target="#hoteles" type="button" role="tab" aria-controls="hoteles" aria-selected="false">Hoteles</button>
            </li>
        </ul>
        <div class="tab-content" id="searchTabContent">
            <!-- Formulario de Búsqueda de Vuelos -->
            <div class="tab-pane fade @if(old('form_type') === 'vuelos' || !old('form_type')) show active @endif" id="vuelos" role="tabpanel" aria-labelledby="vuelos-tab">
                <form action="{{ route('resultados.vuelos') }}" method="GET" class="row g-3">
                    <input type="hidden" name="form_type" value="vuelos">
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

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Buscar Vuelos</button>
                    </div>
                </form>
            </div>

            <!-- Formulario de Búsqueda de Hoteles -->
            <div class="tab-pane fade @if(old('form_type') === 'hoteles') show active @endif" id="hoteles" role="tabpanel" aria-labelledby="hoteles-tab">
    <form action="{{ route('hoteles.resultados') }}" method="GET" class="row g-3">
        <input type="hidden" name="form_type" value="hoteles">
        <div class="col-md-6">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" class="form-control" value="{{ old('destino') }}">
            @error('destino')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="fecha_checkin" class="form-label">Fecha de Check-in</label>
            <input type="date" name="fecha_checkin" class="form-control" value="{{ old('fecha_checkin') }}">
            @error('fecha_checkin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="fecha_checkout" class="form-label">Fecha de Check-out</label>
            <input type="date" name="fecha_checkout" class="form-control" value="{{ old('fecha_checkout') }}">
            @error('fecha_checkout')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 offset-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Buscar Hoteles</button>
        </div>
    </form>
</div>
        </div>
    </div>
</div>
@endsection
