<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('destino');
            $table->integer('numero_estrellas');
            $table->decimal('precio_por_noche', 8, 2);
            $table->integer('capacidad'); // Número máximo de huéspedes
            $table->decimal('distancia_centro', 8, 2)->nullable(); // En kilómetros
            $table->json('servicios')->nullable(); // Almacenar servicios como JSON
            $table->decimal('calificacion', 2, 1)->nullable(); // Calificación promedio de usuarios
            $table->text('descripcion')->nullable();
            $table->text('politicas_cancelacion')->nullable();
            $table->date('fecha_disponible_desde')->nullable();
            $table->date('fecha_disponible_hasta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
