@extends('layouts.admin')

@section('titulo', 'Gestionar Vuelos')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Vuelos Disponibles</h2>
    <a href="{{ route('admin.vuelo.crear') }}" class="btn btn-success mb-3">Agregar Vuelo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aerolínea</th>
                <th>Número de Vuelo</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vuelos as $vuelo)
                <tr>
                    <td>{{ $vuelo->id }}</td>
                    <td>{{ $vuelo->aerolinea }}</td>
                    <td>{{ $vuelo->numero_vuelo }}</td>
                    <td>{{ $vuelo->origen }}</td>
                    <td>{{ $vuelo->destino }}</td>
                    <td>{{ $vuelo->precio }}</td>
                    <td>
                        <form action="{{ route('admin.vuelo.destroy', $vuelo->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este vuelo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
