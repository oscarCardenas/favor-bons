<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddres extends Model
{
    use HasFactory;

    protected $table = 'billing_addres';

    protected $primaryKey = 'id';

}
