<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesTable extends Migration
{
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('materia_id');
            $table->decimal('calificacion', 5, 2); // Decimal para almacenar la calificación, por ejemplo: 8.50
            $table->timestamps();

            // Claves foráneas
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');

            // Indicar que la combinación de alumno_id y materia_id debe ser única
            $table->unique(['alumno_id', 'materia_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
}

