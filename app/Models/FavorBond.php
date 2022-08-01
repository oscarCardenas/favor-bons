<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class FavorBond extends Model
{
    use HasFactory;

    protected $table = 'favorbonds';
    protected $primaryKey = 'id';
    
    public static function getFavorBonds($categoryId,$r=[]){
        $res = self::select('categories.name','favorbonds.title','favorbonds.description','favorbonds.price','favorbonds.updated_at')
            ->join('subcategories','favorbonds.subcategory_id','=','subcategories.id') 
            ->join('categories','subcategories.category_id','=','categories.id') 
            ->where('favorbonds.status',1)
            ->where('categories.status',1)
            ->where('subcategories.status',1)
            ->orderBy('categories.name')
            ->orderBy('favorbonds.title');

        if($categoryId)
            $res->where('categories.id',$categoryId);

        foreach ($res->get() as $k => $v) {
            $r[$k] = json_decode($v,true);
            $r[$k]['updated_at'] = Carbon::parse($v->updated_at)->format('d-m-Y H:i');
        }
        
        return $r;
    }

    public static function getUserFavorBonds( $userId ) {
        return self::where('user_id', $userId);
    }

}
