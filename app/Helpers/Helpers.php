<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Revenue;
use Carbon\Carbon;
use NumberFormatter;

class Helpers
{
    // TODO: aquí estarán los métodos que se usarán en toda la web, revisar igual si funciona como corresponde

    // NOTE: función para las fechas
    public static function formatDate($date)
    {
        $fecha = Carbon::parse($date)->format('d/m/Y');
        return $fecha;
    }

    // NOTE: función para monedas
    public static function formatCurrency($amount)
    {
        $formatter = new NumberFormatter('es_AR', NumberFormatter::CURRENCY);
        $formatted = $formatter->formatCurrency($amount, 'ARS');
        return $formatted;
    }

    // NOTE: funciones para balance
    public static function getBalanceNegative(?int $month = null, ?int $year = null)
    {
        $month = $month ?? Carbon::now()->month;
        $year  = $year ?? Carbon::now()->year;

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();

        return Expense::whereBetween('created_at', [$start, $end])->sum('amount');
    }

    public static function getBalancePositive(?int $month = null, ?int $year = null)
    {
        $month = $month ?? Carbon::now()->month;
        $year  = $year ?? Carbon::now()->year;

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();

        return Revenue::whereBetween('created_at', [$start, $end])->sum('amount');
    }

    public static function getBalance(?int $month = null, ?int $year = null)
    {
        $balanceNegative = self::getBalanceNegative($month);
        $balancePositive = self::getBalancePositive($year);
        $balanceTotal = $balancePositive - $balanceNegative;
        return [
            'balanceNegative' => $balanceNegative,
            'balancePositive' => $balancePositive,
            'balanceTotal' => $balanceTotal
        ];
    }

    public static function nameCategory($id)
    {
        return Category::where('id', $id)->value('name') ?? 'Sin Categoría';
    }

    public static function spanishDate($date)
    {
        $date = Carbon::parse($date);
        return $date->translatedFormat('F Y');
    }

    public static function chartExpense()
    {
        $month = $month ?? Carbon::now()->month;
        $year  = $year ?? Carbon::now()->year;

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();

        $expenseCategory = Category::withSum(['expenses' => function($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            }], 'amount')
            ->where('typeCategory', 1)
            ->get();

        return [
            'categories' => $expenseCategory->pluck('name'),
            'color'      => $expenseCategory->map(fn($cat) => $cat->color ?? '#999999'),
            'total'      => $expenseCategory->pluck('expenses_sum_amount')
        ];
    }
}
