@extends('layouts.admin')

@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-users"></i> Listado de Usuarios</h1>
        <p class="text-muted">Administra la información de los usuarios registrados.</p>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <table class="table table-hover table-bordered">
                <thead class="bg-danger text-white">
                    <tr>
                        <th><i class="fas fa-user"></i> Nombre</th>
                        <th><i class="fas fa-user"></i> Apellido</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-phone-alt"></i> Teléfono</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td><i class="fas fa-user text-secondary"></i> {{ $usuario->nombre }}</td>
                            <td><i class="fas fa-user text-secondary"></i> {{ $usuario->apellido }}</td>
                            <td><i class="fas fa-envelope text-primary"></i> {{ $usuario->email }}</td>
                            <td><i class="fas fa-phone-alt text-success"></i> {{ $usuario->telefono }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $usuario->id }}">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <form id="delete-form-{{ $usuario->id }}" action="{{ route('admin.usuario.destroy', $usuario->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id'); 
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fas fa-check-circle"></i> Sí, eliminar',
                    cancelButtonText: '<i class="fas fa-ban"></i> Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${userId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
