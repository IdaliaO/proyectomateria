<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionesTable extends Migration
{
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hoteles')->onDelete('cascade');
            $table->string('tipo');
            $table->decimal('precio', 10, 2);
            $table->integer('disponibilidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('habitaciones');
    }
}
