@extends('layouts.app')
@section('titulo', 'Detalles del Hotel')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-hotel"></i> {{ $hotel->nombre }}</h1>
        <p class="text-muted">Explora todos los detalles y reserva tu habitación ahora.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div style="
                    background-image: url('{{ $hotel->fotografia ? asset($hotel->fotografia) : asset('images/default-hotel.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    height: 350px;
                    border-top-left-radius: 15px;
                    border-top-right-radius: 15px;">
                </div>
                <div class="card-body">
                    <h4 class="text-primary"><i class="fas fa-map-marker-alt"></i> Ubicación</h4>
                    <p>{{ $hotel->ubicacion }}</p>

                    <h4 class="text-primary"><i class="fas fa-star"></i> Categoría</h4>
                    <p>{{ $hotel->categoria }} estrellas</p>

                    <h4 class="text-primary"><i class="fas fa-dollar-sign"></i> Precio por Noche</h4>
                    <p>${{ number_format($hotel->precio_noche, 2) }}</p>

                    <h4 class="text-primary"><i class="fas fa-bed"></i> Disponibilidad</h4>
                    <p>{{ $hotel->disponibilidad }} habitaciones</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0 p-4" style="border-radius: 15px;">
                <h4 class="text-primary"><i class="fas fa-info-circle"></i> Descripción</h4>
                <p>{{ $hotel->descripcion }}</p>

                <h4 class="text-primary"><i class="fas fa-concierge-bell"></i> Servicios</h4>
                <ul>
                    @foreach($servicios as $servicio)
                        <li><i class="fas fa-check text-success"></i> {{ $servicio->nombre }}</li>
                    @endforeach
                </ul>

                <h4 class="text-primary"><i class="fas fa-file-alt"></i> Políticas de Cancelación</h4>
                <p>{{ $hotel->politicas_cancelacion }}</p>

                <div class="text-center mt-4">
                    <button class="btn btn-success btn-lg" id="reservarBtn"><i class="fas fa-check-circle"></i> Reservar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4 class="text-primary"><i class="fas fa-comments"></i> Comentarios de Usuarios</h4>
        @if($comentarios->isEmpty())
            <p class="text-muted">No hay comentarios aún. Sé el primero en comentar.</p>
        @else
            @foreach($comentarios as $comentario)
                <div class="card mb-3 shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user"></i> {{ $comentario->nombre }}</h5>
                        <p class="card-text"><strong>Calificación:</strong> {{ $comentario->calificacion }} estrellas</p>
                        <p>{{ $comentario->comentario }}</p>
                        <p class="text-muted"><small>Publicado el {{ date('d/m/Y', strtotime($comentario->created_at)) }}</small></p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="mt-5">
        <h4 class="text-primary"><i class="fas fa-pencil-alt"></i> Deja tu Comentario</h4>
        <form method="POST" action="{{ route('comentarios.guardar') }}" class="card p-4 shadow border-0" style="border-radius: 15px;">
            @csrf
            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

            <div class="mb-3">
                <label for="calificacion" class="form-label"><i class="fas fa-star"></i> Calificación (1-5)</label>
                <select class="form-select" name="calificacion" id="calificacion" required>
                    <option value="">Seleccione una calificación</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Estrella{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="comentario" class="form-label"><i class="fas fa-comment-dots"></i> Comentario</label>
                <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Enviar Comentario</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('reservarBtn').addEventListener('click', function() {
        @if(Auth::check())
            window.location.href = "{{ route('reservacion.pasos', ['id' => $hotel->id]) }}";
        @else
            Swal.fire({
                title: 'Inicia Sesión',
                text: 'Debes iniciar sesión para reservar.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            });
        @endif
    });
</script>
@endsection
