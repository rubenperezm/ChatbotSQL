<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('log_id')->unique();
          $table->unsignedInteger('conver_id')->nullable();
          $table->foreign('conver_id')->references('id')->on('conversaciones');
          $table->string('textoPregunta');
          $table->json('IntencionSeleccionada');
          $table->double('confianza', 8, 6);
          $table->json('textoRespuesta');
          $table->json('IntencionesCandidatas');
          $table->string('error');
          $table->string('mensajeLog');
          $table->json('jsonLog');
          $table->dateTime('request_timestamp');
          $table->dateTime('response_timestamp');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}
