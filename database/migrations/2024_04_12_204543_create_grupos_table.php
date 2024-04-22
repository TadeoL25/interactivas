<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('profesor')->nullable();
            // Agrega la columna para la clave foránea del profesor
            $table->unsignedBigInteger('maestro_id')->nullable();
            $table->timestamps();

            // Define la restricción de clave foránea
            $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
