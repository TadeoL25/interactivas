@extends('layouts.layout')

@section('title', 'Maestros')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Lista de Maestros</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Grupos</th>
                                <th>Materias</th>
                                @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maestros as $maestro)
                            <tr>
                                <td>{{ $maestro->nombre }}</td>
                                <td>
                                    @foreach ($maestro->grupos as $grupo)
                                        {{ $grupo->nombre }}
                                        @if (!$loop->last)
                                            , <!-- Agregar una coma entre los nombres, excepto en el último -->
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($maestro->materias as $materia)
                                    {{ $materia->nombre }}
                                    @if (!$loop->last)
                                    ,
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                    <button class="btn btn-danger" onclick="eliminar({{ $maestro->id }})">Eliminar</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarMaestro">Agregar
                        maestro</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Maestro -->
    <div class="modal fade" id="modalAgregarMaestro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Agregar nuevo maestro</h5>
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
                            <label for="grupos" class="form-label">Grupos</label><br>
                            @foreach ($grupos as $grupo)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="grupo_{{ $grupo->id }}" name="grupos[]" value="{{ $grupo->id }}">
                                <label class="form-check-label" for="grupo_{{ $grupo->id }}">{{ $grupo->nombre }}</label>
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
        url = "{{ route('maestro.eliminar', ':id') }}";
        url = url.replace(':id', id);

        window.location.href = url;
    }
</script>
@endsection