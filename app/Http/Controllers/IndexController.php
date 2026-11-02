<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $balances = Helpers::getBalance($month, $year);
        $chartExpenses = Helpers::chartExpense();
        return view('main', [
            'balances' => $balances,
            'chartExpenses' => $chartExpenses
        ]);
    }
}
