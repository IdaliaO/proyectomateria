@extends('layouts.app')
@section('titulo', 'Resultados de Búsqueda de Hoteles')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Resultados de Búsqueda</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="border p-3 mb-4">
            <form method="GET" action="{{ route('hoteles.resultados') }}">

                    
                    <h5>Filtrar por:</h5>
                    <hr>
                    <h6>Tu presupuesto (por noche)</h6>
                    <input type="number" class="form-control mb-3" name="precio_minimo" placeholder="Precio mínimo" value="{{ request('precio_minimo') }}">
                    <input type="number" class="form-control mb-3" name="precio_maximo" placeholder="Precio máximo" value="{{ request('precio_maximo') }}">

                    <h6 class="mt-4">Categoría (Estrellas)</h6>
                    <div class="mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="categoria" value="{{ $i }}" id="estrella_{{ $i }}" {{ request('categoria') == $i ? 'checked' : '' }}>
                                <label class="form-check-label" for="estrella_{{ $i }}">
                                    {{ $i }} Estrella{{ $i > 1 ? 's' : '' }}
                                </label>
                            </div>
                        @endfor
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria" value="" id="categoria_todas" {{ is_null(request('categoria')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="categoria_todas">Todas las categorías</label>
                        </div>
                    </div>

                    <h6>Distancia al centro (km)</h6>
                    <input type="number" class="form-control mb-3" name="distancia_maxima" placeholder="Máxima distancia" value="{{ request('distancia_maxima') }}">

                    <h6 class="mt-4">Servicios</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="servicios[]" value="wifi" id="servicio_wifi" {{ in_array('wifi', request('servicios', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="servicio_wifi">WiFi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="servicios[]" value="piscina" id="servicio_piscina" {{ in_array('piscina', request('servicios', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="servicio_piscina">Piscina</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="servicios[]" value="desayuno" id="servicio_desayuno" {{ in_array('desayuno', request('servicios', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="servicio_desayuno">Desayuno incluido</label>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            @if($resultados->isEmpty())
                <p>No se encontraron hoteles que coincidan con los criterios de búsqueda.</p>
            @else
                @foreach($resultados as $hotel)
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <!-- Imagen del hotel -->
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
    </div>
</div>
@endsection
