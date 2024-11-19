<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')
    <h1 class="text-center">Bienvenido al Panel de Administración</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gestionar Usuarios</h5>
                    <p class="card-text">Aquí podrás agregar, editar y eliminar usuarios.</p>
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-primary">Ver Usuarios</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gestionar Vuelos</h5>
                    <p class="card-text">Aquí podrás agregar, editar y eliminar vuelos.</p>
                    <a href="{{ route('admin.vuelos.index') }}" class="btn btn-primary">Ver Vuelos</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gestionar Hoteles</h5>
                    <p class="card-text">Aquí podrás agregar, editar y eliminar hoteles.</p>
                    <a href="{{ route('admin.hoteles.index') }}" class="btn btn-primary">Ver Hoteles</a>
                </div>
            </div>
        </div>
    </div>
@endsection
