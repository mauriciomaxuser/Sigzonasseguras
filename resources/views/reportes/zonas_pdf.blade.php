<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Zonas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #333; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #555;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .titulo-seccion {
            background: #222;
            color: white;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Reporte General de Zonas</h1>

    <!-- Zonas de Riesgo -->
    <h2 class="titulo-seccion">ZONAS DE RIESGO</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Lat1</th>
                <th>Lng1</th>
                <th>Lat2</th>
                <th>Lng2</th>
                <th>Lat3</th>
                <th>Lng3</th>
                <th>Lat4</th>
                <th>Lng4</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riesgos as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->nombre }}</td>
                <td>{{ $r->nivel_riesgo }}</td>
                <td>{{ $r->latitud1 }}</td>
                <td>{{ $r->longitud1 }}</td>
                <td>{{ $r->latitud2 }}</td>
                <td>{{ $r->longitud2 }}</td>
                <td>{{ $r->latitud3 }}</td>
                <td>{{ $r->longitud3 }}</td>
                <td>{{ $r->latitud4 }}</td>
                <td>{{ $r->longitud4 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Zonas Seguras -->
    <h2 class="titulo-seccion">ZONAS SEGURAS</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Radio (m)</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Tipo Seguridad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seguras as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->nombre }}</td>
                <td>{{ $s->radio }}</td>
                <td>{{ $s->latitud }}</td>
                <td>{{ $s->longitud }}</td>
                <td>{{ $s->tipo_seguridad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
