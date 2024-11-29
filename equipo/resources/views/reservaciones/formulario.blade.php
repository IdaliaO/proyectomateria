@extends('layouts.app')
@section('titulo', 'Reservar Hotel')
@section('contenido')
<div class="container my-4">
    <h2 class="mb-4">Reservar: {{ $hotel->nombre }}</h2>
    <form id="reservaForm" method="POST" action="{{ route('reservaciones.confirmar', ['hotel_id' => $hotel->id]) }}">
    @csrf
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Reservar</button>
</form>

    <div id="resultadoDisponibilidad" class="mt-4" style="display: none;">
        <h4>Total de días: <span id="diasTotales"></span></h4>
        <p><strong>Términos y Condiciones:</strong> Lorem ipsum dolor sit amet...</p>
        <div class="form-check">
            <input type="checkbox" id="aceptoTerminos" class="form-check-input">
            <label for="aceptoTerminos" class="form-check-label">Acepto los términos y condiciones</label>
        </div>
        <button class="btn btn-success mt-3" id="continuarBtn" disabled>Continuar con la Reserva</button>
    </div>
</div>

<script>
    document.getElementById('verificarBtn').addEventListener('click', function() {
        const fechaInicio = new Date(document.getElementById('fecha_inicio').value);
        const fechaFin = new Date(document.getElementById('fecha_fin').value);

        if (fechaInicio && fechaFin && fechaFin > fechaInicio) {
            const dias = (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24);
            document.getElementById('diasTotales').innerText = dias;
            document.getElementById('resultadoDisponibilidad').style.display = 'block';
        } else {
            Swal.fire({
                title: 'Fechas inválidas',
                text: 'Asegúrate de seleccionar fechas válidas.',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }
    });

    document.getElementById('aceptoTerminos').addEventListener('change', function() {
        document.getElementById('continuarBtn').disabled = !this.checked;
    });
</script>
@endsection
