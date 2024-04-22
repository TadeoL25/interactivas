<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestroMateriaTable extends Migration
{
    public function up()
    {
        Schema::create('maestro_materia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maestro_id');
            $table->unsignedBigInteger('materia_id');
            $table->timestamps();

            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('maestro_materia');
    }
}

