<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuestionario;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Survey;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getDashboardStats()
    {
        $totalRegisteredRespondents = Cliente::count();
        $totalRespondents = Cliente::whereHas('preguntas')->count();
        $totalUnsurveyed = $totalRegisteredRespondents - $totalRespondents;
        $totalSurveysToday = Cuestionario::whereDate('FecPre', Carbon::today())->count();

        return response()->json([
            'totalRegisteredRespondents' => $totalRegisteredRespondents,
            'totalRespondents' => $totalRespondents,
            'totalUnsurveyed' => $totalUnsurveyed,
            'totalSurveysToday' => $totalSurveysToday
        ]);
    }
}
