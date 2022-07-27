<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestCategory extends Model
{
    use HasFactory;

    protected $table = 'interest_categories';
    protected $primaryKey = 'id';
    
}
