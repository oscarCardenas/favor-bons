<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavorBond extends Model
{
    use HasFactory;

    protected $table = 'favorbonds';
    protected $primaryKey = 'id';
    
    public static function getFavorBonds($id){
        $r = self::select('favorbonds.title','favorbonds.description','categories.name','favorbonds.price','favorbonds.updated_at')
            ->join('subcategories','favorbonds.subcategory_id','=','subcategories.id') 
            ->join('categories','subcategories.category_id','=','categories.id') 
            ->where('favorbonds.status',1)
            ->where('categories.status',1)
            ->where('subcategories.status',1);

        if($id)
            $r->where('categories.id',$id);

        return $r->get();
    }

}
