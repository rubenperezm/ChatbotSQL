<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDificultadToEjercicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejercicio', function (Blueprint $table) {
          $table->tinyInteger('dificultad')->default(1)->comment('1 - principiante / 2 - media / 3 - alta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ejercicio', function (Blueprint $table) {
          $table->dropColumn('dificultad');
        });
    }
}
