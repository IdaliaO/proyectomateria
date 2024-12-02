@extends('layouts.app')
@section('titulo', 'Resultados de Vuelos')
@section('contenido')
<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-lg border-0 p-3" style="border-radius: 15px;">
                <h4 class="text-primary"><i class="fas fa-filter"></i> Filtros</h4>
                <form method="GET" action="{{ route('vuelos.resultados') }}">
                    <input type="hidden" name="origen" value="{{ request('origen') }}">
                    <input type="hidden" name="destino" value="{{ request('destino') }}">
                    <input type="hidden" name="fecha_salida" value="{{ request('fecha_salida') }}">
                    <input type="hidden" name="fecha_llegada" value="{{ request('fecha_llegada') }}">
                    <input type="hidden" name="disponibilidad" value="{{ request('disponibilidad') }}">
                    <input type="hidden" name="clase" value="{{ request('clase') }}">
                    <input type="hidden" name="aerolinea" value="{{ request('aerolinea') }}">

                    <div class="mb-3">
                        <label for="escalas" class="form-label"><i class="fas fa-exchange-alt"></i> Escalas</label>
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
                        <label for="aerolinea" class="form-label"><i class="fas fa-plane"></i> Aerolínea</label>
                        <input type="text" name="aerolinea" class="form-control" value="{{ request('aerolinea') }}" placeholder="Nombre de la aerolínea">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label"><i class="fas fa-dollar-sign"></i> Precio Máximo</label>
                        <input type="number" name="precio" class="form-control" value="{{ request('precio') }}" placeholder="Ingrese un presupuesto">
                    </div>
                    <div class="mb-3">
                        <label for="hora_salida" class="form-label"><i class="fas fa-clock"></i> Horario de Salida</label>
                        <input type="time" name="hora_salida" class="form-control" value="{{ request('hora_salida') }}">
                    </div>
                    <div class="mb-3">
                        <label for="hora_llegada" class="form-label"><i class="fas fa-clock"></i> Horario de Llegada</label>
                        <input type="time" name="hora_llegada" class="form-control" value="{{ request('hora_llegada') }}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Aplicar Filtros</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <h2 class="text-primary mb-4"><i class="fas fa-plane-departure"></i> Resultados de Búsqueda</h2>
            @if($resultados->isEmpty())
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle"></i> No se encontraron vuelos para los criterios de búsqueda especificados.
                </div>
            @else
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th><i class="fas fa-barcode"></i> Número de Vuelo</th>
                            <th><i class="fas fa-plane"></i> Aerolínea</th>
                            <th><i class="fas fa-clock"></i> Horario</th>
                            <th><i class="fas fa-hourglass-half"></i> Duración</th>
                            <th><i class="fas fa-dollar-sign"></i> Precio</th>
                            <th><i class="fas fa-exchange-alt"></i> Escalas</th>
                            <th><i class="fas fa-check-circle"></i> Disponibilidad</th>
                            <th><i class="fas fa-cart-plus"></i> Acción</th>
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
                                <td>
                                    @if($vuelo->disponibilidad > 0)
                                        <span class="badge bg-success">Disponible</span>
                                    @else
                                        <span class="badge bg-danger">No disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm" {{ $vuelo->disponibilidad > 0 ? '' : 'disabled' }}>
                                        <i class="fas fa-cart-plus"></i> Agregar
                                    </button>
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
