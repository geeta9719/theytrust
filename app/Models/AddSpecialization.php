<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddSpecialization extends Model
{
    use HasFactory;
    protected $guarded;

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }
}
