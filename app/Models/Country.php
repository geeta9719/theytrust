<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function state(){
        return $this->hasMany(state::class,'country_code','iso2');
    }

    public function city(){
        return $this->hasMany(City::class,'country_code','iso2');
    }

    public function address(){
        return $this->hasMany(Address::class,'country_iso2', 'iso2');
    }
}
