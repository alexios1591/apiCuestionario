<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Models\Usuario;
use App\Models\UsuarioRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('NomUsu', 'PassUsu');
    
        $usuario = Usuario::where('NomUsu', $credentials['NomUsu'])->first();
        if ($usuario && Hash::check($credentials['PassUsu'], $usuario->PassUsu)) {
            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user' => $usuario,
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Nombre de usuario o contraseña incorrectos'
        ], 401);
    }

    public function index()
    {
        $user = Usuario::all();
        return response()->json([
            'user' => $user
        ]);
    }

    public function getAllUser($id){
        try {
            $isAdmin = UsuarioRoles::where('CodUsu', $id)
                                   ->where('CodRol', 1)
                                   ->exists(); 
    
            if ($isAdmin) {
                $users = Usuario::all();
            } else {
                $users = Usuario::where('CodUsu', $id)->get();
            }
    
            return response()->json([
                'user' => $users
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error', 'error' => $e->getMessage()], 500);
        }
    }
}
