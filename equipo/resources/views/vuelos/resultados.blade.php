@extends('layouts.app')
@section('titulo', 'Resultados de Vuelos')
@section('contenido')
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-3">
                <h4>Filtros</h4>
                <form method="GET" action="{{ route('vuelos.resultados') }}">
                    <input type="hidden" name="origen" value="{{ request('origen') }}">
                    <input type="hidden" name="destino" value="{{ request('destino') }}">
                    <input type="hidden" name="fecha_salida" value="{{ request('fecha_salida') }}">
                    <input type="hidden" name="fecha_llegada" value="{{ request('fecha_llegada') }}">
                    <input type="hidden" name="disponibilidad" value="{{ request('disponibilidad') }}">
                    <input type="hidden" name="clase" value="{{ request('clase') }}">
                    <input type="hidden" name="aerolinea" value="{{ request('aerolinea') }}">
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
                        <label for="precio" class="form-label">Precio Máximo</label>
                        <input type="number" name="precio" class="form-control" value="{{ request('precio') }}">
                    </div>
                    <div class="mb-3">
                        <label for="hora_salida" class="form-label">Horario de Salida</label>
                        <input type="time" name="hora_salida" class="form-control" value="{{ request('hora_salida') }}">
                    </div>
                    <div class="mb-3">
                        <label for="hora_llegada" class="form-label">Horario de Llegada</label>
                        <input type="time" name="hora_llegada" class="form-control" value="{{ request('hora_llegada') }}">
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
                            <th>Horario</th>
                            <th>Duración del Vuelo</th>
                            <th>Precio por Pasajero</th>
                            <th>Escalas</th>
                            <th>Disponibilidad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultados as $vuelo)
                            <tr>
                                <td>{{ $vuelo->numero_vuelo }}</td>
                                <td>{{ $vuelo->aerolinea }}</td>
                                <td>{{ \Carbon\Carbon::parse($vuelo->fecha_salida)->format('d-m-Y H:i') }} - {{ \Carbon\Carbon::parse($vuelo->fecha_llegada)->format('d-m-Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($vuelo->fecha_salida)->diffInHours(\Carbon\Carbon::parse($vuelo->fecha_llegada)) }} horas</td>
                                <td>${{ number_format($vuelo->precio, 2) }}</td>
                                <td>{{ $vuelo->escalas ? 'Con escalas' : 'Sin escalas' }}</td>
                                <td>{{ $vuelo->disponibilidad > 0 ? 'Disponible' : 'No disponible' }}</td>
                                <td>
                                    <button class="btn btn-success" {{ $vuelo->disponibilidad > 0 ? '' : 'disabled' }}>Agregar al Carrito</button>
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

