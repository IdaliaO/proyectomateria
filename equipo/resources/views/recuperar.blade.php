@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Recuperar Contraseña</h2>
    <form method="POST" action="{{ route('recuperar') }}">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" >
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar Enlace de Recuperación</button>
    </form>
</div>
@endsection
