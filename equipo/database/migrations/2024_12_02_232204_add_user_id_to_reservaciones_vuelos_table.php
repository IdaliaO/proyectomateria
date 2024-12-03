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
        Schema::table('reservaciones_vuelos', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->after('vuelo_id');
        });
    }
    

public function down()
{
    Schema::table('reservaciones_vuelos', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}

};
