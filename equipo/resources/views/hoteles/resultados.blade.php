@extends('layouts.app')
@section('titulo', 'Resultados de Búsqueda de Hoteles')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-hotel"></i> Resultados de Búsqueda</h1>
        <p class="text-muted">Encuentra el hotel ideal para tu próximo viaje.</p>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-lg border-0 p-3" style="border-radius: 15px;">
                <form method="GET" action="{{ route('hoteles.resultados') }}">
                    <h4 class="text-primary"><i class="fas fa-filter"></i> Filtrar por:</h4>
                    <hr>
                    <input type="hidden" name="destino" value="{{ request('destino') }}">

                    <div class="mb-3">
                        <label for="precio_noche_max" class="form-label"><i class="fas fa-dollar-sign"></i> Tu presupuesto (por noche)</label>
                        <input type="number" class="form-control" name="precio_noche_max" placeholder="Precio máximo" value="{{ old('precio_noche_max') }}">
                    </div>

                    <div class="mb-3">
                        <h5><i class="fas fa-star"></i> Categoría (Estrellas)</h5>
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="categoria" value="{{ $i }}" id="estrella_{{ $i }}" {{ old('categoria') == $i ? 'checked' : '' }}>
                                <label class="form-check-label" for="estrella_{{ $i }}">
                                    {{ $i }} Estrella{{ $i > 1 ? 's' : '' }}
                                </label>
                            </div>
                        @endfor
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria" value="" id="categoria_todas" {{ is_null(old('categoria')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="categoria_todas">Todas las categorías</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5><i class="fas fa-concierge-bell"></i> Servicios</h5>
                        @foreach($servicios as $servicio)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}" id="servicio_{{ $servicio->id }}" {{ in_array($servicio->id, old('servicios', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="servicio_{{ $servicio->id }}">{{ $servicio->nombre }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="distancia_max" class="form-label"><i class="fas fa-map-marker-alt"></i> Distancia al Centro (km)</label>
                        <input type="number" class="form-control" name="distancia_max" placeholder="Distancia máxima" value="{{ old('distancia_max') }}" step="0.1">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Aplicar Filtros</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            @if($resultados->isEmpty())
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle"></i> No se encontraron hoteles que coincidan con los criterios de búsqueda.
                </div>
            @else
                @foreach($resultados as $hotel)
                    <div class="card mb-4 shadow-lg border-0" style="border-radius: 15px;">
                        <div class="row g-0">
                            <div class="col-md-4" style="background-image: url('{{ $hotel->fotografia ? asset($hotel->fotografia) : asset('images/default-hotel.jpg') }}'); background-size: cover; background-position: center; height: 200px; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title text-primary"><i class="fas fa-bed"></i> {{ $hotel->nombre }}</h4>
                                    <p><strong><i class="fas fa-map-marker-alt"></i> Ubicación:</strong> {{ $hotel->ubicacion }}</p>
                                    <p><strong><i class="fas fa-ruler"></i> Distancia al Centro:</strong> {{ $hotel->distancia_centro }} km</p>
                                    <p><strong><i class="fas fa-star"></i> Estrellas:</strong> {{ $hotel->categoria }}</p>
                                    <p><strong><i class="fas fa-check-circle"></i> Disponibilidad:</strong> {{ $hotel->disponibilidad }}</p>
                                    <p><strong><i class="fas fa-dollar-sign"></i> Precio por noche:</strong> ${{ number_format($hotel->precio_noche, 2) }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('hoteles.detalle', ['id' => $hotel->id]) }}" class="btn btn-primary"><i class="fas fa-info-circle"></i> Detalles</a>
                                        <button class="btn btn-success reservar-btn" data-hotel-id="{{ $hotel->id }}"><i class="fas fa-check"></i> Reservar</button>
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
<script>
    document.querySelectorAll('.reservar-btn').forEach(button => {
        button.addEventListener('click', function () {
            const hotelId = this.getAttribute('data-hotel-id');

            @if(Session::get('autenticado'))
                window.location.href = `/reservacion/${hotelId}`;
            @else
                Swal.fire({
                    title: 'Inicia Sesión',
                    text: 'Debes iniciar sesión para reservar.',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            @endif
        });
    });
</script>
@endsection
