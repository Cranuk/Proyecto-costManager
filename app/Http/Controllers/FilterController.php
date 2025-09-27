<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function date(){
        $currentYear = Carbon::now()->year; // Año actual
        $startYear = 2020; // NOTE: año limite inferior
        $endYear = $currentYear; // NOTE: limite seria el año actual
        $years = range($startYear, $endYear); // NOTE: Generamos los anios entre esos rangos
        
        // NOTE: Generamos los meses en formato traducido
        $months = array_map(function($m) {
            return Carbon::create()->month($m)->translatedFormat('F');
        }, range(1, 12));
        $months = array_combine(range(1, 12), $months);
        
        return response()->json([
            'years' => $years,
            'months' => $months,
        ]);
    }

    public function filter(Request $request){
        $allowedTables = ['expenses', 'revenues']; // NOTE: Tablas permitidas

        $tableName = $request->input('table');
        $month = $request->input('month');
        $year = $request->input('year');

        if (!in_array($tableName, $allowedTables)) {
            abort(400, 'Tabla no permitida.');
        }

        $query = DB::table($tableName)
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year);

        $records = $query->paginate(10);
        $count = $records->count();

        $page = $tableName . '.index';

        return view($page, [
            'table' => $records,
            'count' => $count
        ]);
    }
}
