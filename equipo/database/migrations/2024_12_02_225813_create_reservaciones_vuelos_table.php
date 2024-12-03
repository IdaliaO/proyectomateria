<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservaciones_vuelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('vuelo_id')->constrained('vuelos');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('reservaciones_vuelos');
    }
    
};
