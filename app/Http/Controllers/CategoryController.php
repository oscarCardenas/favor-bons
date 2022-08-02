<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\Category;
use App\Models\FavorBond;

use Log;

class CategoryController extends Controller
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
        return Inertia::render('Category/Index',[
            'favorbonds' => FavorBond::getFavorBonds($request->input('category_id'),null), 
            'categories' => Category::where('status',1)->get(),
            'category_id' => $request->input('category_id')
        ]);
    }

}
