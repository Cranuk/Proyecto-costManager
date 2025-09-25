<?php

namespace App\Jobs;

use App\Helpers\Helpers;
use App\Models\Record;
use Illuminate\Support\Facades\Log;

class MonthlyBalanceJob
{
    public function handle()
    {
        $lastMonth = now()->subMonth()->startOfMonth(); // NOTE: obtenemos el primer día del mes anterior osea 01/08/2025 por ejemplo

        $balance = Helpers::getBalance($lastMonth); // NOTE: obtenemos el balance del mes anterior

        Record::create([
            'details' => [
                'mes'    => $lastMonth->format('Y-m'),
                'ingresos' => $balance['balancePositive'],
                'egresos'  => $balance['balanceNegative'],
                'balance'  => $balance['balanceTotal'],
            ],
        ]);

        Log::info("MonthlyBalanceJob ejecutado para el mes {$lastMonth->format('Y-m')}");
    }
}

