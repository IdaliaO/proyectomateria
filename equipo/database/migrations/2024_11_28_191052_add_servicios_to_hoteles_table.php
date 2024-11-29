<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiciosToHotelesTable extends Migration
{
    public function up()
    {
        Schema::table('hoteles', function (Blueprint $table) {
            $table->text('servicios')->nullable()->after('fotografia'); // Agregar columna servicios
        });
    }

    public function down()
    {
        Schema::table('hoteles', function (Blueprint $table) {
            $table->dropColumn('servicios');
        });
    }
}
