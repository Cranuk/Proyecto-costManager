<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // NOTE: funciones para gastos

    public function index(){
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $expenses = Expense::whereMonth('created_at','=',$month)
                    ->whereYear('created_at','=',$year)
                    ->orderBy('created_at','desc')
                    ->paginate(10);
        $count = $expenses->total();

        return view('expenses.index',[
            'table' => $expenses,
            'count' => $count,
        ]);
    }

    public function create(){
        $categories = Category::where('typeCategory', 1)->get(); // NOTE: Nos traemos datos de la tabla categorias
        return view('expenses.create',[
            'categories' => $categories // NOTE: estos datos son para cargar el select de categorias
        ]);
    }

    public function delete($id){
        try {
            $expense = Expense::find($id);
            $expense->delete();
            return redirect()->route('expense')
                            ->with('status', 'Se elimino correctamente');
        } catch (\Exception $e) {
            return redirect()->route('expense')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $categories = Category::where('typeCategory', 1)->get(); // NOTE: Nos traemos datos de la tabla categorias
        $edit = Expense::find($id);
        return view('expenses.create',[
            'edit' => $edit,
            'categories' => $categories
        ]);
    }

    public function update(Request $request){
        try {
            $id = $request -> input('id');
            $category = $request -> input('category');
            $date = $request -> input('date');
            $description = $request -> input('description');
            $amount = $request -> input('amount');
            $fullDate = Carbon::parse($date)->setTimeFrom(Carbon::now());

            $expense = Expense::find($id);
            $expense->update([
                'category_id' => $category,
                'description' => $description,
                'amount' => $amount,
                'created_at' => $fullDate,
            ]);
            return redirect()->route('expense')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('expense')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function save(Request $request){
        try {
            $description = $request -> input('description');
            $amount = $request -> input('amount');
            $category = $request -> input('category');
            $date = $request -> input('date');
            $fullDate = Carbon::parse($date)->setTimeFrom(Carbon::now());

            Expense::create([
                'category_id' => $category,
                'description' => $description,
                'amount' => $amount,
                'created_at' => $fullDate,
            ]);
            return redirect()->route('expense')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('expense')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }
}
