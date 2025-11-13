<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    // NOTE: funciones para ingresos
    
    public function index(){
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $revenues = Revenue::whereMonth('created_at','=',$month)
                    ->whereYear('created_at','=',$year)
                    ->orderBy('created_at','desc')
                    ->paginate(10);
        $count = $revenues->total();
        return view('revenues.index',[
            'table' => $revenues,
            'count' => $count
        ]);
    }

    public function create(){
        $categories = Category::where('typeCategory', 2)->get(); // NOTE: Nos traemos datos de la tabla categorias
        return view('revenues.create',[
            'categories' => $categories // NOTE: estos datos son para cargar el select de categorias
        ]);
    }

    public function delete($id){
        try {
            $revenue = Revenue::find($id);
            $revenue->delete();
            return redirect()->route('revenue')
                            ->with('status', 'Se elimino correctamente');
        } catch (\Exception $e) {
            return redirect()->route('revenue')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $categories = Category::where('typeCategory', 2)->get(); // NOTE: Nos traemos datos de la tabla categorias
        $edit = Revenue::find($id);
        return view('revenues.create',[
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

            $revenue = Revenue::find($id);
            $revenue->update([
                        'category_id' => $category, 
                        'description' => $description,
                        'amount' => $amount,
                        'created_at' => $fullDate
                    ]);
            return redirect()->route('revenue')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('revenue')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function save(Request $request){
        try {
            $description = $request -> input('description');
            $amount = $request -> input('amount');
            $category = $request -> input('category');
            Revenue::create([
                        'category_id' => $category,
                        'description' => $description,
                        'amount' => $amount
                    ]);
            return redirect()->route('revenue')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('revenue')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }
}
