<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Auth;
use Carbon\Carbon;

class CreditCard extends Model
{
    use HasFactory;

    protected $table = 'credit_cards';

    protected $primaryKey = 'id';

    protected $hidden = [
        'cvc'
    ];

    public static function getCreditCard($r = []){
        $res = self::where('user_id',Auth::id())->orderBy('default_payment','asc')->get();
        foreach ($res as $k => $v) {
            $r[$k] = json_decode($v,true);

            $card_number = self::decrypt($v->card_number);            
            $mont = Carbon::parse($v->exp_date)->format('m');
            $year = Carbon::parse($v->exp_date)->format('Y');
            $r[$k]['mont'] = $mont;
            $r[$k]['year'] = $year;
            $r[$k]['card_number'] = substr($card_number, -4, 4);
            $r[$k]['exp_date'] = ['month' => ($mont - 1), 'year' => $year ];
        }

        return $r;
    }

    public static function formatExpireDate($date){
        return Carbon::parse($date['year'] .'-'. ($date['month'] + 1) . '-01')->format('Y-m-d');
    }

    public static function encrypt($d)
    {
        return Crypt::encryptString($d);     
    }

    public static function decrypt($d){
        try {
            return Crypt::decryptString($d);
        } catch (DecryptException $e) {
            // \Log::info($e);
        }
        return;
    }

}
