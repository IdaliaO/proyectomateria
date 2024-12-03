@extends('layouts.app')

@section('titulo', 'Carrito de Reservaciones')

@section('contenido')
<div class="container my-5">
    <h2>Tu Carrito de Reservaciones</h2>

    <h3>Reservaciones de Hoteles</h3>
    @if ($reservacionesHoteles->isEmpty())
        <div class="alert alert-warning">
            No tienes reservaciones de hoteles.
        </div>
    @else
        <ul class="list-group">
            @foreach ($reservacionesHoteles as $reservacion)
                <li class="list-group-item">
                    <strong>Hotel:</strong> {{ $reservacion->hotel_nombre }} <br>
                    <strong>Precio por noche:</strong> ${{ number_format($reservacion->precio_noche, 2) }} <br>
                    <strong>Fecha de reserva:</strong> {{ \Carbon\Carbon::parse($reservacion->created_at)->format('d-m-Y') }} <br>
                    <strong>Adultos:</strong> {{ $reservacion->adultos }} <br>
                    <strong>Niños:</strong> {{ $reservacion->ninos }} <br>
                    <strong>Noches:</strong> {{ $reservacion->noches }} <br>
                    <strong>Total:</strong> ${{ number_format($reservacion->precio_noche * $reservacion->adultos * $reservacion->noches, 2) }}
                </li>
            @endforeach
        </ul>
    @endif

    <h3>Reservaciones de Vuelos</h3>
    @if ($reservacionesVuelos->isEmpty())
        <div class="alert alert-warning">
            No tienes reservaciones de vuelos.
        </div>
    @else
        <ul class="list-group">
            @foreach ($reservacionesVuelos as $reservacion)
                <li class="list-group-item">
                    <strong>Vuelo:</strong> {{ $reservacion->numero_vuelo }} <br>
                    <strong>Aerolínea:</strong> {{ $reservacion->aerolinea }} <br>
                    <strong>Precio:</strong> ${{ number_format($reservacion->precio, 2) }} <br>
                    <strong>Fecha de vuelo:</strong> {{ \Carbon\Carbon::parse($reservacion->created_at)->format('d-m-Y') }} <br>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
