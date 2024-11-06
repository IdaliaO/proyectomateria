@extends('admin.dashboard')

@section('content')
    <h2>Gestión de Vuelos</h2>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botón para agregar un nuevo vuelo -->
    <a href="{{ route('admin.vuelo.crear') }}" class="btn btn-primary mb-3">Agregar Vuelo</a>

    <!-- Tabla de vuelos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vuelos as $vuelo)
                <tr>
                    <td>{{ $vuelo->id }}</td>
                    <td>{{ $vuelo->origen }}</td>
                    <td>{{ $vuelo->destino }}</td>
                    <td>{{ $vuelo->fecha_salida }}</td>
                    <td>
                        <form action="{{ route('admin.vuelo.destroy', $vuelo->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
