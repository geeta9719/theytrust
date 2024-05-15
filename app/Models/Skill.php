<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'subcat_child_id',
        'skill',
        'name',
        
    ];


    public function subcat_child(){
        return $this->belongsTo(SubcatChild::class, 'subcat_child_id');
    }

}
