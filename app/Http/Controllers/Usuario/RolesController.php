<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\CreateRol;
use App\Models\Roles;
use App\Models\UsuarioRoles;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function createRol(CreateRol $request, $id)
    {
        try {
            $admi = UsuarioRoles::where('CodUsu', $id)->where('CodRol', 1)->first();
            if (!$admi) {
                return response()->json(['message' => "Usted no puede asignar nuevos roles", 'user' => $admi], 403);
            }

            $validated = $request->validated();

            $existingRole = UsuarioRoles::where('CodUsu', $validated['CodUsu'])
                ->where('CodRol', $validated['CodRol'])
                ->first();

            if ($existingRole) {
                return response()->json(['message' => "El usuario ya tiene asignado este rol"], 422);
            }


            $validated['EstUM'] = 1;
            $validated['RegUR'] = now();

            UsuarioRoles::create($validated);

            return response()->json(['message' => "Rol asignado exitosamente"]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function updateRol(CreateRol $request, $id)
    {
        try {
            $validated = $request->validated();

            $validated['EstUM'] = 1;
            $validated['RegUR'] = now();

            UsuarioRoles::where('CodUR', $id)->update($validated);

            return response()->json(['message' => "Rol actualizado exitosamente"]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function deleteRol($id, $admiId)
    {
        try {
            $admi = UsuarioRoles::where('CodUsu', $admiId)->where('CodRol', 1)->first();
            if (!$admi) {
                return response()->json(['message' => "Usted no puede elimanr los roles"], 403);
            }
            UsuarioRoles::where('CodUR', $id)->delete();

            return response()->json(['message' => "Rol eliminado exitosamente"]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function getRoles()
    {
        try {
            $roles = Roles::all();
            return response()->json($roles);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function getUsuarioRoles()
    {
        try {
            $roles = DB::table('usuarios_rol')
                ->join('usuario', 'usuarios_rol.CodUsu', '=', 'usuario.CodUsu')
                ->join('roles', 'usuarios_rol.CodRol', '=', 'roles.CodRol')
                ->select(
                    'usuarios_rol.*',
                    'usuario.NomUsu',
                    'roles.NomRol'
                )
                ->get();

            return response()->json($roles);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
