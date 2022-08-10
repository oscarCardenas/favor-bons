<?php

namespace App\Http\Controllers\Favors;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\FavorBond;
use App\Models\Category;
use App\Models\ExecutionOfFavor;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Request;
use Log;

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

        Log::debug($input);
        
        $favorBond = new FavorBond();
        $favorBond->subcategory_id = $input['subCategory'];
        $favorBond->user_id = Auth::id();
        $favorBond->title = $input['title'];
        $favorBond->description = $input['description'];
        $favorBond->qualified_description = $input['qualified_description'];
        $favorBond->price = $input['price'];
        $favorBond->price_description = $input['price_description'];
        $favorBond->execution_of_favor_id = $input['executionType'];
            // 'unlimited' => true,
        $favorBond->stock = $input['stock'];
        
        if( !is_null($input['image']) && !empty($input['image']) ) {
            $response = cloudinary()->upload( $input['image']->getRealPath())->getSecurePath();
            $favorBond->image = $response;
        }
        

        $favorBond->save();                

        return Redirect::route('favors.create', ['id' => 1] );
    }
}
