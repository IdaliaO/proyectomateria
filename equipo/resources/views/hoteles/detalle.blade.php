@extends('layouts.app')
@section('titulo', 'Detalles del Hotel')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">{{ $hotel->nombre }}</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $hotel->fotografia ? asset($hotel->fotografia) : asset('images/default-hotel.jpg') }}" class="img-fluid rounded" alt="{{ $hotel->nombre }}">
        </div>
        <div class="col-md-6">
            <h4>Información General</h4>
            <p><strong>Ubicación:</strong> {{ $hotel->ubicacion }}</p>
            <p><strong>Categoría:</strong> {{ $hotel->categoria }} estrellas</p>
            <p><strong>Precio por noche:</strong> ${{ number_format($hotel->precio_noche, 2) }}</p>
            <p><strong>Disponibilidad:</strong> {{ $hotel->disponibilidad }} habitaciones</p>
            <h4>Descripción</h4>
            <p>{{ $hotel->descripcion }}</p>
            <h4>Servicios</h4>
            <ul>
                @foreach($servicios as $servicio)
                    <li>{{ $servicio->nombre }}</li>
                @endforeach
            </ul>
            <div class="mt-4">
                <button class="btn btn-primary" id="reservarBtn">Reservar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('reservarBtn').addEventListener('click', function() {
        @if(Auth::check())
            window.location.href = "{{ route('reservacion.pasos', ['id' => $hotel->id]) }}";
        @else
            Swal.fire({
                title: 'Inicia Sesión',
                text: 'Debes iniciar sesión para reservar.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            });
        @endif
    });
</script>
@endsection
