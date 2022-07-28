<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\FavorBond;

use Log;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Category/Index',['favorbonds' => FavorBond::getFavorBonds()]);
    }

}
