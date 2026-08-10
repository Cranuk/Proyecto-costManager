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
        $exists = Record::where('period', $period)->exists();

        if ($exists) {
            Log::info("El Reporte del mes {$period} ya existe.");
            return;
        }

        $balance = Helpers::getBalance($lastMonth); // NOTE: obtenemos el balance del mes anterior

        Record::create([
            'period' => $period,
            'details' => [
                'ingresos' => $balance['balancePositive'],
                'egresos'  => $balance['balanceNegative'],
                'balance'  => $balance['balanceTotal'],
            ],
        ]);

        Log::info("Balance del mes {$period}: ", $balance);
        Log::info("Reporte mensual generado para el mes {$period}");
    }
}

