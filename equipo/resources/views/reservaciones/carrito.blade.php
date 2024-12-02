@extends('layouts.app')
@section('titulo', 'Carrito de Reservaciones')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-shopping-cart"></i> Carrito de Reservaciones</h1>
        <p class="text-muted">Revisa y gestiona tus reservaciones pendientes.</p>
    </div>

    @if($reservaciones->isEmpty())
        <div class="text-center">
            <p class="text-muted">No tienes reservaciones pendientes.</p>
            <a href="{{ route('inicio') }}" class="btn btn-primary btn-lg"><i class="fas fa-search"></i> Explorar Hoteles</a>
        </div>
    @else
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th><i class="fas fa-hotel"></i> Hotel</th>
                            <th><i class="fas fa-calendar-alt"></i> Fecha de Inicio</th>
                            <th><i class="fas fa-calendar-alt"></i> Fecha de Fin</th>
                            <th><i class="fas fa-door-closed"></i> Habitaciones</th>
                            <th><i class="fas fa-moon"></i> Total Noches</th>
                            <th><i class="fas fa-dollar-sign"></i> Total a Pagar</th>
                            <th><i class="fas fa-cogs"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservaciones as $reservacion)
                            <tr>
                                <td>{{ $reservacion->hotel_nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservacion->fecha_inicio)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservacion->fecha_fin)->format('d/m/Y') }}</td>
                                <td>{{ $reservacion->habitaciones ?? 'N/A' }}</td>
                                <td>{{ $reservacion->total_dias }}</td>
                                <td>${{ number_format($reservacion->costo_total, 2) }}</td>
                                <td>
                                    <form action="{{ route('reservaciones.cancelar', ['id' => $reservacion->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancelar</button>
                                    </form>
                                    <form action="{{ route('reservaciones.confirmarPago', ['id' => $reservacion->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-credit-card"></i> Pagar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
