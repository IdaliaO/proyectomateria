@extends('layouts.admin')

@section('titulo', 'Detalles del Hotel')

@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-bed"></i> {{ $hotel->nombre }}</h1>
        <p class="text-muted">Conoce todos los detalles de este destino único</p>
    </div>
    <div class="card shadow border-0 mb-4" style="border-radius: 15px;">
        <div class="row g-0">
  
            <div class="col-md-6" style="background-image: url('{{ asset($hotel->fotografia) }}'); background-size: cover; background-position: center; border-top-left-radius: 15px; border-bottom-left-radius: 15px;"></div>

 
            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-map-marker-alt"></i> Ubicación</h3>
                    <p class="card-text"><strong>{{ $hotel->ubicacion }}</strong></p>

                    <h3 class="card-title text-primary"><i class="fas fa-star"></i> Categoría</h3>
                    <p class="card-text">{{ $hotel->categoria }} estrellas</p>

                    <h3 class="card-title text-primary"><i class="fas fa-dollar-sign"></i> Precio por Noche</h3>
                    <p class="card-text">${{ number_format($hotel->precio_noche, 2) }}</p>

                    <h3 class="card-title text-primary"><i class="fas fa-check-circle"></i> Disponibilidad</h3>
                    <p class="card-text">
                        @if($hotel->disponibilidad === 'Disponible')
                            <span class="badge bg-success text-white">Disponible</span>
                        @else
                            <span class="badge bg-secondary text-white">Disponible</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 mb-4" style="border-radius: 15px;">
        <div class="card-body">
            <h3 class="card-title text-primary"><i class="fas fa-info-circle"></i> Descripción</h3>
            <p>{{ $hotel->descripcion }}</p>

            <h3 class="card-title text-primary"><i class="fas fa-file-alt"></i> Políticas de Cancelación</h3>
            <p>{{ $hotel->politicas_cancelacion }}</p>
        </div>
    </div>

 
    <div class="card shadow border-0 mb-4" style="border-radius: 15px;">
        <div class="card-body">
            <h3 class="card-title text-primary"><i class="fas fa-concierge-bell"></i> Servicios</h3>
            <ul class="list-group list-group-flush">
                @foreach($servicios as $servicio)
                    <li class="list-group-item">
                        <i class="fas fa-check text-success"></i> {{ $servicio->nombre }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
