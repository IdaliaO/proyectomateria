@extends('layouts.admin')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-edit"></i> Editar Vuelo</h1>
        <p class="text-muted">Actualiza la información del vuelo seleccionado.</p>
    </div>
    <form id="edit-flight-form" method="POST" action="{{ route('admin.vuelos.update', $vuelo->id) }}" class="shadow-lg p-4 bg-white rounded">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-info-circle"></i> Información del Vuelo</h3>
            <div class="mb-3">
                <label for="aerolinea" class="form-label"><i class="fas fa-building"></i> Aerolínea</label>
                <input type="text" class="form-control" name="aerolinea" value="{{ old('aerolinea', $vuelo->aerolinea) }}" >
                @error('aerolinea')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="numero_vuelo" class="form-label"><i class="fas fa-barcode"></i> Número de Vuelo</label>
                <input type="text" class="form-control" name="numero_vuelo" value="{{ old('numero_vuelo', $vuelo->numero_vuelo) }}" >
                @error('numero_vuelo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-map-marker-alt"></i> Origen y Destino</h3>
            <div class="mb-3">
                <label for="origen" class="form-label"><i class="fas fa-plane-arrival"></i> Origen</label>
                <input type="text" class="form-control" name="origen" value="{{ old('origen', $vuelo->origen) }}" >
                @error('origen')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="destino" class="form-label"><i class="fas fa-plane-departure"></i> Destino</label>
                <input type="text" class="form-control" name="destino" value="{{ old('destino', $vuelo->destino) }}" >
                @error('destino')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-calendar-alt"></i> Fechas del Vuelo</h3>
            <div class="mb-3">
                <label for="fecha_salida" class="form-label"><i class="fas fa-clock"></i> Fecha de Salida</label>
                <input type="datetime-local" class="form-control" name="fecha_salida" value="{{ old('fecha_salida', $vuelo->fecha_salida) }}" >
                @error('fecha_salida')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fecha_llegada" class="form-label"><i class="fas fa-clock"></i> Fecha de Llegada</label>
                <input type="datetime-local" class="form-control" name="fecha_llegada" value="{{ old('fecha_llegada', $vuelo->fecha_llegada) }}" >
                @error('fecha_llegada')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-list-alt"></i> Detalles del Vuelo</h3>
            <div class="mb-3">
                <label for="precio" class="form-label"><i class="fas fa-dollar-sign"></i> Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" value="{{ old('precio', $vuelo->precio) }}" >
                @error('precio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="disponibilidad" class="form-label"><i class="fas fa-users"></i> Disponibilidad de Asientos</label>
                <input type="number" class="form-control" name="disponibilidad" value="{{ old('disponibilidad', $vuelo->disponibilidad) }}" >
                @error('disponibilidad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-suitcase-rolling"></i> Clase y Escalas</h3>
            <div class="mb-3">
                <label for="clase" class="form-label"><i class="fas fa-couch"></i> Clase</label>
                <select class="form-control" name="clase" >
                    <option value="economica" {{ old('clase', $vuelo->clase) == 'economica' ? 'selected' : '' }}>Económica</option>
                    <option value="ejecutiva" {{ old('clase', $vuelo->clase) == 'ejecutiva' ? 'selected' : '' }}>Ejecutiva</option>
                    <option value="primera" {{ old('clase', $vuelo->clase) == 'primera' ? 'selected' : '' }}>Primera Clase</option>
                </select>
                @error('clase')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="escalas" class="form-label"><i class="fas fa-arrows-alt-h"></i> ¿Tiene Escalas?</label>
                <select class="form-control" name="escalas" >
                    <option value="0" {{ old('escalas', $vuelo->escalas) == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('escalas', $vuelo->escalas) == '1' ? 'selected' : '' }}>Sí</option>
                </select>
                @error('escalas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-file-alt"></i> Política de Cancelación</h3>
            <div class="mb-3">
                <label for="politica_cancelacion" class="form-label"><i class="fas fa-ban"></i> Detalles de la Política</label>
                <textarea class="form-control" name="politica_cancelacion" rows="4" >{{ old('politica_cancelacion', $vuelo->politica_cancelacion) }}</textarea>
                @error('politica_cancelacion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="button" id="confirm-edit" class="btn btn-danger btn-lg px-5">
                <i class="fas fa-save"></i> Actualizar Vuelo
            </button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('confirm-edit').addEventListener('click', function () {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas actualizar este vuelo con los datos ingresados?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="fas fa-check-circle"></i> Sí, actualizar',
            cancelButtonText: '<i class="fas fa-ban"></i> Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('edit-flight-form').submit();
            }
        });
    });
</script>
@endsection
