<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

use App\Models\Category;
use App\Models\User;

class PublicController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Public/Index',['categories' => Category::all()]);
    }

    // public function categories()
    // {
    //     return ['categories' => Category::all()];
    // }

}
