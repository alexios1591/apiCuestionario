<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="h-svh bg-fondo flex items-center justify-center relative">

    <a href="{{ route('login') }}" class="absolute top-1 left-1 bg-blue-600 hover:bg-blue-700 transition-colors py-2 px-4 rounded-lg text-white">Admin</a>

    <div class="bg-black/30 p-8 rounded-lg flex flex-col gap-4">
        <div class="text-3xl text-gray-100 text-center">
            CUESTIONARIO SOBRE SALUD PERSONAL-9<br>(PHQ-9)
        </div>
        <div class="text-center text-gray-100 text-lg">
            El presente cuestionario tiene como objetivo<br>consultar respecto a tu salud personal.
        </div>

        <form action="{{ route('cuestionario.validate') }}" method="post">
            @csrf
           <div class="gap-4 flex flex-col">
            <div class="flex flex-col gap-2">
                <label for="dni" class="text-white">Ingrese el código</label>
                <input type="text" id="dni" name="dni" class="py-2 px-4 rounded-lg outline-none" required>
            </div>
            <div class="flex items-center justify-center ">
                <button type="submit" class="bg-purple-500 hover:bg-purple-600 transition-colors text-white rounded-lg py-2 px-4">Iniciar</button>
            </div>
           </div>
        </form>

        <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
            <div class="alert alert-danger mt-3">Código incorrecto. Inténtelo nuevamente.</div>
        <?php endif; ?>
    </div>

</body>
</html>