<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUsuarioIdFromReservacionesTable extends Migration
{
    public function up()
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']); // Elimina la clave foránea
            $table->dropColumn('usuario_id');    // Luego elimina la columna
        });
    }

    public function down()
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id')->nullable();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
