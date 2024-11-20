<!-- resources/views/vuelos/resultados.blade.php -->
@extends('layouts.app')

@section('titulo', 'Resultados de Vuelos')

@section('contenido')
<div class="container my-4">
    <div class="row">
        <!-- Filtros -->
        <div class="col-md-3">
            <div class="card p-3">
                <h4>Filtros</h4>
                <form method="GET" action="{{ route('resultados.vuelos') }}">
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
                        <label for="horario_salida" class="form-label">Horario de Salida</label>
                        <select name="horario_salida" class="form-select">
                            <option value="">Cualquiera</option>
                            <option value="manana" {{ request('horario_salida') == 'manana' ? 'selected' : '' }}>Mañana (6am - 12pm)</option>
                            <option value="tarde" {{ request('horario_salida') == 'tarde' ? 'selected' : '' }}>Tarde (12pm - 6pm)</option>
                            <option value="noche" {{ request('horario_salida') == 'noche' ? 'selected' : '' }}>Noche (6pm - 12am)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="precio_maximo" class="form-label">Precio Máximo</label>
                        <input type="number" name="precio" class="form-control" value="{{ request('precio') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                </form>
            </div>
        </div>

        <!-- Resultados -->
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
                            <th>Horario</th>
                            <th>Duración</th>
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
                                <td>{{ $vuelo->horario }}</td>
                                <td>{{ $vuelo->duracion }}</td>
                                <td>${{ $vuelo->precio }}</td>
                                <td>{{ $vuelo->escalas == '0' ? 'Sin escalas' : 'Con escalas' }}</td>
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
