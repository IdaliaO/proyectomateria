@extends('admin.dashboard')
@section('content')
    <h2>Crear Nuevo Vuelo</h2>

    <!-- Formulario de creación de vuelo -->
    <form action="{{ route('admin.vuelo.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" class="form-control" id="origen" name="origen" required>
        </div>

        <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" class="form-control" id="destino" name="destino" required>
        </div>

        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha de Salida</label>
            <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
        </div>

        <button type="submit" class="btn btn-success">Crear Vuelo</button>
    </form>
@endsection
