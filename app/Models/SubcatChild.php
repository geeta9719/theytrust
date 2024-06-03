<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcatChild extends Model
{
    use HasFactory;
    protected $guarded;

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function add_focus(){
        return $this->hasMany(AddFocus::class);
    }

    public function skill()
    {
        return $this->hasMany(Skill::class);
    }
}
