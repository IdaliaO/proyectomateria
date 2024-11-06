<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaDisponibleToHotelsTable extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->date('fecha_disponible_desde')->nullable();
            $table->date('fecha_disponible_hasta')->nullable();
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['fecha_disponible_desde', 'fecha_disponible_hasta']);
        });
    }
}
