@extends('layouts.app')
@section('titulo', $hotel->nombre)
@section('contenido')
<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $hotel->nombre }}</h2>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('imagenes/hoteles/' . $hotel->id . '_1.jpg') }}" class="d-block w-100" alt="{{ $hotel->nombre }}">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <h4>Información General</h4>
            <p><strong>Destino:</strong> {{ $hotel->destino }}</p>
            <p><strong>Calificación:</strong> {{ $hotel->calificacion }} / 10</p>
            <p><strong>Estrellas:</strong> {{ $hotel->numero_estrellas }}</p>
            <p><strong>Precio por noche:</strong> COP {{ number_format($hotel->precio_por_noche, 2) }}</p>
            <p><strong>Servicios:</strong> {{ implode(', ', $hotel->servicios ?? []) }}</p>
            <p><strong>Políticas de Cancelación:</strong> {{ $hotel->politicas_cancelacion }}</p>
        </div>
    </div>
    <div class="mt-5">
        <h4>Comentarios de los usuarios</h4>
        <p>Esta sección podría incluir comentarios de los usuarios sobre el hotel.</p>
    </div>
</div>
@endsection
