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
    public static function getBalanceNegative(?Carbon $date = null)
    {
        $date ??= Carbon::now();
        $amountNegative = Expense::whereMonth('created_at',$date->month)
            ->whereYear('created_at', $date->year)
            ->sum('amount');
        return $amountNegative;
    }

    public static function getBalancePositive(?Carbon $date = null)
    {
        $date ??= Carbon::now();
        $amountPositive = Revenue::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->sum('amount');
        return $amountPositive;
    }

    public static function getBalance(?Carbon $date = null)
    {
        $balanceNegative = self::getBalanceNegative($date);
        $balancePositive = self::getBalancePositive($date);
        $balanceTotal = $balancePositive - $balanceNegative;
        return [
            'balanceNegative' => $balanceNegative,
            'balancePositive' => $balancePositive,
            'balanceTotal' => $balanceTotal
        ];
    }

    public static function nameCategory($id)
    {
        $category = Category::find($id);
        return $category->name;
    }

    public static function spanishDate($date)
    {
        $date = Carbon::parse($date);
        return $date->translatedFormat('F Y');
    }

    public static function chartExpense(){
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $expenseCategory = Category::withSum(['expenses' => function($query) use ($month, $year) {
                $query->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year);
            }], 'amount')
            ->where('typeCategory', 1)
            ->get();

        $categories = $expenseCategory->pluck('name');
        $total = $expenseCategory->pluck('expenses_sum_amount');
        
        // Si no tiene color, asigna gris
        $color = $expenseCategory->map(function($cat) {
            return $cat->color ?? '#999999';
        });

        return [
            'categories' => $categories,
            'color' => $color,
            'total' => $total
        ];
    }
}
