<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

use App\Models\User;
use App\Models\Category;
use App\Models\InterestCategory;

use Request;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register',['categories' => Category::all()]);
    }

    public function store()
    {
        $input = Request::all();
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'interest_categories' => ['required'],
            'terms' => ['accepted', 'required'],
        ])->validate();
        
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $cat = $input['interest_categories'];
        foreach ($cat as $v) {
            $int = new InterestCategory();
            $int->user_id = $user->id;
            $int->category_id = $v;
            $int->save();
        }
        
        Auth::login($user);
        if (Auth::check()) 
            return Redirect::route('dashboard');

        return Redirect::route('public.index');
    }

}
