@extends('layouts.layout')

@section('title', 'Grupos')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Lista de Grupos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Profesor</th>
                                @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupos as $grupo)
                            <tr>
                                <td>{{ $grupo->nombre }}</td>
                                <td>
                                    @if($grupo->profesor)
                                    {{ $grupo->profesor }}
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                    <button class="btn btn-danger"
                                        onclick="eliminar({{ $grupo->id }})">Eliminar</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarGrupo">Agregar
                        grupo</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Grupo -->
    <div class="modal fade" id="modalAgregarGrupo" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Agregar nuevo grupo</h5>
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
                            <label for="profesores" class="form-label">Profesor</label><br>
                            @foreach($maestros as $maestro)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="profesor_{{ $maestro->id }}"
                                    name="profesor" value="{{ $maestro->id }}">
                                <label class="form-check-label" for="profesor_{{ $maestro->id }}">{{ $maestro->nombre
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
        url = "{{ route('grupo.eliminar', ':id') }}";
        url = url.replace(':id', id);

        window.location.href = url;
    }
</script>
@endsection