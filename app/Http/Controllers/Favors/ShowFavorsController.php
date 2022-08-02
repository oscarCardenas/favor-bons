<?php

namespace App\Http\Controllers\Favors;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\FavorBond;
use App\Http\Controllers\Controller;
use Auth;

class ShowFavorsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $favorBonds = FavorBond::all(); 
        return Inertia::render('Favors/ShowFavors',[ 'favorBonds' => $favorBonds]);
    }
}
