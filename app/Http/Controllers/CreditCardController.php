<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\CreditCard;

use Log;
use DB;

class CreditCardController extends Controller
{

    public function show(Request $request)
    {
        $r['creditcard'] = CreditCard::where('user_id',Auth::id())->where('status',1)->first();
        return $r;
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'card_number' => 'required',
            'exp_date' => 'required',
            'cvc' => 'required',
            'billing_address' => 'required',
        ]);


        $c = CreditCard::where('user_id',Auth::id())->where('status',1)->first();
        if(!$c)
            $c = new CreditCard();
                
        $c->user_id = Auth::id();
        $c->full_name = $request->input('full_name');
        $c->card_number = $request->input('card_number');
        $c->exp_date = $request->input('exp_date');
        $c->cvc = $request->input('cvc');
        $c->billing_address = $request->input('billing_address');
        $c->save();

        return Redirect::route('profile.show');       
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'password' => 'The password is incorrect.'
            ]);
        }
        
        CreditCard::where('user_id',Auth::id())->delete();
        return Redirect::route('profile.show');       
    }
}
