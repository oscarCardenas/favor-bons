<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;

use Auth;


class HomeController extends Controller
{
    
    public function themeUpdate(Request $request)
    {
        $user = User::find(Auth::id());
        $user->theme = $request->input('theme');
        $user->save();
        return Redirect::route('profile.show');
    }

}
