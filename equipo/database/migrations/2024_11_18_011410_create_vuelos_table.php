<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuelosTable extends Migration
{
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->id();
            $table->string('aerolinea');
            $table->string('numero_vuelo')->unique();
            $table->string('origen');
            $table->string('destino');
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_llegada');
            $table->decimal('precio', 10, 2);
            $table->integer('disponibilidad'); 
            $table->enum('clase', ['economica', 'ejecutiva', 'primera']);
            $table->boolean('escalas')->default(false);
            $table->text('politica_cancelacion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vuelos');
    }
}
