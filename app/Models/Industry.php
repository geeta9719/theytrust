<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;
    protected $guarded;

    public function add_industry(){
        return $this->hasMany(AddIndustry::class);
    }
}
