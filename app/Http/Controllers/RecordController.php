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
        $table = Record::orderBy('period', 'desc')
                ->paginate(10);
        return view('records.index', compact('count', 'table'));
    }

    public function generatePdf(int $id)
    {
        $record = Record::findOrFail($id);

        $date  = Carbon::createFromFormat('Y-m', $record->period);
        $start = $date->copy()->startOfMonth();
        $end   = $date->copy()->endOfMonth();

        $expenses = Expense::whereBetween('created_at', [$start, $end])->get();
        $revenues = Revenue::whereBetween('created_at', [$start, $end])->get();
        
        $pdf = Pdf::loadView('reports.pdf', [
            'title'         => 'Reporte mensual de gastos e ingresos:',
            'record'        => $record,
            'expenses'      => $expenses,
            'revenues'      => $revenues,
            'totalRevenues' => $record->details['ingresos'],
            'totalExpenses' => $record->details['egresos'],
            'balance'       => $record->details['balance'],
        ]);

        return $pdf->stream("reporte-{$record->period}.pdf");
    }
}
