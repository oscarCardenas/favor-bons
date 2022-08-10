<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'profile_photo_url',
    // ];

    public function billingAddres()
    {
        return $this->hasMany(BillingAddres::class, 'user_id', 'id');
    }
    
    public function creditCard()
    {
        return $this->hasMany(CreditCard::class, 'user_id', 'id');
    }
    
    public function favorBond()
    {
        return $this->hasMany(FavorBond::class, 'user_id', 'id');
    }
    
    public function interestCategory()
    {
        return $this->hasMany(InterestCategory::class, 'user_id', 'id');
    }

    public static function searchUser($email,$profileId){
        return self::select('profiles.id','profiles.name','profiles.description')
            ->join('users_profiles', 'users.id', '=', 'users_profiles.user_id')
            ->join('profiles', 'users_profiles.profile_id', '=', 'profiles.id')
            ->where('users.email',$email)
            ->where('users_profiles.profile_id',$profileId)
            ->first();
    }

}
