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
                    <input type="hidden" name="destino" value="{{ request('destino') }}">

                    <label for="precio_noche_max" class="form-label">Tu presupuesto (por noche)</label>
                    <input type="number" class="form-control" name="precio_noche_max" placeholder="Precio máximo" value="{{ old('precio_noche_max') }}">

                    <h6 class="mt-4">Categoría (Estrellas)</h6>
                    <div class="mb-3">
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

                    <h6 class="mt-4">Servicios</h6>
                    @foreach($servicios as $servicio)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}" id="servicio_{{ $servicio->id }}" {{ in_array($servicio->id, old('servicios', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_{{ $servicio->id }}">{{ $servicio->nombre }}</label>
                        </div>
                    @endforeach

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
                                <div style="
                                    background-image: url('{{ $hotel->fotografia ? asset($hotel->fotografia) : asset('images/default-hotel.jpg') }}');
                                    background-size: cover;
                                    background-position: center;
                                    height: 200px;
                                    border-top-left-radius: 15px;
                                    border-bottom-left-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hotel->nombre }}</h5>
                                    <p><strong>Ubicación:</strong> {{ $hotel->ubicacion }}</p>
                                    <p><strong>Estrellas:</strong> {{ $hotel->categoria }}</p>
                                    <p><strong>Precio por noche:</strong> ${{ number_format($hotel->precio_noche, 2) }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('hoteles.detalle', ['id' => $hotel->id]) }}" class="btn btn-primary">Detalles</a>
                                        <button class="btn btn-success reservar-btn" data-hotel-id="{{ $hotel->id }}">Reservar</button>
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
            @if(auth()->check())
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
