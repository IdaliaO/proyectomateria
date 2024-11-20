@extends('layouts.admin')

@section('titulo', 'Hoteles')

@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Lista de Hoteles</h2>
    <a href="{{ route('admin.hotel.crear') }}" class="btn btn-success mb-3">Agregar Nuevo Hotel</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Categoría</th>
                <th>Precio por Noche</th>
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
                    <td>{{ $hotel->categoria }} estrellas</td>
                    <td>${{ $hotel->precio_noche }}</td>
                    <td>{{ $hotel->disponibilidad }}</td>
                    <td>
                        <a href="{{ route('admin.hotel.detalles', $hotel->id) }}" class="btn btn-info">Detalles</a>
                        <a href="{{ route('admin.hotel.editar', $hotel->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este hotel?');" style="display:inline-block;">
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
