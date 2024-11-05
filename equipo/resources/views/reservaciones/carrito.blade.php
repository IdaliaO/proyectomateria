<!-- resources/views/reservaciones/carrito.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrito de Reservaciones</h2>
    <p>Aquí están tus reservaciones pendientes:</p>
    <!-- Aquí se listarán las reservaciones -->
    <x-button type="primary" text="Confirmar Reservación" />
</div>
@endsection
