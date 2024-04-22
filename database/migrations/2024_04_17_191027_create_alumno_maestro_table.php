<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoMaestroTable extends Migration
{
    public function up()
    {
        Schema::create('alumno_maestro', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('maestro_id');
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alumno_maestro');
    }
}

