<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FocusChild extends Model
{
    use HasFactory;
    protected $guarded;

    public function focus(){
        return $this->belongsTo(Focus::class);
    }

    public function add_focus(){
        return $this->hasMany(AddFocus::class);
    }
}
