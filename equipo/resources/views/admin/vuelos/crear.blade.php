@extends('layouts.admin')

@section('contenido')
<div class="container mt-4">
    <h1 class="mb-4">Crear Nuevo Vuelo</h1>
    <form method="POST" action="{{ route('admin.vuelo.store') }}">
        @csrf
        <div class="mb-3">
            <label for="aerolinea" class="form-label">Aerolínea</label>
            <input type="text" class="form-control" name="aerolinea" value="{{ old('aerolinea') }}" >
            @error('aerolinea')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="numero_vuelo" class="form-label">Número de Vuelo</label>
            <input type="text" class="form-control" name="numero_vuelo" value="{{ old('numero_vuelo') }}" >
            @error('numero_vuelo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" class="form-control" name="origen" value="{{ old('origen') }}" >
            @error('origen')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" class="form-control" name="destino" value="{{ old('destino') }}" >
            @error('destino')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha de Salida</label>
            <input type="datetime-local" class="form-control" name="fecha_salida" value="{{ old('fecha_salida') }}" >
            @error('fecha_salida')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_llegada" class="form-label">Fecha de Llegada</label>
            <input type="datetime-local" class="form-control" name="fecha_llegada" value="{{ old('fecha_llegada') }}" >
            @error('fecha_llegada')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" value="{{ old('precio') }}" >
            @error('precio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="disponibilidad_asientos" class="form-label">Disponibilidad de Asientos</label>
            <input type="number" class="form-control" name="disponibilidad_asientos" value="{{ old('disponibilidad_asientos') }}" >
            @error('disponibilidad_asientos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="clase" class="form-label">Clase</label>
            <select class="form-control" name="clase" required>
                <option value="economica" {{ old('clase') == 'economica' ? 'selected' : '' }}>Económica</option>
                <option value="ejecutiva" {{ old('clase') == 'ejecutiva' ? 'selected' : '' }}>Ejecutiva</option>
                <option value="primera" {{ old('clase') == 'primera' ? 'selected' : '' }}>Primera Clase</option>
            </select>
            @error('clase')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="escalas" class="form-label">¿Tiene Escalas?</label>
            <select class="form-control" name="escalas" >
                <option value="0" {{ old('escalas') == '0' ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('escalas') == '1' ? 'selected' : '' }}>Sí</option>
            </select>
            @error('escalas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="politica_cancelacion" class="form-label">Política de Cancelación</label>
            <textarea class="form-control" name="politica_cancelacion" >{{ old('politica_cancelacion') }}</textarea>
            @error('politica_cancelacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear Vuelo</button>
    </form>
</div>
@endsection

