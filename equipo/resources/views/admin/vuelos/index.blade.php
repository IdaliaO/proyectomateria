@extends('layouts.admin')

@section('contenido')
<div class="container my-5">
    <!-- Título Principal -->
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-plane"></i> Lista de Vuelos</h1>
        <p class="text-muted">Consulta y administra todos los vuelos disponibles.</p>
    </div>

    <!-- Botón para agregar un nuevo vuelo -->
    <div class="mb-4 text-end">
        <a href="{{ route('admin.vuelos.crear') }}" class="btn btn-danger btn-lg">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Vuelo
        </a>
    </div>

    <!-- Tabla de Vuelos -->
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <table class="table table-hover table-bordered">
                <thead class="bg-danger text-white">
                    <tr>
                        <th><i class="fas fa-building"></i> Aerolínea</th>
                        <th><i class="fas fa-barcode"></i> Número de Vuelo</th>
                        <th><i class="fas fa-plane-arrival"></i> Origen</th>
                        <th><i class="fas fa-plane-departure"></i> Destino</th>
                        <th><i class="fas fa-calendar-alt"></i> Fecha de Salida</th>
                        <th><i class="fas fa-calendar-alt"></i> Fecha de Llegada</th>
                        <th><i class="fas fa-dollar-sign"></i> Precio</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vuelos as $vuelo)
                        <tr>
                            <td><i class="fas fa-building text-secondary"></i> {{ $vuelo->aerolinea }}</td>
                            <td><i class="fas fa-barcode text-secondary"></i> {{ $vuelo->numero_vuelo }}</td>
                            <td><i class="fas fa-plane-arrival text-primary"></i> {{ $vuelo->origen }}</td>
                            <td><i class="fas fa-plane-departure text-danger"></i> {{ $vuelo->destino }}</td>
                            <td><i class="fas fa-clock text-secondary"></i> {{ $vuelo->fecha_salida }}</td>
                            <td><i class="fas fa-clock text-secondary"></i> {{ $vuelo->fecha_llegada }}</td>
                            <td><i class="fas fa-dollar-sign text-success"></i> ${{ number_format($vuelo->precio, 2) }}</td>
                            <td>
                                <!-- Botones de acciones -->
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.vuelos.edit', $vuelo->id) }}" class="btn btn-primary btn-sm me-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.vuelos.destroy', $vuelo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
