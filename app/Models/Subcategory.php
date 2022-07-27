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

}
