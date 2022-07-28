<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavorBond extends Model
{
    use HasFactory;

    protected $table = 'favorbonds';
    protected $primaryKey = 'id';
    
    public static function getFavorBonds(){
        return self::select('favorbonds.title','categories.name','favorbonds.price')
        ->join('subcategories','favorbonds.subcategory_id','=','subcategories.id') 
        ->join('categories','subcategories.category_id','=','categories.id') 
        ->where('favorbonds.status',1)
        ->where('categories.status',1)
        ->where('subcategories.status',1)
        ->get();
    }

}
