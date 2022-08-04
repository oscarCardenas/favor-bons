<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $primaryKey = 'id';

    public function favorBond()
    {
        return $this->hasMany(FavorBond::class, 'subcategory_id', 'id');
    }

    public static function checkSubCategoriesOfFavor($subcategoryId){
        return FavorBond::whereIn('subcategory_id',$subcategoryId)->count();        
    }

    public static function saveSubcategory($d){
        
        $valid = self::where('name',$d['name']);
        if($d['id'] > 0){  
            $valid = $valid->whereNot('id',$d['id'])->count();            
            $c = self::findOrFail($d['id']);  
        }else{
            $valid = $valid->count();            
            $c = new self();
        }
        
        if($valid > 0)
            return redirect()->back()->withErrors(['name' => 'Sorry, this name is registered.']);
        
        $c->category_id = $d['category_id'];
        $c->name = Category::formatTitle(trim($d['name']));
        $c->description = ($d['description']) ? ucfirst(strtolower($d['description'])) : null;
        $c->save();

        return;
    }
}
