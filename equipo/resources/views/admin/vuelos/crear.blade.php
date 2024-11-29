@extends('layouts.admin')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-plane-departure"></i> Crear Nuevo Vuelo</h1>
        <p class="text-muted">Registra un nuevo vuelo proporcionando la información necesaria.</p>
    </div>

    <form id="crear-vuelo-form" method="POST" action="{{ route('admin.vuelos.store') }}" class="shadow-lg p-4 bg-white rounded">
        @csrf
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-info-circle"></i> Información del Vuelo</h3>
            <div class="mb-3">
                <label for="aerolinea" class="form-label"><i class="fas fa-plane"></i> Aerolínea</label>
                <input type="text" class="form-control" name="aerolinea" value="{{ old('aerolinea') }}" >
                @error('aerolinea')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="numero_vuelo" class="form-label"><i class="fas fa-barcode"></i> Número de Vuelo</label>
                <input type="text" class="form-control" name="numero_vuelo" value="{{ old('numero_vuelo') }}" >
                @error('numero_vuelo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-map-marker-alt"></i> Origen y Destino</h3>
            <div class="mb-3">
                <label for="origen" class="form-label"><i class="fas fa-plane-arrival"></i> Origen</label>
                <input type="text" class="form-control" name="origen" value="{{ old('origen') }}" >
                @error('origen')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="destino" class="form-label"><i class="fas fa-plane-departure"></i> Destino</label>
                <input type="text" class="form-control" name="destino" value="{{ old('destino') }}" >
                @error('destino')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-calendar-alt"></i> Fechas del Vuelo</h3>
            <div class="mb-3">
                <label for="fecha_salida" class="form-label"><i class="fas fa-clock"></i> Fecha de Salida</label>
                <input type="datetime-local" class="form-control" name="fecha_salida" value="{{ old('fecha_salida') }}" >
                @error('fecha_salida')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fecha_llegada" class="form-label"><i class="fas fa-clock"></i> Fecha de Llegada</label>
                <input type="datetime-local" class="form-control" name="fecha_llegada" value="{{ old('fecha_llegada') }}" >
                @error('fecha_llegada')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-list-alt"></i> Detalles del Vuelo</h3>
            <div class="mb-3">
                <label for="precio" class="form-label"><i class="fas fa-dollar-sign"></i> Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" value="{{ old('precio') }}" >
                @error('precio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="disponibilidad" class="form-label"><i class="fas fa-users"></i> Disponibilidad de Asientos</label>
                <input type="number" class="form-control" name="disponibilidad" value="{{ old('disponibilidad') }}" min="1">
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
                    <option value="economica" {{ old('clase') == 'economica' ? 'selected' : '' }}>Económica</option>
                    <option value="ejecutiva" {{ old('clase') == 'ejecutiva' ? 'selected' : '' }}>Ejecutiva</option>
                    <option value="primera" {{ old('clase') == 'primera' ? 'selected' : '' }}>Primera Clase</option>
                </select>
                @error('clase')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="escalas" class="form-label"><i class="fas fa-arrows-alt-h"></i> ¿Tiene Escalas?</label>
                <select class="form-control" name="escalas" >
                    <option value="0" {{ old('escalas') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('escalas') == '1' ? 'selected' : '' }}>Sí</option>
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
                <textarea class="form-control" name="politica_cancelacion" rows="4">{{ old('politica_cancelacion') }}</textarea>
                @error('politica_cancelacion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="button" id="btn-crear-vuelo" class="btn btn-danger btn-lg px-5">
                <i class="fas fa-save"></i> Crear Vuelo
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#btn-crear-vuelo').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#crear-vuelo-form')[0]);
        $.ajax({
            url: $('#crear-vuelo-form').attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Vuelo creado correctamente.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    // Redireccionar al índice de vuelos después del éxito
                    window.location.href = "{{ route('admin.vuelos.index') }}";
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al crear el vuelo. Por favor, inténtelo de nuevo.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
</script>
@endsection

