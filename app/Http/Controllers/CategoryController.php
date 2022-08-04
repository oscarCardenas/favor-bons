<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

use App\Models\Category;
use App\Models\FavorBond;

use Log;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Category/Index',[
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    public function show(Request $request)
    {
        //
    }

    public function create(Request $request)
    {
        //
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]); 
        Category::saveCategory($request->all());                    
        return Redirect::route('categories.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Category::saveCategory($request->all());                                        
        return Redirect::route('categories.index');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'The password is incorrect.']);
        }
                
        $valid = Category::checkCategoriesOfFavor($request->input('id'));
        if($valid > 0)
            return redirect()->back()->withErrors(['password' => 'Sorry, this category has associated favorbonds.']);
        
        Category::where('id',$request->input('id'))->delete();

        return Redirect::route('categories.index');
    }

    public function public(Request $request)
    {
        return Inertia::render('Category/Public',[
            'favorbonds' => FavorBond::getFavorBonds($request->input('category_id'),null), 
            'categories' => Category::where('status',1)->get(),
            'category_id' => $request->input('category_id')
        ]);
    }

}
