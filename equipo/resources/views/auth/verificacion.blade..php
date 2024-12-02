@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica tu Correo Electrónico</div>

                <div class="card-body">
                    <h2>¡Casi terminamos!</h2>
                    <p>Hemos enviado un correo de verificación a <strong>{{ $email }}</strong></p>

                    <div class="alert alert-info">
                        <p>Por favor revisa tu bandeja de entrada y haz clic en el enlace de verificación.</p>
                        <p>Si no encuentras el correo, revisa tu carpeta de spam.</p>
                    </div>

                    <div class="text-center mt-4">
                        <p>¿No has recibido el correo?</p>
                        <form action="{{ route('reenviar.verificacion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <button type="submit" class="btn btn-primary">
                                Reenviar correo de verificación
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection