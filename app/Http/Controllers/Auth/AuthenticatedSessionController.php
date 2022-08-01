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

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request)
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Validator::make($input, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        
        $user = User::searchUser($input['email']);
        if($user){
            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $input['remember'])) { 
                session(['profile' => Profile::select('id','name','description')->where('id',1)->first()]);
                $request->session()->regenerate();
                return redirect()->intended('/');            
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
