@extends('layouts.layout')

@section('title', 'Calificaciones')

@section('content')
<div class="container">
    <h1>Calificaciones</h1>
    <h2>¡Hola {{ Auth::user()->name }}!</h2>

    @foreach ($grupos as $grupo)
    <div class="card my-4">
        <div class="card-header bg-primary text-white">
            <h5>Grupo: {{ $grupo->nombre }}</h5>
        </div>
        <div class="card-body">
            <h6>Alumnos:</h6>
            <ul>
                @foreach ($alumnos as $alumno)
                <tr>
                    @if ($alumno->grupo_id == $grupo->id)
                    <li>{{ $alumno->nombre }}</li>
                    @endif
                </tr>
            @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>

<div class="container mt-4">
    <a href="{{ route('generar.pdf') }}" class="btn btn-primary mr-2">Generar PDF</a>
</div>
@endsection
