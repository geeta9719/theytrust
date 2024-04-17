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
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function service_line(){
        return $this->hasMany(Serviceline::class);
    }

    public function add_focus(){
        return $this->hasMany(AddFocus::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function subcat_child(){
        return $this->belongsTo(SubcatChild::class, 'subcat_child_id');
    }

    public function company_review(){
        return $this->belongsTo(CompanyReview::class,'project_type');
    }
}
