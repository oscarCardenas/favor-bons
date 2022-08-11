<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;
use App\Models\UserProfile;
use App\Models\InterestCategory;

use DB;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register',['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
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
    
            $p = new UserProfile();
            $p->user_id = $user->id;
            $p->save();

            $cat = $input['interest_categories'];
            foreach ($cat as $v) {
                $int = new InterestCategory();
                $int->user_id = $user->id;
                $int->category_id = $v;
                $int->save();
            }
            DB::commit();

            Auth::login($user);
            return Redirect::route('public.index');
        } catch (\Throwable $th) {
            // \Log::info($th);
            DB::rollBack();
            return redirect()->back()->withErrors(['name' => 'Internal Server Error.']);
        }
    }

}
