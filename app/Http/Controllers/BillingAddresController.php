<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\BillingAddres;

use Log;
use DB;

class BillingAddresController extends Controller
{
    
    public function index(Request $request)
    {
        return BillingAddres::where('user_id',Auth::id())->orderBy('default_billing','asc')->get();
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'shipping_address' => 'required',
            'billing_address' => 'required',
        ]);

        $BillingFromUser = BillingAddres::where('user_id',Auth::id())->count();

        $exists = BillingAddres::where('user_id',Auth::id())->where('shipping_address', $request->input('shipping_address'))->count();
        if($exists > 0)
            return redirect()->back()->withErrors(['shipping_address' => 'the shipping address is already registered.']);
        
        if($request->input('default_billing') == true)
            BillingAddres::where('user_id',Auth::id())->update(['default_billing' => null]);
        
        $c = new BillingAddres();
        $c->user_id = Auth::id();
        $c->first_name = $request->input('first_name');
        $c->last_name = $request->input('last_name');
        $c->email_address = $request->input('email_address');
        $c->phone_number = $request->input('phone_number');
        $c->shipping_address = $request->input('shipping_address');
        $c->billing_address = $request->input('billing_address');
        $c->default_billing = ($BillingFromUser == 0) ? true : $request->input('default_billing');
        $c->save();

        return Redirect::route('profile.show');
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'shipping_address' => 'required',
            'billing_address' => 'required',
        ]);
        
        if($request->input('default_billing') == true)
            BillingAddres::where('user_id',Auth::id())->update(['default_billing' => null]);

        $c = BillingAddres::where('user_id',Auth::id())->where('id',$request->input('id'))->first();        
        if($c){
            $c->first_name = $request->input('first_name');
            $c->last_name = $request->input('last_name');
            $c->email_address = $request->input('email_address');
            $c->phone_number = $request->input('phone_number');
            $c->shipping_address = $request->input('shipping_address');
            $c->billing_address = $request->input('billing_address');
            $c->default_billing = $request->input('default_billing');
            $c->save();
        }            

        return Redirect::route('profile.show');       
    }

    public function activate(Request $request){
        BillingAddres::where('user_id',Auth::id())->update(['default_billing' => null]);

        BillingAddres::where('user_id',Auth::id())->where('id',$request->input('id'))->update(['default_billing' => true]);

        return BillingAddres::where('user_id',Auth::id())->orderBy('default_billing','asc')->get();
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'password' => 'The password is incorrect.'
            ]);
        }

        BillingAddres::where('user_id', Auth::id())->where('id',$request->input('id'))->delete();

        return Redirect::route('profile.show');
    }

}
