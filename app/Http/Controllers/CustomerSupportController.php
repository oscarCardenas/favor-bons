<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\CustomerSupport;

use App\Mail\SendCustomerSupport;

use Mail;
use Log;
use DB;

class CustomerSupportController extends Controller
{

    public function show(Request $request)
    {
        return Inertia::render('Support/Show');
    }

    public function store(Request $request)
    {
        $d = $request->all();
        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email', 'max:255'],
            'message' => 'required',
        ]);
            
        CustomerSupport::create([
            'user_id' => (Auth::check()) ? Auth::id() : null,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ]);

        Mail::to(env('MAIL_TO_SUPPORT'))->send(
            new SendCustomerSupport($d)
        );

        return Redirect::route('support.show');       
    }

}
