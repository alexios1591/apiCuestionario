<?php

namespace App\Http\Controllers\Cuestionario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cuestionario\StoreRequest;
use App\Models\Cuestionario;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CuestionarioController extends Controller
{
    public function validateCode(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:20', 
        ]);

        $dni = $request->input('dni');

        $user = Usuario::where('DocUsu', $dni)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'DNI válido.',
                'usuario' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Código de acceso inválido.',
            ], 404);
        }
    }

    public function insert(StoreRequest $request){
        try{
            $validated = $request->validated();
            Cuestionario::create($validated);
            return response()->json(['message' => 'Registro creado'], 201);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function getById($id){
        try{
            $cuestionario = Cuestionario::where('CodClie', $id) 
            ->orderBy('CodPre', 'desc')
            ->first();
            return response()->json(['cuestionario' => $cuestionario]);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
    }


}
