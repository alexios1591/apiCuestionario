<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="h-auto flex justify-center bg-fondo py-8">
    <div class="bg-black/50 text-white max-w-[600px] p-8 rounded-lg flex flex-col gap-4">
        <h1 class="font-sans text-3xl font-bold">Cuestionario sobre Salud Personal-9 (PHQ-9)</h1>

        <h2 class="font-sans text-xl font-bold">CONSENTIMIENTO PARA PARTICIPAR</h2>
        <p><strong>Acompañamiento biopsicosocial a mujeres vulnerables en Perú</strong> </p>

        <h3 class="font-sans text-lg font-bold">Introducción</h3>
        <p>Hola mi nombre es Kris Maria Pimentel Escobar, profesora de Trabajo Social especializada en salud
            biopsicosocial de la Universidad Nacional Micaela bastidas de Apurimac .</p>
        <p>En colaboración, las universidades de San Antonia Abad de Cusco-Perú, estamos planeando llevar a cabo un
            estudio de investigación, al cual te invito a participar.</p>

        <h3 class="font-sans text-lg font-bold">Propósito</h3>
        <p>Nuestro objetivo es crear y desarrollar un servicio de acompañamiento para la mejora de la salud de las
            mujeres en Perú utilizando los teléfonos móviles.</p>

        <h3 class="font-sans text-lg font-bold">Procedimientos</h3>
        <p>Si decides participar en este estudio, te pediremos que hagas lo siguiente:</p>
        <ol>
            <li>Atender y leer los mensajes con consejos saludables que recibirás en tu teléfono móvil y responder
                libremente cuando lo prefieras.</li>
            <li>Participar cuando puedas en reuniones en grupo para comentar los consejos saludables.</li>
            <li>Debes responder a cuestionarios sencillos de duración aproximada de 1 a 5 minutos. Eres libre de
                saltarse cualquier pregunta que no desees responder.</li>
        </ol>
        <p>Eres libre de poner fin a tu participación en el estudio en cualquier momento.</p>

        <h3 class="font-sans text-lg font-bold">Beneficios</h3>
        <p>El beneficio directo para ti por participar en este estudio será la posibilidad de recibir atención y consejo
            para la mejora de tu salud. Además, se espera que la información obtenida en el estudio pueda mejorar la
            atención social y de salud a otras mujeres de Perú y de España.</p>

        <h3 class="font-sans text-lg font-bold">Molestias</h3>
        <p>No contemplamos molestias. Eres libre de saltarse cualquier pregunta de los cuestionarios que prefieras no
            responder por cualquier motivo.</p>

        <h3 class="font-sans text-lg font-bold">Confidencialidad</h3>
        <p>Vamos a mantener tus datos de estudio con confidencialidad. Los datos del estudio se mantendrán en formato
            digital cifrado en un equipo informático protegido por contraseña. El archivo de claves que contengan tu
            nombre y número de teléfono se mantendrá por separado y totalmente resguardados.</p>

        <h4 class="font-sans text-md font-bold">Costes de participación en el estudio</h4>

        <div class="flex items-center justify-center">
            <a href="{{ route('cuestionario.formulario') }}" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 text-xl rounded-lg" >Aceptar</a>
        </div>
    </div>
</body>

</html>
