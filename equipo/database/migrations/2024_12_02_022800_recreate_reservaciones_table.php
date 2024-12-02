<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateReservacionesTable extends Migration
{
    public function up()
    {
        Schema::create('reservaciones_temp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('user_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('total_dias');
            $table->integer('adultos');
            $table->integer('ninos');
            $table->decimal('costo_total', 10, 2);
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hoteles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Copia los datos a la nueva tabla
        DB::statement('INSERT INTO reservaciones_temp (id, hotel_id, user_id, fecha_inicio, fecha_fin, total_dias, adultos, ninos, costo_total, created_at, updated_at)
                       SELECT id, hotel_id, user_id, fecha_inicio, fecha_fin, total_dias, adultos, ninos, costo_total, created_at, updated_at
                       FROM reservaciones');

        // Elimina la tabla original
        Schema::dropIfExists('reservaciones');

        // Renombra la tabla temporal
        Schema::rename('reservaciones_temp', 'reservaciones');
    }

    public function down()
    {
        // Código para revertir el cambio
    }
}
