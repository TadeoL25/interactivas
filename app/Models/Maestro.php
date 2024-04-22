<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_maestro', 'maestro_id', 'alumno_id');
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'maestro_grupo', 'maestro_id', 'grupo_id');
    }


    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'maestro_materia', 'maestro_id', 'materia_id');
    }

    
}
