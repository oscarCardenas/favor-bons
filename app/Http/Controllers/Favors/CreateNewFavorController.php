<?php

namespace App\Http\Controllers\Favors;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\FavorBond;
use App\Models\Category;
use App\Models\ExecutionOfFavor;

use Auth;

class CreateNewFavorController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $categories = Category::getCategories();
        $executionTypes = ExecutionOfFavor::all();
        return Inertia::render('Favors/CreateFavors', [ 
            'categories' => $categories,
            'executionTypes' => $executionTypes
            ] );
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {

        $input = Request::all();

        $favorBond = FavorBond::create([
            'subcategory_id' => 1,
            'user_id' => Auth::id(),
            'title' => $input['title'],
            'description' => $input['description'],
            'qualified_description' => $input['qualified_description'],
            'price' => $input['price'],
            'price_description' => $input['price_description'],
            'execution_of_favor_id' => 1,
            'unlimited' => true,
            'stock' => $input['stock']                       
        ]);        
        
        $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

        $favorBond->image = $response;

        return redirect(RouteServiceProvider::HOME);
    }
}
