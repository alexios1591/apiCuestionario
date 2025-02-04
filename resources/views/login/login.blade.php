@extends('layout._app')

@section('content-main')
    <div class="h-screen flex items-center justify-center bg-blue-500">
        <div class="bg-white/50 p-8 flex gap-8 rounded-xl items-center">
            <div class="col-md-6">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('loginc') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <h2 class="text-gray-900 font-sans text-xl font-bold text-center">Iniciar sesión</h2>
                        <div class="form-group">
                            <input type="text" class="py-2 px-4 rounded-lg outline-none" name="NomUsu" placeholder="Nombre de usuario" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="py-2 px-4 rounded-lg outline-none" name="PassUsu" placeholder="Contraseña" required>
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition-colors py-2 px-4 text-white rounded-lg">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-4 d-none d-md-block">
                <img src="{{ asset('images/1_img.PNG') }}" alt="segurt" class="h-80 w-auto">
            </div>
        </div>
    </div>
@endsection
