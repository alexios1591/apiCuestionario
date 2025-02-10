<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuestionario;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getSurveysByPeriod(Request $request)
    {
        $period = $request->period;

        if (!in_array($period, ['today', 'week', 'month', 'year'])) {
            return response()->json(['error' => 'Invalid period'], 400);
        }

        $now = Carbon::now();
        $labels = [];
        $indexAdjustment = 0;
        $groupBy = '';
        $dateColumn = 'FecPre';

        switch ($period) {
            case 'today':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                $groupBy = 'HOUR(HorPre)';
                $labels = [];
                for ($i = 0; $i < 24; $i++) {
                    $labels[] = Carbon::createFromTime($i, 0)->format('gA');
                }
                $indexAdjustment = 0;
                break;
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                $groupBy = 'DAYOFWEEK(' . $dateColumn . ') - 2';
                $labels = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
                $indexAdjustment = 0;
                break;
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $groupBy = 'DAY(' . $dateColumn . ')';
                $labels = range(1, $now->daysInMonth);
                $indexAdjustment = 1;
                break;
            case 'year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                $groupBy = 'MONTH(' . $dateColumn . ')';
                $labels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                $indexAdjustment = 1;
                break;
        }

        try {
            $surveys = Cuestionario::select([
                DB::raw("$groupBy as time_group"),
                DB::raw('COUNT(*) as count')
            ])
                ->whereBetween($dateColumn, [$start, $end])
                ->groupBy(DB::raw('time_group'))
                ->get();

            $counts = array_fill(0, count($labels), 0);

            foreach ($surveys as $item) {
                $timeGroup = (int) $item->time_group - $indexAdjustment;
                if (isset($counts[$timeGroup])) {
                    $counts[$timeGroup] = (int) $item->count;
                }
            }

            return response()->json([
                'labels' => $labels,
                'data' => $counts,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error processing request',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getSurveysByUser()
    {
        try {
            $surveysByUser = Cuestionario::select([
                'CodUsu',
                DB::raw('COUNT(*) as count')
            ])
                ->groupBy('CodUsu')
                ->with('usuario:CodUsu,NomUsu') // Assuming there is a relationship defined in the Cuestionario model
                ->get();

            $labels = [];
            $data = [];

            foreach ($surveysByUser as $item) {
                $labels[] = $item->usuario->NomUsu;
                $data[] = $item->count;
            }

            return response()->json([
                'labels' => $labels,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error processing request',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
