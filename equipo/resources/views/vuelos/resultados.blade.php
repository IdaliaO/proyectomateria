@extends('layouts.app')
@section('titulo', 'Resultados de Vuelos')
@section('contenido')
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-3">
                <h4>Filtros</h4>
                <form method="GET" action="{{ route('vuelos.resultados') }}">
                    <div class="mb-3">
                        <label for="escalas" class="form-label">Escalas</label>
                        <div>
                            <input type="radio" name="escalas" value="" {{ request('escalas') === null ? 'checked' : '' }}> Cualquiera
                        </div>
                        <div>
                            <input type="radio" name="escalas" value="0" {{ request('escalas') == '0' ? 'checked' : '' }}> Sin escalas
                        </div>
                        <div>
                            <input type="radio" name="escalas" value="1" {{ request('escalas') == '1' ? 'checked' : '' }}> Con escalas
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="aerolinea" class="form-label">Aerolínea</label>
                        <input type="text" name="aerolinea" class="form-control" value="{{ request('aerolinea') }}">
                    </div>
                    <div class="mb-3">
                        <label for="precio_maximo" class="form-label">Precio Máximo</label>
                        <input type="number" name="precio" class="form-control" value="{{ request('precio') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <h2>Resultados de Búsqueda de Vuelos</h2>
            @if($resultados->isEmpty())
                <p>No se encontraron vuelos para los criterios de búsqueda especificados.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Número de Vuelo</th>
                            <th>Aerolínea</th>
                            <th>Fecha de Salida</th>
                            <th>Fecha de Llegada</th>
                            <th>Clase</th>
                            <th>Precio</th>
                            <th>Escalas</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultados as $vuelo)
                            <tr>
                                <td>{{ $vuelo->numero_vuelo }}</td>
                                <td>{{ $vuelo->aerolinea }}</td>
                                <td>{{ \Carbon\Carbon::parse($vuelo->fecha_salida)->format('d-m-Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($vuelo->fecha_llegada)->format('d-m-Y H:i') }}</td>
                                <td>{{ ucfirst($vuelo->clase) }}</td>
                                <td>${{ number_format($vuelo->precio, 2) }}</td>
                                <td>{{ $vuelo->escalas ? 'Con escalas' : 'Sin escalas' }}</td>
                                <td>
                                    <button class="btn btn-success">Agregar al Carrito</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
