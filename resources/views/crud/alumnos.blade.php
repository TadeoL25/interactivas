@extends('layouts.layout')

@section('title', 'Alumnos')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Lista de alumnos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Grupo</th>
                                <th>Profesores</th>
                                <th>Materias</th>
                                @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->nombre }}</td>
                                <td>{{ $alumno->grupo->nombre }}</td>
                                <td>
                                    @foreach($alumno->profesores as $profesor)
                                    {{ $profesor->nombre }}
                                    @if(!$loop->last)
                                    ,
                                    <!-- Agregar una coma entre los nombres, excepto en el último -->
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($alumno->materias as $materia)
                                    {{ $materia->nombre }}
                                    @if(!$loop->last)
                                    ,
                                    <!-- Agregar una coma entre los nombres, excepto en el último -->
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{-- {{dd(Auth::user())}} --}}
                                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                    <button class="btn btn-danger"
                                        onclick="eliminar({{ $alumno->id }})">Eliminar</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarAlumno">Agregar
                        alumno</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Alumno -->
    <div class="modal fade" id="modalAgregarAlumno" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Agregar nuevo alumno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="grupo" class="form-label">Grupo</label>
                            <select class="form-select" id="grupo" name="grupo" required>
                                @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="profesores" class="form-label">Profesores</label><br>
                            @foreach($maestros as $maestro)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="profesor_{{ $maestro->id }}"
                                    name="profesores[]" value="{{ $maestro->id }}">
                                <label class="form-check-label" for="profesor_{{ $maestro->id }}">{{ $maestro->nombre
                                    }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="materias" class="form-label">Materias</label><br>
                            @foreach ($materias as $materia)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="materia_{{ $materia->id }}"
                                    name="materias[]" value="{{ $materia->id }}">
                                <label class="form-check-label" for="materia_{{ $materia->id }}">{{ $materia->nombre
                                    }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function eliminar(id) {
        url = "{{ route('alumno.eliminar', ':id') }}";
        url = url.replace(':id', id);

        window.location.href = url;
    }
</script>
@endsection