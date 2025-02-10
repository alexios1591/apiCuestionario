<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro Confirmado - Encuesta PHQ-9</title>
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
                            
                            <p>Te informamos que has sido registrado/a en la <strong>Encuesta sobre Salud Personal (PHQ-9)</strong>, un estudio orientado a la detección y evaluación de síntomas relacionados con la salud biopsicosocial.</p>
                            
                            <h3 style="color: #007BFF;">📌 Objetivo de la Encuesta</h3>
                            <p>El <strong>Cuestionario de Salud Personal-9 (PHQ-9)</strong> es una herramienta diseñada para identificar síntomas depresivos, evaluar su severidad y facilitar el acceso a recursos de apoyo, contribuyendo así al bienestar de la comunidad.</p>

                            <h3 style="color: #007BFF;">📞 Próximos Pasos</h3>
                            <p>En los próximos días, uno de nuestros encuestadores se pondrá en contacto contigo para proporcionarte más información y coordinar la aplicación del cuestionario.</p>

                            <p>Si tienes alguna consulta, no dudes en responder a este correo o comunicarte con nuestro equipo.</p>

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
