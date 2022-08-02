<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\Category;
use App\Models\FavorBond;
use App\Models\Subcategory;

use Log;

class SubCategoryController extends Controller
{

    public function index(Request $request)
    {
        //
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }

    public function public(Request $request)
    {
        return Inertia::render('Subcategory/Index',[
            'favorbonds' => FavorBond::getFavorBonds(null,$request->input('subcategory_id')), 
            'categories' => Category::getCategories(),
            'subcategory_id' => $request->input('subcategory_id')
        ]);
    }

}
