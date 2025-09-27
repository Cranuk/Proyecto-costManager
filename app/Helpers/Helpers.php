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
}
