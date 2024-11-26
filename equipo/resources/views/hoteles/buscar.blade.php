@extends('layouts.app')
@section('titulo', 'Buscar Hoteles')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Buscar Hoteles</h2>
    <form method="GET" action="{{ route('hoteles.resultados') }}">
        @csrf
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
        @if(isset($resultados))
        <div class="col-md-9 mt-5">
            @if($resultados->isEmpty())
                <p>No se encontraron hoteles que coincidan con los criterios de búsqueda.</p>
            @else
                @foreach($resultados as $hotel)
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('imagenes/hoteles/' . $hotel->id . '_1.jpg') }}" class="img-fluid rounded-start" alt="{{ $hotel->nombre }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="card-title">{{ $hotel->nombre }}</h5>
                                            <p class="text-muted">{{ $hotel->destino }} - <a href="#">Mostrar en el mapa</a> - a {{ $hotel->distancia_centro }} km del centro</p>
                                            <p class="mb-1"><strong>Calificación: </strong>{{ $hotel->calificacion }} / 10 ({{ rand(20, 1500) }} comentarios)</p>
                                            <p class="mb-1"><strong>Estrellas: </strong>{{ $hotel->numero_estrellas }} {{ $hotel->numero_estrellas > 1 ? 'Estrellas' : 'Estrella' }}</p>
                                            <p class="mb-1"><strong>Habitación: </strong>{{ $hotel->capacidad }} huéspedes</p>
                                            <p class="mb-2"><strong>Servicios: </strong>{{ implode(', ', $hotel->servicios ?? []) }}</p>
                                            <p class="card-text">Precio por noche: <strong>COP {{ number_format($hotel->precio_por_noche, 2) }}</strong></p>
                                        </div>
                                        <div>
                                            <a href="{{ route('hoteles.detalle', ['id' => $hotel->id]) }}" class="btn btn-primary">Ver disponibilidad</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
@endsection
