<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Panel de Administración</h1>

    <div class="row">
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

    <!-- Agregar más tarjetas según lo necesites -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
