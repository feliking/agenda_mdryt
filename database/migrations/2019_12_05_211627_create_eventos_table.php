<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('actividad');
            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')->references('id')->on('institucions');
            $table->integer('lugar_id')->unsigned();
            $table->foreign('lugar_id')->references('id')->on('lugars');
            $table->integer('sector_id')->unsigned();
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('referencia_apoyo');
            $table->string('avanzada');
            $table->integer('delegado_id')->unsigned();
            $table->foreign('delegado_id')->references('id')->on('delegados');
            $table->string('observaciones')->nullable();
            $table->timestamp('fecha_hora');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
