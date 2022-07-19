<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Models\ActiveCampaign;
use App\Models\Category;

use App\Mail\SendActiveCampaign;

use Log;
use Mail;

class ActiveCampaignController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        
        ActiveCampaign::create(['email' => $request->input('email')]);

        Mail::to(env('MAIL_TO_ADMIN'))->send(
            new SendActiveCampaign($request->input('email'))
        );

        return Redirect::route('public.index');
    }
}
