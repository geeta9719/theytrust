<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $guarded;

    public function add_specialization(){
        return $this->hasMany(AddSpecialization::class);
    }
}
