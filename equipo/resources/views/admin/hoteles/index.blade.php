@extends('layouts.admin')

@section('titulo', 'Hoteles')

@section('contenido')
<div class="container my-4">
    <div class="jumbotron text-center text-white py-5" style="background: linear-gradient(135deg, #C84646, #E57B7B); border-radius: 15px; box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);">
        <h1 class="display-4 font-weight-bold"><i class="fas fa-plane-departure"></i> ¡Explora Nuestros Hoteles!</h1>
        <p class="lead">Gestiona destinos únicos con un diseño moderno y profesional.</p>
        <a href="{{ route('admin.hotel.crear') }}" class="btn btn-light btn-lg px-4 shadow-sm">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Hotel
        </a>
    </div>
    <div class="my-5">
        <h3 class="text-primary"><i class="fas fa-star"></i> Hotel Destacado</h3>
        <div class="card shadow border-0" style="border-radius: 12px; overflow: hidden; background-color: #FAFAFA;">
            <div class="row g-0">
                <div class="col-md-4" style="background-image: url('{{ asset('images/10304133.jpg') }}'); background-size: cover; background-position: center;"></div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-danger font-weight-bold"><i class="fas fa-bed"></i> Hotel Cardinal Luxury</h5>
                        <p class="card-text text-muted"><i class="fas fa-info-circle"></i> Un lugar ideal para relajarse con vistas espectaculares y servicios de lujo.</p>
                        <p><i class="fas fa-map-marker-alt text-primary"></i> <strong>Ubicación:</strong> Punta Cana, República Dominicana</p>
                        <a href="#" class="btn btn-primary text-white">
                            <i class="fas fa-info-circle"></i> Más Información
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow my-4" style="border-radius: 15px;">
        <div class="card-header bg-danger text-white text-center" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <h4 class="mb-0"><i class="fas fa-list-alt"></i> Lista Completa de Hoteles</h4>
        </div>
        <div class="card-body bg-white">
            <table class="table table-hover table-striped">
                <thead style="background-color: #C84646; color: white;">
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-hotel"></i> Nombre</th>
                        <th><i class="fas fa-map-marker-alt"></i> Ubicación</th>
                        <th><i class="fas fa-star"></i> Categoría</th>
                        <th><i class="fas fa-dollar-sign"></i> Precio por Noche</th>
                        <th><i class="fas fa-check-circle"></i> Disponibilidad</th>
                        <th><i class="fas fa-tools"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hoteles as $hotel)
                        <tr>
                            <td class="text-center">{{ $hotel->id }}</td>
                            <td class="font-weight-bold"><i class="fas fa-bed text-muted"></i> {{ $hotel->nombre }}</td>
                            <td><i class="fas fa-map-marker-alt text-primary"></i> {{ $hotel->ubicacion }}</td>
                            <td class="text-center">
                                <span class="badge" style="background-color: #E57B7B; color: white;">
                                    <i class="fas fa-star"></i> {{ $hotel->categoria }} estrellas
                                </span>
                            </td>
                            <td><i class="fas fa-dollar-sign text-success"></i> ${{ number_format($hotel->precio_noche, 2) }}</td>
                            <td>
                                @if($hotel->disponibilidad === 'Disponible')
                                    <span class="badge bg-success text-white">
                                        <i class="fas fa-check-circle"></i> {{ $hotel->disponibilidad }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white">
                                        <i class="fas fa-times-circle"></i> {{ $hotel->disponibilidad }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.hotel.detalles', $hotel->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-info-circle"></i> Detalles
                                </a>
                                <a href="{{ route('admin.hotel.editar', $hotel->id) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este hotel?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
