<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

use App\Models\User;
use App\Models\Profile;

class AuthenticatedAdminSessionController extends Controller
{
    public function create(Request $request)
    {
        return (Auth::check()) ? Redirect::route('public.index') : Inertia::render('Auth/LoginAdmin');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Validator::make($input, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        
        $user = User::searchUser($input['email'],Profile::ADMIN);
        if($user){
            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $input['remember'])) {
                session(['profile' => $user]);
                $request->session()->regenerate();
                return Redirect::route('public.index');
            }
        }
 
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
        
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('profile');
        return redirect('/');
    }

}
