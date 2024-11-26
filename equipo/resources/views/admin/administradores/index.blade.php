@extends('layouts.admin')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-danger"><i class="fas fa-user-shield"></i> Lista de Administradores</h1>
        <p class="text-muted">Administra la información de los administradores registrados en el sistema.</p>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <table class="table table-hover table-bordered">
                <thead class="bg-danger text-white">
                    <tr>
                        <th><i class="fas fa-id-card"></i> ID</th>
                        <th><i class="fas fa-user"></i> Nombre</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($administradores as $admin)
                        <tr>
                            <td><i class="fas fa-id-card text-secondary"></i> {{ $admin->id }}</td>
                            <td><i class="fas fa-user text-secondary"></i> {{ $admin->nombre }}</td>
                            <td><i class="fas fa-envelope text-primary"></i> {{ $admin->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $admin->id }}">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.administradores.destroy', $admin->id) }}" method="POST" style="display:none;">
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
                const adminId = this.getAttribute('data-id'); 
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
                        document.getElementById(`delete-form-${adminId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
