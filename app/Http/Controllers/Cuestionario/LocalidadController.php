<?php

namespace App\Http\Controllers\Cuestionario;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    public function departamento()
    {
        $departamentos = Departamento::all();
        return response()->json(['departamento' => $departamentos]);
    }

    public function provincia($id)
    {
        $provincias = Provincia::where('idDepartamento', $id)->get();
        return response()->json(['provincias' => $provincias]);
    }

    public function distrito($id)
    {
        $distritos = Distrito::where('idProvincia', $id)->get();
        return response()->json(['distritos' => $distritos]);
    }
    
}
