<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // NOTE: funciones para categorias
    public function index(){
        $categories = Category::orderBy('typeCategory','desc')
                                ->orderBy('name','asc')
                                ->paginate(10);
        $count = $categories->total();
        return view('categories.index',[
            'table' => $categories,
            'count' => $count
        ]);
    }

    public function create(){
        return view('categories.create');
    }

    public function delete($id){
        try {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('category')
                            ->with('status', 'Se elimino correctamente');
        } catch (\Exception $e) {
            return redirect()->route('category')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $edit = Category::find($id);
        return view('categories.create',[
            'edit' => $edit
        ]);
    }

    public function update(Request $request){
        try {
            $id = $request -> input('id');
            $name = $request -> input('name');
            $description = $request -> input('description');
            $typeCategory = $request -> input('typeCategory');
            $color = $request -> input('color');

            $category = Category::find($id);
            $category->update([
                'name' => $name,
                'description' => $description,
                'typeCategory' => $typeCategory,
                'color' => $color
            ]);
            return redirect()->route('category')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('category')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function save(Request $request){
        try {
            Category::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'typeCategory' => $request->input('typeCategory'),
                'color' => $request->input('color')
            ]);
            return redirect()->route('category')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('category')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }
}
