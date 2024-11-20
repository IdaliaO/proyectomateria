@extends('layouts.admin')

@section('titulo', 'Detalles del Hotel')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Detalles del Hotel: {{ $hotel->nombre }}</h2>
    <div class="card mb-4">
        <div class="card-header">
            <h3>{{ $hotel->nombre }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Ubicación:</strong> {{ $hotel->ubicacion }}</p>
            <p><strong>Categoría:</strong> {{ $hotel->categoria }} estrellas</p>
            <p><strong>Precio por Noche:</strong> ${{ $hotel->precio_noche }}</p>
            <p><strong>Disponibilidad de Habitaciones:</strong> {{ $hotel->disponibilidad }}</p>
            <p><strong>Descripción:</strong> {{ $hotel->descripcion }}</p>
            <p><strong>Políticas de Cancelación:</strong> {{ $hotel->politicas_cancelacion }}</p>
            <p><strong>Servicios:</strong></p>
            <ul>
                @foreach($servicios as $servicio)
                    <li>{{ $servicio->nombre }}</li>
                @endforeach
            </ul>
            <div class="mb-4">
                <strong>Fotografía:</strong><br>
                <img src="{{ asset($hotel->fotografia) }}" alt="{{ $hotel->nombre }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection
