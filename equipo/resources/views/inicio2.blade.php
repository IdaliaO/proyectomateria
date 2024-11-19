@extends('layouts.app')

@section('titulo', 'Inicio | Los Cardenales')

@section('contenido')
<div class="container my-4">
    <h1>Bienvenido a Los Cardenales</h1>
    <p>Explora y reserva los mejores vuelos y alojamientos para tu viaje.</p>
</div>
@endsection

@section('scripts')
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Registro Exitoso!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@endsection

