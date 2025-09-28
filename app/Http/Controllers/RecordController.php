<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Record;
use App\Models\Revenue;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RecordController extends Controller
{
    public function index()
    {
        $count = 1;
        $table = Record::orderBy('created_at', 'desc')
                ->paginate(10);
        return view('records.index', compact('count', 'table'));
    }

    public function generatePdf($id)
    {
        // este seria el json que uso para la busqueda {"mes": "2025-08", "balance": 0, "egresos": 0, "ingresos": 0}
        $record = Record::find($id);
        $date = Carbon::createFromFormat('Y-m', $record->details['mes']);
        $month = $date->format('m');
        $year = $date->format('Y');

        $expenses = Expense::whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->get();

        $revenues = Revenue::whereMonth('created_at', '=', $month)
                    ->whereYear('created_at', '=', $year)
                    ->get();
        
        $pdf = Pdf::loadView('reports.pdf', [
            'title' => 'Reporte mensual de gastos e ingresos:',
            'record' => $record,
            'expenses' => $expenses,
            'revenues' => $revenues,
            'totalRevenues' => $record->details['ingresos'],
            'totalExpenses' => $record->details['egresos'],
            'balance' => $record->details['balance'],
        ]);

        return $pdf->stream('reports.pdf');
    }
}
