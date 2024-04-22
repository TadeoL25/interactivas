<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Alumno;
use App\Models\Profesor;

class PDFController extends Controller
{
    public function generarPDF()
    {
        $alumnos = Alumno::with('profesores')->get();

        // Extraer los profesores de los alumnos
        $profesores = $alumnos->flatMap->profesores->unique('id');

        $pdf = PDF::loadView('generar-pdf', compact('alumnos', 'profesores'));

        return $pdf->download('alumnos.pdf');
    }
}
