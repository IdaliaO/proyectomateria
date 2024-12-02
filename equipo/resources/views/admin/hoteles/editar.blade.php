@extends('layouts.admin')
@section('titulo', 'Editar Hotel')
@section('contenido')
<div class="container my-5">

    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-edit"></i> Editar Hotel</h1>
        <p class="text-muted">Actualiza la información de este hotel con los detalles necesarios.</p>
    </div>
    <form id="editar-hotel-form" method="POST" action="{{ route('admin.hotel.update', $hotel->id) }}" enctype="multipart/form-data" class="shadow-lg p-4 bg-white rounded">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-info-circle"></i> Información Básica</h3>
            <div class="mb-3">
                <label for="nombre" class="form-label"><i class="fas fa-hotel"></i> Nombre del Hotel</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $hotel->nombre) }}" >
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label"><i class="fas fa-map-marker-alt"></i> Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $hotel->ubicacion) }}" >
                @error('ubicacion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-list-alt"></i> Detalles del Hotel</h3>
            <div class="mb-3">
                <label for="categoria" class="form-label"><i class="fas fa-star"></i> Categoría (Estrellas)</label>
                <input type="number" name="categoria" class="form-control" value="{{ old('categoria', $hotel->categoria) }}" min="1" max="5" >
                @error('categoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="precio_noche" class="form-label"><i class="fas fa-dollar-sign"></i> Precio por Noche</label>
                <input type="number" name="precio_noche" class="form-control" value="{{ old('precio_noche', $hotel->precio_noche) }}" step="0.01" >
                @error('precio_noche')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="distancia_centro" class="form-label"><i class="fas fa-map-marker-alt"></i> Distancia al centro (km)</label>
                <input type="number" name="distancia_centro" class="form-control" value="{{ old('distancia_centro', $hotel->distancia_centro) }}" min="1" >
                @error('distancia_centro')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="disponibilidad" class="form-label"><i class="fas fa-check-circle"></i> Disponibilidad de Habitaciones</label>
                <input type="number" name="disponibilidad" class="form-control" value="{{ old('disponibilidad', $hotel->disponibilidad) }}" min="1" >
                @error('disponibilidad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-concierge-bell"></i> Servicios</h3>
            <div class="form-check">
                @foreach($servicios as $servicio)
                    <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}" class="form-check-input" id="servicio_{{ $servicio->id }}"
                    {{ in_array($servicio->id, old('servicios', $hotelServicios)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="servicio_{{ $servicio->id }}"><i class="fas fa-check text-success"></i> {{ $servicio->nombre }}</label><br>
                @endforeach
            </div>
            @error('servicios')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-file-alt"></i> Descripción y Políticas</h3>
            <div class="mb-3">
                <label for="descripcion" class="form-label"><i class="fas fa-info-circle"></i> Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4" >{{ old('descripcion', $hotel->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="politicas_cancelacion" class="form-label"><i class="fas fa-ban"></i> Políticas de Cancelación</label>
                <textarea name="politicas_cancelacion" class="form-control" rows="4" >{{ old('politicas_cancelacion', $hotel->politicas_cancelacion) }}</textarea>
                @error('politicas_cancelacion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-primary"><i class="fas fa-camera"></i> Fotografía</h3>
            <div class="mb-3">
                <label for="fotografia" class="form-label"><i class="fas fa-image"></i> Fotografía del Hotel</label>
                <input type="file" name="fotografia" class="form-control" accept="image/*">
                @if($hotel->fotografia)
                    <div class="mt-3">
                        <p>Fotografía actual:</p>
                        <img src="{{ asset($hotel->fotografia) }}" alt="Fotografía del hotel" style="max-width: 200px; border-radius: 10px;">
                    </div>
                @endif
                @error('fotografia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="button" id="btn-actualizar-hotel" class="btn btn-danger btn-lg px-5">
                <i class="fas fa-save"></i> Actualizar Hotel
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#btn-actualizar-hotel').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#editar-hotel-form')[0]);
        $.ajax({
            url: $('#editar-hotel-form').attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Hotel actualizado correctamente.',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = "{{ route('admin.hoteles.index') }}";
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el hotel. Por favor, inténtelo de nuevo.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
</script>
@endsection

