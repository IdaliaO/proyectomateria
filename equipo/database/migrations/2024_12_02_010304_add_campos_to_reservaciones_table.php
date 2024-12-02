<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToReservacionesTable extends Migration
{
    public function up()
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->integer('adultos')->after('fecha_fin'); 
            $table->integer('ninos')->after('adultos');
            $table->decimal('costo_total', 10, 2)->after('ninos');
        });
    }

    public function down()
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->dropColumn(['adultos', 'ninos', 'costo_total']);
        });
    }
}
