<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

use App\Models\Category;
use App\Models\FavorBond;
use App\Models\Subcategory;

use Log;

class SubCategoryController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Subcategory/Index',[
            'subcategories' => Subcategory::where('category_id',$request->input('category_id'))->orderBy('name')->get(),
            'category_id' => $request->input('category_id')
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
        Subcategory::saveSubcategory($request->all()); 
        return Redirect::route('subcategories.index',['category_id' => $request->input('category_id')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Subcategory::saveSubcategory($request->all());
        return Redirect::route('subcategories.index',['category_id' => $request->input('category_id')]);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password))
            return redirect()->back()->withErrors(['password' => 'The password is incorrect.']);
          
        $valid = Subcategory::checkSubCategoriesOfFavor([$request->input('id')]);
        if($valid > 0)
            return redirect()->back()->withErrors(['password' => 'Sorry, this subcategory has associated favorbonds.']);

        Subcategory::where('id',$request->input('id'))->delete();
        return Redirect::route('subcategories.index',['category_id' => $request->input('category_id')]);
    }

    public function public(Request $request)
    {
        return Inertia::render('Subcategory/Public',[
            'favorbonds' => FavorBond::getFavorBonds(null,$request->input('subcategory_id')), 
            'categories' => Category::getCategories(),
            'subcategory_id' => $request->input('subcategory_id')
        ]);
    }

}
