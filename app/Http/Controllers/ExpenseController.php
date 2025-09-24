<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    // NOTE: funciones para gastos

    public function index(){
        $month = Carbon::now()->month;
        $expenses = DB::table('expenses')
                    ->whereMonth('created_at','=',$month)
                    ->orderBy('created_at','desc')
                    ->paginate(10);
        $count = $expenses->total();
        $categories = DB::table('categories')->get(); // NOTE: Nos traemos datos de la tabla categorias
        return view('expenses.index',[
            'table' => $expenses,
            'count' => $count,
            'categories' => $categories
        ]);
    }

    public function create(){
        $categories = DB::table('categories')->get(); // NOTE: Nos traemos datos de la tabla categorias
        return view('expenses.create',[
            'categories' => $categories // NOTE: estos datos son para cargar el select de categorias
        ]);
    }

    public function delete($id){
        try {
            DB::table('expenses')->where('id', '=', $id)
                                ->delete();
            return redirect()->route('expense')
                            ->with('status', 'Se elimino correctamente');
        } catch (\Exception $e) {
            return redirect()->route('expense')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $categories = DB::table('categories')->get(); // NOTE: Nos traemos datos de la tabla categorias
        $edit = DB::table('expenses')->where('id','=',$id)
                                    ->first(); // NOTE: buscamos los datos
        return view('expenses.create',[
            'edit' => $edit,
            'categories' => $categories
        ]); // NOTE: enviamos los datos a donde los seteamos
    }

    public function update(Request $request){
        try {
            $id = $request -> input('id');
            $category = $request -> input('category');
            $date = $request -> input('date');
            $description = $request -> input('description');
            $amount = $request -> input('amount');
            $fullDate = Carbon::parse($date)->setTimeFrom(Carbon::now());
            $update = Carbon::now();
            DB::table('expenses')->where('id','=',$id)
                                ->update([
                                    'category_id' => $category,
                                    'description' => $description,
                                    'amount' => $amount,
                                    'created_at' => $fullDate,
                                    'updated_at' => $update
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
            $date = $request -> input('date') ?? Carbon::now();
            DB::table('expenses')->insert([
                                    'category_id' => $category,
                                    'description' => $description,
                                    'amount' => $amount,
                                    'created_at' => $date
                                ]);
            return redirect()->route('expense')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('expense')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }
}
