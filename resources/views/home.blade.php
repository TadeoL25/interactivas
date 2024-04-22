<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- Barra de navegación -->
    @include('layouts.navbar')

    <!-- Contenido principal -->
    @if(Auth::user()->role == 'maestro' || Auth::user()->role == 'administrativo')
    <div class="container">
        <h1 class="mt-5">¡Bienvenido, {{ Auth::user()->name }}!</h1>
        <p class="lead">Este es un sistema de gestión educativa que te permite administrar grupos, alumnos, maestros,
            materias y calificaciones de manera eficiente y organizada.</p>
        <p>Con esta plataforma, puedes realizar tareas como:</p>
        <ul>
            <li>Crear y gestionar grupos de estudiantes.</li>
            <li>Agregar y eliminar alumnos de los grupos.</li>
            <li>Asignar maestros a los grupos y materias.</li>
            <li>Registrar y visualizar calificaciones de los alumnos.</li>
            <li>Generar informes y exportar datos en formatos como PDF.</li>
            <li>Enviar notificaciones y comunicaciones a través del correo electrónico.</li>
        </ul>
        <p>¡Explora todas las funcionalidades y disfruta de una experiencia de gestión educativa simplificada!</p>
    </div>
    @else
    <div class="container">
        <h1 class="mt-5">¡Bienvenido, {{ Auth::user()->name }}!</h1>
        <p class="lead">Este es un sistema de gestión educativa que te permite visualizar tus calificaciones y
            comunicarte con tus profesores de manera eficiente y organizada.</p>
        <p>Con esta plataforma, puedes realizar tareas como:</p>
        <ul>
            <li>Consultar tus calificaciones y desempeño académico.</li>
            <li>Consultar profesores</li>
            <li>Consultar materias</li>
            <li>Generar el pdf de tus materias, profesores y calificaciones</li>
        </ul>
        @endif
</body>

</html>
