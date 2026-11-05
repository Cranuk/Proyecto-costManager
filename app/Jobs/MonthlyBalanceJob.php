<?php

namespace App\Jobs;

use App\Helpers\Helpers;
use App\Models\Record;
use Illuminate\Support\Facades\Log;

class MonthlyBalanceJob
{
    public function handle()
    {
        $lastMonth = now()->subMonth()->startOfMonth();
        $period = $lastMonth->format('Y-m');

        // Verifico si ya existe un registro para ese mes
        $record = Record::where('period', $period)->first();

        if ($record) {
            Log::info("El Reporte del mes {$period} ya existe.");
            return [
                'created' => false,
                'period'  => $period,
                'details' => $record->details,
            ];
        }

        $balance = Helpers::getBalanceReport($period); // NOTE: obtenemos el balance del mes anterior

        $record = Record::create([
            'period' => $period,
            'details' => [
                'ingresos' => $balance['balancePositive'] ?? 0,
                'egresos'  => $balance['balanceNegative'] ?? 0,
                'balance'  => $balance['balanceTotal'] ?? 0,
            ],
        ]);

        Log::info("Balance del mes {$period}: ", $balance);
        Log::info("Reporte mensual generado para el mes {$period}");

        return [
            'created' => true,
            'period'  => $period,
            'details' => $record->details,
        ];
    }
}

