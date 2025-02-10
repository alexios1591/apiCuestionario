<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Cuestionario {{ $encuestado['NomClie'] }} {{ $encuestado['AppClie'] }} {{ $encuestado['ApmClie'] }} - {{ date('d/m/Y H:i:s') }}</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 1cm;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo {
            font-size: 16px;
            font-weight: bold;
            color: #222;
        }

        .date {
            text-align: right;
            font-size: 11px;
            font-style: italic;
        }

        .section {
            margin-bottom: 10px;
        }

        .section-title {
            background-color: #2c3e50;
            color: white;
            padding: 5px 8px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 4px;
        }

        .data-grid {
            width: 100%;
            margin-top: 5px;
            border-collapse: collapse;
        }

        .data-grid td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .data-label {
            font-weight: bold;
            background-color: #f5f5f5;
        }

        .responses {
            width: 100%;
            margin-top: 5px;
            border-collapse: collapse;
        }

        .responses td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .responses .question {
            font-weight: bold;
            background-color: #2c3e50;
            color: white;
        }

        .observations {
            margin-top: 5px;
            padding: 5px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            font-style: italic;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        /* Ajustar contenido para llenar toda la página */
        .page-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="page-content">
        <div>
            <div class="header">
                <div class="logo">INFORME DE CUESTIONARIO</div>
                <div class="date">Fecha de Registro: {{ $encuestado['RegClie'] }}</div>
            </div>

            <div class="section">
                <div class="section-title">INFORMACIÓN DEL ENCUESTADO</div>
                <table class="data-grid">
                    <tr>
                        <td class="data-label">Nombre Completo:</td>
                        <td>{{ $encuestado['NomClie'] }} {{ $encuestado['AppClie'] }} {{ $encuestado['ApmClie'] }}</td>
                        <td class="data-label">DNI:</td>
                        <td>{{ $encuestado['DniClie'] }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Fecha de Nacimiento:</td>
                        <td>{{ $encuestado['FnaClie'] }}</td>
                        <td class="data-label">Código Cliente:</td>
                        <td>{{ $encuestado['CodClie'] }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Teléfono:</td>
                        <td>{{ $encuestado['CelClie'] }}</td>
                        <td class="data-label">Email:</td>
                        <td>{{ $encuestado['EmaClie'] }}</td>
                    </tr>
                    <tr>
                        <td class="data-label">Localidad:</td>
                        <td colspan="3">{{ $encuestado['localidad'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">RESPUESTAS DEL CUESTIONARIO</div>
                <table class="responses">
                    <tr>
                        <td class="question">Pregunta 1</td>
                        <td>{{ $cuestionario['Pre1'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 2</td>
                        <td>{{ $cuestionario['Pre2'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 3</td>
                        <td>{{ $cuestionario['Pre3'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 4</td>
                        <td>{{ $cuestionario['Pre4'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 5</td>
                        <td>{{ $cuestionario['Pre5'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 6</td>
                        <td>{{ $cuestionario['Pre6'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 7</td>
                        <td>{{ $cuestionario['Pre7'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 8</td>
                        <td>{{ $cuestionario['Pre8'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 9</td>
                        <td>{{ $cuestionario['Pre9'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 10</td>
                        <td>{{ $cuestionario['Pre10'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 11</td>
                        <td>{{ $cuestionario['Pre11'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 12</td>
                        <td>{{ $cuestionario['Pre12'] }}</td>
                    </tr>
                    <tr>
                        <td class="question">Pregunta 13</td>
                        <td>{{ $cuestionario['Pre13'] ?? 'Sin respuesta' }}</td>
                    </tr>
                </table>

                <div class="observations">
                    <strong>Observaciones:</strong><br>
                    {{ $cuestionario['ObsPre'] }}
                </div>

                <div style="margin-top: 5px; font-size: 12px; font-weight: bold;">
                    Puntuación Total: {{ $cuestionario['PunPre'] }} puntos
                </div>
            </div>
        </div>

    </div>
</body>

</html>