<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\StoreRequest;
use App\Mail\SurveyRegistrationNotification;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\UsuarioRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ClientExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Str;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll($id, Request $request)
    {
        try {

            $dni = $request->query('dni');

            $isAdmin = UsuarioRoles::where('CodUsu', $id)
                ->where('CodRol', 1)
                ->exists();

            $clientesQuery = DB::table('preguntas')
                ->join('clientes', 'preguntas.CodClie', '=', 'clientes.CodClie')
                ->join('usuario', 'preguntas.CodUsu', '=', 'usuario.CodUsu')
                ->select('clientes.*', DB::raw('CONCAT(usuario.NomUsu, " ", usuario.AppUsu, " ", usuario.ApmUsu) as Encuestador'));

            if (!$isAdmin) {
                $clientesQuery->where('preguntas.CodUsu', $id);
            }

            if ($dni) {
                $clientesQuery->where('clientes.DniClie', 'like', "%$dni%");
            }

            $clientes = $clientesQuery->paginate(10);

            $clientes->getCollection()->transform(function ($cliente) {
                $cliente->NomComp = $cliente->NomClie . ' ' . $cliente->AppClie . ' ' . $cliente->ApmClie;


                $localidad = Str::title(strtolower($cliente->localidad));

                $distrito = DB::table('distrito')
                    ->where('distrito', 'like', "%$localidad%")
                    ->first();

                if (!$distrito) {
                    dd($localidad);
                }

                $distrito = Distrito::find($distrito->idDistrito);

                $provincia = $distrito->provincia;
                $departamento = Departamento::find($provincia->idDepartamento);

                return [
                    'CodClie' => $cliente->CodClie,
                    'NomClie' => $cliente->NomClie,
                    'AppClie' => $cliente->AppClie,
                    'ApmClie' => $cliente->ApmClie,
                    'EmaClie' => $cliente->EmaClie,
                    'DniClie' => $cliente->DniClie,
                    'FnaClie' => $cliente->FnaClie,
                    'CelClie' => $cliente->CelClie,
                    'localidad' => $cliente->localidad,
                    'RegClie' => $cliente->RegClie,
                    'encuestado' => false,
                    'idDistrito' => $distrito->idDistrito,
                    'idProvincia' => $provincia->idProvincia,
                    'idDepartamento' => $departamento->idDepartamento,
                    'NomComp' => $cliente->NomComp,
                    'Encuestador' => $cliente->Encuestador
                ];
            });

            return response()->json($clientes);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error', 'error' => $e->getMessage()], 500);
        }
    }

    public function getUnsurveyed(Request $request)
    {
        try {

            $dni = $request->query('dni');

            $clientesQuery = Cliente::whereDoesntHave('preguntas')
                ->orderBy('RegClie', 'desc');

            if ($dni) {
                $clientesQuery->where('clientes.DniClie', 'like', "%$dni%");
            }

            $clientes = $clientesQuery->paginate(10);


            $clientes->getCollection()->transform(function ($cliente) {

                $localidad = Str::title(strtolower($cliente->localidad));

                $distrito = DB::table('distrito')
                    ->where('distrito', 'like', "%$localidad%")
                    ->first();

                if (!$distrito) {
                    dd($localidad);
                }

                $distrito = Distrito::find($distrito->idDistrito);

                $provincia = $distrito->provincia;
                $departamento = Departamento::find($provincia->idDepartamento);

                return [
                    'CodClie' => $cliente->CodClie,
                    'NomClie' => $cliente->NomClie,
                    'AppClie' => $cliente->AppClie,
                    'ApmClie' => $cliente->ApmClie,
                    'EmaClie' => $cliente->EmaClie,
                    'DniClie' => $cliente->DniClie,
                    'FnaClie' => $cliente->FnaClie,
                    'CelClie' => $cliente->CelClie,
                    'localidad' => $cliente->localidad,
                    'RegClie' => $cliente->RegClie,
                    'encuestado' => false,
                    'idDistrito' => $distrito->idDistrito,
                    'idProvincia' => $provincia->idProvincia,
                    'idDepartamento' => $departamento->idDepartamento
                ];
            });

            return response()->json($clientes);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error', 'error' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }

    public function getClientes()
    {
        try {
            $clientes = Cliente::all();
            return response()->json($clientes);
        } catch (\Exception $e) {
            return response()->json(['message' => "Error interno"]);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['RegClie'] = now();

            Mail::to($validated['EmaClie'])
                ->send(new SurveyRegistrationNotification([
                    'name' => $validated['NomClie']
                ]));

            $cliente = Cliente::create($validated);

            return response()->json(["message" => "Cliente registrado", "cliente" => collect([$cliente])]);

        } catch (\Exception $e) {
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

    public function exportPdf()
    {
        try {
            $clientes = Cliente::orderByRaw('CONCAT(NomClie, " ", AppClie, " ", ApmClie)')
                ->get()->transform(function ($cliente) {
                    return [
                        'CodClie' => $cliente->CodClie,
                        'NomClie' => $cliente->NomClie,
                        'AppClie' => $cliente->AppClie,
                        'ApmClie' => $cliente->ApmClie,
                        'EmaClie' => $cliente->EmaClie,
                        'DniClie' => $cliente->DniClie,
                        'FnaClie' => $cliente->FnaClie,
                        'CelClie' => $cliente->CelClie,
                        'localidad' => $cliente->localidad,
                        'RegClie' => $cliente->RegClie,
                        'encuestado' => $cliente->preguntas->isNotEmpty()
                    ];
                });

            $pdf = PDF::loadView('reports.clients-report', ['clientes' => $clientes]);
            return $pdf->download('Reporte de clientes - ' . now()->format('d-m-Y H:i:s') . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error al generar el PDF', 'error' => $e->getMessage()], 500);
        }
    }

    public function exportExcel()
    {
        try {

            $clientes = Cliente::orderByRaw('CONCAT(NomClie, " ", AppClie, " ", ApmClie)')
                ->get()->transform(function ($cliente, $index) {
                    return [
                        'index' => $index + 1,
                        'CodClie' => $cliente->CodClie,
                        'NomClie' => $cliente->NomClie,
                        'AppClie' => $cliente->AppClie,
                        'ApmClie' => $cliente->ApmClie,
                        'EmaClie' => $cliente->EmaClie,
                        'DniClie' => $cliente->DniClie,
                        'FnaClie' => $cliente->FnaClie,
                        'CelClie' => $cliente->CelClie,
                        'localidad' => $cliente->localidad,
                        'RegClie' => $cliente->RegClie,
                        'encuestado' => $cliente->preguntas->isNotEmpty()
                    ];
                });

            return Excel::download(
                new ClientExcelExport($clientes),
                'Reporte de clientes - ' . now()->format('d-m-Y H:i:s') . '.xlsx'
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al generar el Excel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function reportQuestionnaire($id)
    {
        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente no encontrado.'
                ], 404);
            }

            $preguntas = $cliente->preguntas;

            if ($preguntas->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'El cliente no ha sido encuestado.'
                ], 404);
            }

            $pdf = PDF::loadView('reports.questionnaire-report', ['encuestado' => $cliente, 'cuestionario' => $preguntas->first()]);
            return $pdf->download('Reporte de cuestionario - ' . $cliente->NomClie . ' ' . $cliente->AppClie . ' ' . $cliente->ApmClie . ' - ' . now()->format('d-m-Y H:i:s') . '.pdf');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al generar el PDF',
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
    public function update(StoreRequest $request)
    {
        try {

            $cliente = Cliente::find($request->input('CodClie'));

            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cliente no encontrado.'
                ], 404);
            }

            $cliente->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Cliente actualizado correctamente.',
                'cliente' => $cliente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar el cliente.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
