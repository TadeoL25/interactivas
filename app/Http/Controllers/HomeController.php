<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Maestro;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\Calificacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarPDFPorCorreo;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function alumnosInicio()
    {
        $alumnos = Alumno::all();
        $maestros = Maestro::all();
        $grupos = Grupo::all();
        $materias = Materia::all();
        return view('crud.alumnos', ['alumnos' => $alumnos, 'maestros' => $maestros, 'grupos' => $grupos, 'materias' => $materias]);
    }

    public function maestrosInicio()
    {
        $maestros = Maestro::all();
        $materias = Materia::all();
        $grupos = Grupo::all();
        return view('crud.maestros', ['maestros' => $maestros, 'materias' => $materias, 'grupos' => $grupos]);
    }

    public function materiasInicio()
    {
        $materias = Materia::all();
        return view('crud.materias', ['materias' => $materias]);
    }

    public function gruposInicio()
    {
        $grupos = Grupo::all();
        $maestros = Maestro::all();
        $materias = Materia::all();
        $alumnos = Alumno::all();
        return view('crud.grupos', ['grupos' => $grupos, 'maestros' => $maestros, 'materias' => $materias, 'alumnos' => $alumnos]);
    }

    public function calificacionesInicio()
    {
        //dd('Hola');
        // Obtener todos los grupos con sus alumnos y las calificaciones asociadas
        $grupos = Grupo::all();

        // Obtener todos los maestros y materias
        $maestros = Maestro::all();
        $materias = Materia::all();

        // Obtener todos los alumnos para mostrarlos en la vista
        $alumnos = Alumno::all();

        // Pasar los datos a la vista
        return view('crud.calificaciones', ['grupos' => $grupos, 'maestros' => $maestros, 'materias' => $materias, 'alumnos' => $alumnos]);
    }


    public function alumnoNuevo(Request $request)
    {
        $alumno = new Alumno();
        $alumno->nombre = $request->nombre;
        $alumno->grupo_id = $request->grupo; // Asigna el ID del grupo al alumno

        $alumno->save();

        if ($request->has('profesores')) {
            $alumno->profesores()->attach($request->profesores);
        }

        // Asocia las materias seleccionadas al alumno
        if ($request->has('materias')) {
            $alumno->materias()->attach($request->materias);
        }

        return redirect()->route('alumnos.inicio');
    }

    public function alumnoEliminar($id)
    {
        $alumno = Alumno::find($id);
        $alumno->delete();
        return redirect()->route('alumnos.inicio');
    }


    public function maestroNuevo(Request $request)
    {
        //dd($request->all());
        $maestro = new Maestro();
        $maestro->nombre = $request->nombre;

        $maestro->save();

        // Asociar el maestro con los grupos seleccionados
        if ($request->has('grupos')) {
            $gruposSeleccionados = $request->grupos;
            $maestro->grupos()->attach($gruposSeleccionados);
        }

        // También puedes asociar el maestro con las materias seleccionadas de manera similar
        if ($request->has('materias')) {
            $materiasSeleccionadas = $request->materias;
            $maestro->materias()->attach($materiasSeleccionadas);
        }

        return redirect()->route('maestros.inicio');
    }


    public function maestroEliminar($id)
    {
        $maestro = Maestro::find($id);
        $maestro->delete();
        return redirect()->route('maestros.inicio');
    }

    public function materiaNueva(Request $request)
    {
        $materia = new Materia();
        $materia->nombre = $request->nombre;
        $materia->save();
        return redirect()->route('materias.inicio');
    }

    public function materiaEliminar($id)
    {
        $materia = Materia::find($id);
        $materia->delete();
        return redirect()->route('materias.inicio');
    }

    public function grupoNuevo(Request $request)
    {
        // Crea una nueva instancia del modelo Grupo
        $grupo = new Grupo();

        // Asigna el nombre del grupo desde la solicitud
        $grupo->nombre = $request->nombre;

        // Asigna el maestro al grupo si se ha seleccionado uno
        if ($request->has('profesor')) {
            $grupo->maestro_id = $request->profesor;
            $grupo->profesor = Maestro::find($request->profesor)->nombre;
        }

        // Guarda el grupo en la base de datos
        $grupo->save();

        // Asocia el grupo con las materias seleccionadas
        if ($request->has('materias')) {
            $grupo->materias()->attach($request->materias);
        }

        // Asocia el grupo con los alumnos seleccionados
        if ($request->has('alumnos')) {
            $grupo->alumnos()->attach($request->alumnos);
        }

        // Redirecciona al usuario a la ruta de inicio de los grupos
        return redirect()->route('grupos.inicio');
    }



    public function grupoEliminar($id)
    {
        $grupo = Grupo::find($id);
        $grupo->delete();
        return redirect()->route('grupos.inicio');
    }

    public function calificacionNueva(Request $request)
    {
        $calificacion = new Calificacion();
        $calificacion->alumno_id = $request->alumno_id;
        $calificacion->materia_id = $request->materia_id;
        $calificacion->calificacion = $request->calificacion;
        $calificacion->save();

        return redirect()->back()->with('success', 'Calificación agregada exitosamente.');
    }

    public function generarYEnviarPDF(Request $request)
    {
        // Generar el PDF
        $pdf = new Dompdf();
        $pdf->loadHtml('<div class="container">
    <h1>Calificaciones</h1>

    @foreach ($grupos as $grupo)
    <div class="card my-4">
        <div class="card-header bg-primary text-white">
            <h5>Grupo: {{ $grupo->nombre }}</h5>
        </div>
        <div class="card-body">
            <h6>Alumnos:</h6>
            <ul>
                @foreach ($grupo->alumnos as $alumno)
                    <li>{{ $alumno->nombre }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>'); // Aquí cargas el contenido HTML del PDF
        $pdf->setPaper('A4');
        $pdf->render();
        $contenidoPDF = $pdf->output();

        // Envía el PDF por correo electrónico
        Mail::to('tadeolozanog2@gmail.com')->send(new EnviarPDFPorCorreo($contenidoPDF));

        // Redirige a donde quieras después de enviar el correo
        return redirect()->back()->with('success', 'PDF enviado por correo electrónico.');
    }

    
}
