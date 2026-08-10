<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Models\Expense;
use App\Models\Record;
use App\Models\Revenue;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class PopulateHistoricalRecords extends Command
{
    protected $signature = 'records:report-history';

    protected $description = 'Genera los reportes mensuales de balances históricos faltantes';

    public function handle()
    {
        $this->info('Iniciando generación de reportes históricos...');

        // 1. Buscamos la fecha del registro mas antiguo entre Ingresos y Egresos
        $oldestExpense = Expense::min('created_at');
        $oldestRevenue = Revenue::min('created_at');

        if (!$oldestExpense && !$oldestRevenue) {
            $this->warn('No hay datos históricos registrados en la base de datos.');
            return;
        }

        // Determinamos la fecha más antigua global
        $firstDate = min(
            filter_var([$oldestExpense, $oldestRevenue], FILTER_VALIDATE_INT) ?: [$oldestExpense ?? $oldestRevenue]
        );

        $startDate = Carbon::parse($firstDate)->startOfMonth();
        // Procesamos hasta el mes anterior al actual
        $endDate   = now()->subMonth(2)->startOfMonth();

        $current = $startDate->copy();
        $processed = 0;
        $skipped   = 0;

        while ($current->lte($endDate)) {
            $period = $current->format('Y-m');

            // Verificamos si ya existe para no duplicar
            $exists = Record::where('period', $period)->exists();

            if ($exists) {
                $skipped++;
            } else {
                // Obtenemos el balance de ese mes histórico
                $balance = Helpers::getBalance($current);

                Record::create([
                    'period'  => $period,
                    'details' => [
                        'ingresos' => $balance['balancePositive'] ?? 0,
                        'egresos'  => $balance['balanceNegative'] ?? 0,
                        'balance'  => $balance['balanceTotal'] ?? 0,
                    ],
                ]);

                $this->line(" Reporte generado para el período: <info>{$period}</info>");
                $processed++;
            }

            // Avanzamos al siguiente mes
            $current->addMonth();
        }

        $this->newLine();
        $this->info("Proceso finalizado con éxito.");
        $this->comment("Reportes creados: {$processed} | Reportes omitidos (ya existían): {$skipped}");
    }
}