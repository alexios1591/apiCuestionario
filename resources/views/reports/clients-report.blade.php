<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes - {{ date('d/m/Y H:i:s') }}</title>
    <style>
        @page {
            margin: 1cm;
            size: A4;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            line-height: 1.3;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        .report-date {
            color: #7f8c8d;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th {
            background-color: #2c3e50;
            color: white;
            padding: 6px;
            text-align: left;
            font-size: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        td {
            padding: 5px;
            border-bottom: 1px solid #bdc3c7;
            font-size: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .encuestado {
            color: white;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 7px;
            text-align: center;
            white-space: nowrap;
        }
        .encuestado-si {
            background-color: #27ae60;
        }
        .encuestado-no {
            background-color: #e74c3c;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            color: #7f8c8d;
            padding: 5px 0;
        }
        .page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="report-title">Reporte de Clientes</h1>
        <div class="report-date">Generado el: {{ date('d/m/Y H:i:s') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Código</th>
                <th>Nombres y Apellidos</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Localidad</th>
                <th>Fecha Nac.</th>
                <th>Registro</th>
                <th>Encuestado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cliente['CodClie'] }}</td>
                    <td>{{ $cliente['NomClie'] }} {{ $cliente['AppClie'] }} {{ $cliente['ApmClie'] }}</td>
                    <td>{{ $cliente['DniClie'] }}</td>
                    <td>{{ $cliente['EmaClie'] }}</td>
                    <td>{{ $cliente['CelClie'] }}</td>
                    <td>{{ $cliente['localidad'] }}</td>
                    <td>{{ date('d/m/Y', strtotime($cliente['FnaClie'])) }}</td>
                    <td>{{ date('d/m/Y', strtotime($cliente['RegClie'])) }}</td>
                    <td>
                        <div class="encuestado {{ $cliente['encuestado'] ? 'encuestado-si' : 'encuestado-no' }}">
                            {{ $cliente['encuestado'] ? 'Sí' : 'No' }}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Página <span class="page-number"></span></p>
    </div>
</body>
</html>