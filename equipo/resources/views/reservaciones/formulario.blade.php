@extends('layouts.app')
@section('titulo', 'Reservar Hotel')
@section('contenido')
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 text-primary"><i class="fas fa-bed"></i> Reserva en {{ $hotel->nombre }}</h1>
        <p class="text-muted">Completa los datos para realizar tu reservación.</p>
    </div>

    <div class="card shadow-lg border-0 p-4" style="border-radius: 15px;">
        <form method="POST" action="{{ route('reservaciones.confirmar', ['hotel_id' => $hotel->id]) }}" id="reservaForm">
            @csrf
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
            </div>
            <div class="mb-3">
                <label for="adultos" class="form-label"><i class="fas fa-user"></i> Número de Adultos</label>
                <input type="number" name="adultos" id="adultos" class="form-control" min="1" placeholder="Ingresa el número de adultos">
            </div>
            <div class="mb-3">
                <label for="ninos" class="form-label"><i class="fas fa-child"></i> Número de Niños</label>
                <input type="number" name="ninos" id="ninos" class="form-control" min="0" placeholder="Ingresa el número de niños">
            </div>

            <div id="resultado" class="alert alert-info mt-4" style="display: none;">
                <h4 class="alert-heading"><i class="fas fa-calculator"></i> Desglose del Costo</h4>
                <p><strong>Cantidad de Habitaciones:</strong> <span id="habitaciones"></span></p>
                <p><strong>Total de Noches:</strong> <span id="noches"></span></p>
                <p><strong>Precio por Noche:</strong> ${{ number_format($hotel->precio_noche, 2) }}</p>
                <p><strong>Costo Total:</strong> $<span id="total"></span></p>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" name="acepto_terminos" id="acepto_terminos">
                <label class="form-check-label" for="acepto_terminos">Acepto los términos y condiciones</label>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-primary btn-lg me-2" id="calcularBtn"><i class="fas fa-calculator"></i> Calcular Costo</button>
                <button type="submit" class="btn btn-success btn-lg" id="reservarBtn" style="display: none;"><i class="fas fa-check-circle"></i> Reservar</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('calcularBtn').addEventListener('click', function () {
        const fechaInicio = new Date(document.getElementById('fecha_inicio').value);
        const fechaFin = new Date(document.getElementById('fecha_fin').value);
        const adultos = parseInt(document.getElementById('adultos').value) || 0;
        const ninos = parseInt(document.getElementById('ninos').value) || 0;
        const precioPorNoche = {{ $hotel->precio_noche }};
        const maxPorHabitacion = 4;

        if (!fechaInicio || !fechaFin || fechaFin <= fechaInicio) {
            Swal.fire({
                icon: 'error',
                title: 'Fechas no válidas',
                text: 'Por favor selecciona un rango de fechas válido.',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
        if (adultos <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Número de adultos requerido',
                text: 'Debe haber al menos un adulto en la reservación.',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        const noches = (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24);
        const totalPersonas = adultos + ninos;
        const habitacionesNecesarias = Math.ceil(totalPersonas / maxPorHabitacion);
        const costoTotal = noches * habitacionesNecesarias * precioPorNoche;

        document.getElementById('habitaciones').textContent = habitacionesNecesarias;
        document.getElementById('noches').textContent = noches;
        document.getElementById('total').textContent = costoTotal.toFixed(2);

        document.getElementById('resultado').style.display = 'block';
        document.getElementById('reservarBtn').style.display = 'inline-block';
    });
</script>
@endsection
