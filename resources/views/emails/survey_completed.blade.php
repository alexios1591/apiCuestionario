<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Encuesta Completada - Resultados Disponibles</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600px" cellpadding="20" cellspacing="0" style="border: 1px solid #ddd; border-radius: 10px;">
                    <tr>
                        <td align="center" style="background-color: #007BFF; color: #fff; font-size: 24px; padding: 15px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            <strong>Encuesta sobre Salud Personal (PHQ-9)</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <p>Estimado/a <strong>{{ $details['name'] }}</strong>,</p>
                            
                            <p>Te informamos que has completado exitosamente la <strong>Encuesta sobre Salud Personal (PHQ-9)</strong>. Agradecemos tu participación en este estudio, el cual busca mejorar la detección y seguimiento de la salud biopsicosocial.</p>

                            <h3 style="color: #007BFF;">📊 Tu Resultado</h3>
                            <p>De acuerdo con tus respuestas, tu puntaje final en la evaluación es: <strong>{{ $details['score'] }}</strong>.</p>

                            <h3 style="color: #007BFF;">📌 Interpretación de tu Resultado</h3>
                            @if($details['score'] >= 0 && $details['score'] <= 4)
                                <p>Tu puntaje indica que actualmente no presentas síntomas significativos de depresión. Sin embargo, es importante seguir cuidando tu bienestar emocional.</p>
                            @elseif($details['score'] >= 5 && $details['score'] <= 9)
                                <p>Tu resultado sugiere síntomas leves de depresión. Te recomendamos estar atento a cualquier cambio en tu estado de ánimo y buscar apoyo si es necesario.</p>
                            @elseif($details['score'] >= 10 && $details['score'] <= 14)
                                <p>Se han identificado síntomas moderados de depresión. Sería recomendable conversar con un profesional de salud para una evaluación más detallada.</p>
                            @elseif($details['score'] >= 15 && $details['score'] <= 19)
                                <p>Tu puntaje indica una depresión moderadamente severa. Te sugerimos buscar orientación profesional para recibir el apoyo adecuado.</p>
                            @else
                                <p>Los resultados muestran síntomas severos de depresión. Es altamente recomendable que consultes con un especialista en salud mental lo antes posible.</p>
                            @endif

                            <h3 style="color: #007BFF;">📄 Descarga tu Reporte</h3>
                            <p>Puedes descargar tu reporte completo con los detalles de tu evaluación haciendo clic en el siguiente enlace:</p>

                            <p style="text-align: center;">
                                <a href="{{ $details['report_link'] }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #28a745; text-decoration: none; border-radius: 5px;">Descargar Reporte</a>
                            </p>

                            <p>Si tienes dudas o necesitas más información, no dudes en contactarnos.</p>

                            <p>Atentamente,</p>
                            <p><strong>{{ config('app.name') }}</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="background-color: #f4f4f4; padding: 10px; font-size: 12px; color: #666; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
