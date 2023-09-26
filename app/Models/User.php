<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded;

    /*protected $fillable = [
        'name',
        'email',
        'password',
        'linkedin_id',
    ];*/

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getAvatarAttribute($value){
        if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE || $value == null){
            return $value;
        }
        return asset('storage/' .$value);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function companyReview(){
        return $this->hasMany(companyReview::class);
    }
}
