<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;

class IndexController extends Controller
{
    public function index()
    {
        $balances = Helpers::getBalance();
        $chartExpenses = Helpers::chartExpense();
        return view('main', compact('balances', 'chartExpenses'));
    }
}
