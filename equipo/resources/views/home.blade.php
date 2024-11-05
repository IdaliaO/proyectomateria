@extends('layouts.app')

@section('titulo', 'Inicio | Los Cardenales')

@section('contenido')
<div class="container my-4">
    <!-- Sección de Encabezado -->
    <div class="text-center mb-4">
        <h1 class="mt-3">Explora y Reserva con Los Cardenales</h1>
        <p class="lead">Encuentra los mejores vuelos y alojamientos para tu viaje</p>
    </div>

    <!-- Formulario de Búsqueda -->
    <div class="card p-4 mb-5 shadow-sm">
        <h3 class="mb-4 text-center">Busca tu viaje ideal</h3>
        <ul class="nav nav-tabs mb-3 justify-content-center" id="searchTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="vuelos-tab" data-bs-toggle="tab" data-bs-target="#vuelos" type="button" role="tab" aria-controls="vuelos" aria-selected="true">Vuelos</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="hoteles-tab" data-bs-toggle="tab" data-bs-target="#hoteles" type="button" role="tab" aria-controls="hoteles" aria-selected="false">Hoteles</button>
            </li>
        </ul>
        <div class="tab-content" id="searchTabContent">
            <!-- Formulario de Búsqueda de Vuelos -->
            <div class="tab-pane fade show active" id="vuelos" role="tabpanel" aria-labelledby="vuelos-tab">
                <form action="{{ route('buscar.vuelos') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <label for="origen" class="form-label">Origen</label>
                        <input type="text" name="origen" class="form-control" placeholder="Ciudad de origen" required>
                    </div>
                    <div class="col-md-6">
                        <label for="destino" class="form-label">Destino</label>
                        <input type="text" name="destino" class="form-control" placeholder="Ciudad de destino" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_salida" class="form-label">Fecha de salida</label>
                        <input type="date" name="fecha_salida" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_regreso" class="form-label">Fecha de regreso</label>
                        <input type="date" name="fecha_regreso" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="pasajeros" class="form-label">Pasajeros</label>
                        <input type="number" name="pasajeros" class="form-control" min="1" value="1" required>
                    </div>
                    <div class="col-md-4">
                        <label for="clase" class="form-label">Clase</label>
                        <select name="clase" class="form-control">
                            <option value="economica">Económica</option>
                            <option value="ejecutiva">Ejecutiva</option>
                            <option value="primera">Primera Clase</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Buscar Vuelos</button>
                    </div>
                </form>
            </div>

            <!-- Formulario de Búsqueda de Hoteles -->
            <div class="tab-pane fade" id="hoteles" role="tabpanel" aria-labelledby="hoteles-tab">
                <form action="{{ route('buscar.hoteles') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <label for="destino_hotel" class="form-label">Destino</label>
                        <input type="text" name="destino" class="form-control" placeholder="Ciudad o punto turístico" required>
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_checkin" class="form-label">Fecha de check-in</label>
                        <input type="date" name="fecha_checkin" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_checkout" class="form-label">Fecha de check-out</label>
                        <input type="date" name="fecha_checkout" class="form-control" required>
                    </div>
                    <div class="col-md-4 offset-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Buscar Hoteles</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
