<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCampaign extends Model
{
    use HasFactory;

    protected $table = 'active_campaigns';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'categories',
    ];

}
