<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded;

    public function company()
    {
        return $this->belongsTo( Company::class );
    }

    public function country()
    {
        return $this->belongsTo( Country::class,'country_iso2', 'iso2' );
    }

    public function state()
    {
        return $this->belongsTo( State::class,'state_iso2', 'iso2' );
    }

}
