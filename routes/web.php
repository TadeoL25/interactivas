<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Mail\EnviarPDFPorCorreo;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/alumno', [HomeController::class, 'alumnosInicio'])->name('alumnos.inicio');
    Route::get('/maestro', [HomeController::class, 'maestrosInicio'])->name('maestros.inicio');
    Route::get('/materia', [HomeController::class, 'materiasInicio'])->name('materias.inicio');
    Route::get('/grupo', [HomeController::class, 'gruposInicio'])->name('grupos.inicio');
    Route::get('/calificacion', [HomeController::class, 'calificacionesInicio'])->name('calificaciones.inicio');

    //Alumno
    Route::post('/alumno', [HomeController::class, 'alumnoNuevo'])->name('alumno.nuevo');
    Route::get('/alumno/{id}', [HomeController::class, 'alumnoEliminar'])->name('alumno.eliminar');
    
    //Maestro
    Route::post('/maestro', [HomeController::class, 'maestroNuevo'])->name('maestro.nuevo');
    Route::get('/maestro/{id}', [HomeController::class, 'maestroEliminar'])->name('maestro.eliminar');

    //Materia
    Route::post('/materia', [HomeController::class, 'materiaNueva'])->name('materia.nuevo');
    Route::get('/materia/{id}', [HomeController::class, 'materiaEliminar'])->name('materia.eliminar');

    //Grupo
    Route::post('/grupo', [HomeController::class, 'grupoNuevo'])->name('grupo.nuevo');
    Route::get('/grupo/{id}', [HomeController::class, 'grupoEliminar'])->name('grupo.eliminar');

    //Calificacion
    Route::post('/calificacion', [HomeController::class, 'calificacionNueva'])->name('calificacion.nuevo');

    Route::get('/generar-pdf', [PDFController::class, 'generarPDF'])->name('generar.pdf');
    Route::post('/enviar-correo', [HomeController::class, 'enviarCorreo'])->name('enviar.correo');

    Route::get('/calificacionesEnviar', function(){
        Mail::to('tadeolozanog2@gmail.com')->send(new EnviarPDFPorCorreo());

        return 'Mensaje enviado';
    })->name('calificaciones.enviar');
});
