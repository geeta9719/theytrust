<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function service_line(){
        return $this->hasMany(Serviceline::class);
    }

    public function add_focus(){
        return $this->hasMany(AddFocus::class);
    }

    public function subcat_child(){
        return $this->hasMany(SubcatChild::class);
    }

    public function company_review(){
        return $this->belongsTo(CompanyReview::class,'project_type');
    }
}
