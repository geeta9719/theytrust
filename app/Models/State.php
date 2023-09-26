<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function country(){
        return $this->belongsTo(Country::class,'country_code','iso2');
    }

    public function city(){
        return $this->hasMany(City::class,'state_code','iso2');
    }

    public function address(){
        return $this->hasMany(Address::class,'state_iso2', 'iso2');
    }
}
