<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    public function profesores()
    {
        return $this->belongsToMany(Maestro::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class);
    }
}
