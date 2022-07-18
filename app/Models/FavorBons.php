<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavorBons extends Model
{
    use HasFactory;

    protected $table = 'favor_bons';
    protected $primaryKey = 'id';
    
}
