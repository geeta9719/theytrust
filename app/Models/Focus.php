<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Focus extends Model
{
    use HasFactory;
    protected $guarded;

    public function focus_child(){
        return $this->hasMany(FocusChild::class);
    }

    public function add_focus(){
        return $this->hasMany(AddFocus::class);
    }
}
