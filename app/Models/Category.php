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
}
