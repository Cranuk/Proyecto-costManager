<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $balances = Helpers::getBalance();
        $chartExpenses = Helpers::chartExpense();
        return view('main', [
            'balances' => $balances,
            'chartExpenses' => $chartExpenses
        ]);
    }
}
