@extends('layouts.admin')

@section('titulo', 'Gestionar Hoteles')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Hoteles Disponibles</h2>
    <a href="{{ route('admin.hotel.crear') }}" class="btn btn-success mb-3">Agregar Hotel</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Tarifa</th>
                <th>Disponibilidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hoteles as $hotel)
                <tr>
                    <td>{{ $hotel->id }}</td>
                    <td>{{ $hotel->nombre }}</td>
                    <td>{{ $hotel->ubicacion }}</td>
                    <td>{{ $hotel->tarifa }}</td>
                    <td>{{ $hotel->disponibilidad }}</td>
                    <td>
                        <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este hotel?');">
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
