<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\StoreRequest;
use App\Models\Cliente;
use App\Models\UsuarioRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll($id)
    {
        try {
            $isAdmin = UsuarioRoles::where('CodUsu', $id)
                                   ->where('CodRol', 1)
                                   ->exists(); 
    
            if ($isAdmin) {
                $clientes = DB::table('preguntas')
                              ->join('clientes', 'preguntas.CodClie', '=', 'clientes.CodClie')
                              ->select('clientes.*')
                              ->get();
            } else {
                $clientes = DB::table('preguntas')
                              ->join('clientes', 'preguntas.CodClie', '=', 'clientes.CodClie')
                              ->where('preguntas.CodUsu', $id)
                              ->select('clientes.*')
                              ->get();
            }
    
            return response()->json($clientes);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error', 'error' => $e->getMessage()], 500);
        }
    }

    public function getClientes()
    {
        try{
            $clientes = Cliente::all();
            return response()->json($clientes);
        }catch(\Exception $e){
            return response()->json(['message' => "Error interno"]);
        }
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{
            $validated = $request->validated();
            $validated['RegClie'] = now();

            $cliente = Cliente::create($validated);

            return response()->json(["message" => "Cliente registrado", "cliente" => collect([$cliente])]);

        }catch(\Exception $e){
            return response()->json(["message" => $e]);
        }
    }

    public function searchByDni($dni)
{
    try {
        $clientes = Cliente::where('DniClie', $dni)->get();

        if ($clientes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron clientes con el DNI proporcionado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Clientes encontrados.',
            'clientes' => $clientes
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al buscar el cliente.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
