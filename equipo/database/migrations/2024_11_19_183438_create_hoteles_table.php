<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelesTable extends Migration
{
    public function up()
    {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacion');
            $table->integer('categoria'); 
            $table->decimal('precio_noche');
            $table->integer('disponibilidad'); 
            $table->text('descripcion')->nullable();
            $table->text('politicas_cancelacion')->nullable();
            $table->string('fotografia')->nullable(); 
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('hoteles');
    }
}
