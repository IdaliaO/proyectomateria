<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionesTable extends Migration
{
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('hotel_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->date('fecha_inicio'); 
            $table->date('fecha_fin'); 
            $table->integer('total_dias'); 
            $table->timestamps(); 
            $table->foreign('hotel_id')->references('id')->on('hoteles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
}
