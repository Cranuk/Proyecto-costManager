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

        // Verifico si ya existe un registro para ese mes
        $exists = Record::where('details->mes', $lastMonth->format('Y-m'))->exists();

        if ($exists) {
            Log::info("MonthlyBalanceJob: ya existe un registro para {$lastMonth->format('Y-m')}");
            return;
        }

        $balance = Helpers::getBalance($lastMonth); // NOTE: obtenemos el balance del mes anterior

        Record::create([
            'details' => [
                'mes'    => $lastMonth->format('Y-m'),
                'ingresos' => $balance['balancePositive'],
                'egresos'  => $balance['balanceNegative'],
                'balance'  => $balance['balanceTotal'],
            ],
        ]);

        Log::info("Balance del mes {$lastMonth->format('Y-m')}: " . json_encode($balance));
        Log::info("MonthlyBalanceJob ejecutado para el mes {$lastMonth->format('Y-m')}");
    }
}

