@extends('layouts.layout')

@section('title', 'Alumnos')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Lista de Materias</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $materia)
                            <tr>
                                <td>{{ $materia->nombre }}</td>
                                <td>
                                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                                    <button class="btn btn-danger" onclick="eliminar({{ $materia->id }})">Eliminar</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarAlumno">Agregar materia</button>
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
                    <h5 class="modal-title">Agregar nueva materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
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
