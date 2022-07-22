<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\CreditCard;

use Log;
use DB;

class CreditCardController extends Controller
{
    
    public function index(Request $request)
    {
        return CreditCard::where('user_id',Auth::id())->orderBy('default_payment','asc')->get();
    }

    public function store(Request $request){
        $request->validate([
            'full_name' => 'required',
            'card_number' => 'required',
            'exp_date' => 'required',
            'cvc' => 'required'
        ]);

        $exists = CreditCard::where('user_id',Auth::id())->where('card_number', $request->input('card_number'))->count();
        if($exists > 0)
            return redirect()->back()->withErrors(['card_number' => 'the card number is already registered.']);
        
        if($request->input('default_payment') == true)
            CreditCard::where('user_id',Auth::id())->update(['default_payment' => null]);
        
        $c = new CreditCard();
        $c->user_id = Auth::id();
        $c->full_name = $request->input('full_name');
        $c->card_number = $request->input('card_number');
        $c->exp_date = $request->input('exp_date');
        $c->cvc = $request->input('cvc');
        $c->default_payment = $request->input('default_payment');
        $c->save();

        return Redirect::route('profile.show');
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'exp_date' => 'required'
        ]);
        
        if($request->input('default_payment') == true)
            CreditCard::where('user_id',Auth::id())->update(['default_payment' => null]);

        $c = CreditCard::where('user_id',Auth::id())->where('id',$request->input('id'))->first();        
        if($c){
            $c->full_name = $request->input('full_name');
            $c->exp_date = $request->input('exp_date');
            $c->default_payment = $request->input('default_payment');
            $c->save();
        }            

        return Redirect::route('profile.show');       
    }

    public function activate(Request $request){
        CreditCard::where('user_id',Auth::id())->update(['default_payment' => null]);

        CreditCard::where('user_id',Auth::id())->where('id',$request->input('id'))->update(['default_payment' => true]);

        return CreditCard::where('user_id',Auth::id())->orderBy('default_payment','asc')->get();
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'password' => 'The password is incorrect.'
            ]);
        }

        CreditCard::where('user_id', Auth::id())->where('id',$request->input('id'))->delete();

        return Redirect::route('profile.show');
    }

}
