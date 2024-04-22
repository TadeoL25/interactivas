<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Maestro;
use App\Models\Administrativo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Maestro',
            'email' => 'maestro@gmail.com',
            'password' => 'hola',
            'role' => 'maestro',
        ]);

        User::factory()->create([
            'name' => 'Alumno',
            'email' => 'alumno@gmail.com',
            'password' => 'hola',
            'role' => 'alumno',
        ]);

        User::factory()->create([
            'name' => 'Administrativo',
            'email' => 'administrativo@gmail.com',
            'password' => 'hola',
            'role' => 'administrativo',
        ]);

        \App\Models\Alumno::create([
            'nombre' => 'Alumno 1',
            'grupo_id' => '1',
            'profesor' => 'Maestro 1',
        ]);

        \App\Models\Maestro::create([
            'nombre' => 'Maestro 1',
            
            'grupo_id' => '1',
        ]);

        \App\Models\Maestro::create([
            'nombre' => 'Maestro 2',
            
            'grupo_id' => '1',
        ]);

        \App\Models\Materia::create([
            'nombre' => 'Materia 1',
        ]);

        \App\Models\Materia::create([
            'nombre' => 'Materia 2',
        ]);

        \App\Models\Grupo::create([
            'nombre' => 'Grupo 1',
        ]);

        \App\Models\Grupo::create([
            'nombre' => 'Grupo 2',
        ]);
    }
}
