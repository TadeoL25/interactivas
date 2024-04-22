<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function profesores()
    {
        return $this->belongsToMany(Maestro::class, 'alumno_maestro', 'alumno_id', 'maestro_id');
    }

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'alumno_materia', 'alumno_id', 'materia_id');
    }
}
