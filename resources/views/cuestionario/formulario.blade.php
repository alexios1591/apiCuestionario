@extends('layout._app')

@section('content-main')
<div class="bg-fondo flex justify-center items-center h-screen">
    <div id="registro-card" class="bg-white rounded-lg p-8 shadow-xl h-auto w-1/3">
        <h2 class="text-gray-800 font-sans font-bold text-xl mb-2">
            Registre su Datos
        </h2>
        
            <form id="registro-form">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="nombre" class="text-lg font-sans">Nombre</label>
                        <input type="text" class="border border-blue-500 py-2 px-4 rounded-xl outline-none" id="nombre" name="nombre" >
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="apellido" class="text-lg font-sans">Apellido</label>
                        <input type="text" class="border border-blue-500 py-2 px-4 rounded-xl outline-none" id="apellido" name="apellido"  >
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="telefono" class="text-lg font-sans">Teléfono</label>
                        <input type="text" class="border border-blue-500 py-2 px-4 rounded-xl outline-none" id="telefono" name="telefono"  >
                    </div>
                    <div class="flex flex-col gap-2">
                        @include('cuestionario.localidad.index')
                    </div>
                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors py-2 px-4" >Siguiente  </button>
                </div>
            </form>
    </div>
</div>
@endsection