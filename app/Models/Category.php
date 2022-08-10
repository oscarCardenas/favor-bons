<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    public function subCategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    public static function getCategories(){
        return self::with(['subCategory' => function($query){
            $query->where('status',1)->orderBy('name');
        }])->where('status',1)->get();
    }

    public static function checkCategoriesOfFavor($categoryId, $ids = []){
        $subcategory = Subcategory::select('id')->where('category_id',$categoryId)->get();
        foreach ($subcategory as $k => $v) {
            $ids[$k] = $v->id;
        }
        
        return Subcategory::checkSubCategoriesOfFavor($ids);       
    }

    public static function saveCategory($d){

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
            
        $c->name = self::formatTitle(trim($d['name']));
        $c->description = ($d['description']) ? ucfirst(strtolower($d['description'])) : null;
        $c->save();

        return;
    }

    public static function formatTitle($title,$r=''){
        $titles = explode(" ", $title);
        foreach ($titles as $v) {
            $r .= ucfirst(strtolower($v)) . ' ';
        }

        return trim($r);
    }

}
