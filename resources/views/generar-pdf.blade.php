<!DOCTYPE html>
<html>
<head>
    <title>Listado de Alumnos con Profesores</title>
    <style>
        /* Estilos CSS para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Listado de Alumnos y profesores</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre de los Alumnos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre }}</td>
                </tr>
            @endforeach

            <thead>
                <tr>
                    <th>Nombre de los Profesores</th>
                </tr>
            </thead>

            @foreach ($profesores as $profesor)
                <tr>
                    <td>{{ $profesor->nombre }}</td>
                </tr>
            @endforeach

            <thead>
                <tr>
                    <th>Calificaciones</th>
                </tr>
            </thead>
        </tbody>
    </table>
</body>
</html>
