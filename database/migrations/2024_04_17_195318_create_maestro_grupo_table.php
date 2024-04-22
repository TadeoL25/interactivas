<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestroGrupoTable extends Migration
{
    public function up()
    {
        Schema::create('maestro_grupo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maestro_id');
            $table->unsignedBigInteger('grupo_id');
            $table->timestamps();

            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('maestro_grupo');
    }
}

