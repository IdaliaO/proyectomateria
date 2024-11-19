@extends('layouts.admin')

@section('contenido')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Vuelos</h1>
    
    <!-- Botón para agregar un nuevo vuelo -->
    <div class="mb-4">
        <a href="{{ route('admin.vuelos.crear') }}" class="btn btn-success">Agregar Nuevo Vuelo</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Aerolínea</th>
                <th>Número de Vuelo</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha de Salida</th>
                <th>Fecha de Llegada</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vuelos as $vuelo)
                <tr>
                    <td>{{ $vuelo->aerolinea }}</td>
                    <td>{{ $vuelo->numero_vuelo }}</td>
                    <td>{{ $vuelo->origen }}</td>
                    <td>{{ $vuelo->destino }}</td>
                    <td>{{ $vuelo->fecha_salida }}</td>
                    <td>{{ $vuelo->fecha_llegada }}</td>
                    <td>{{ $vuelo->precio }}</td>
                    <td>
                        <!-- Formulario para eliminar vuelo -->
                        <form action="{{ route('admin.vuelos.destroy', $vuelo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                        <a href="{{ route('admin.vuelos.edit', $vuelo->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
