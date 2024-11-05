@extends('layouts.app')

@section('titulo', 'Resultados de Hoteles')

@section('contenido')
<div class="container my-4">
    <h2>Resultados de Hoteles</h2>
    @if($resultados->isEmpty())
        <p>No se encontraron hoteles para los criterios de búsqueda especificados.</p>
    @else
        <div class="row">
            @foreach($resultados as $hotel)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->nombre }}</h5>
                            <p>Destino: {{ $hotel->destino }}</p>
                            <p>Categoría: {{ $hotel->numero_estrellas }} Estrellas</p>
                            <p>Precio por noche: ${{ $hotel->precio_noche }}</p>
                            <p>Servicios: {{ implode(', ', json_decode($hotel->servicios, true)) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
