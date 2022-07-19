<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;

    protected $table = 'customers_support';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'message'
    ];

}
