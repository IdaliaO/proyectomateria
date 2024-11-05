<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_create_vuelos_table.php
public function up()
{
    Schema::create('vuelos', function (Blueprint $table) {
        $table->id();
        $table->string('origen');
        $table->string('destino');
        $table->date('fecha_salida');
        $table->date('fecha_regreso')->nullable();
        $table->integer('capacidad');
        $table->string('clase');
        $table->string('aerolinea');
        $table->decimal('precio', 8, 2);
        $table->integer('escalas');
        $table->timestamps();
    });
}

    

    public function down()
    {
        Schema::dropIfExists('vuelos');
    }
};
