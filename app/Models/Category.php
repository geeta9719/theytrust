<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded;

    public function subcategory(){
        return $this->hasMany(Subcategory::class);
    }

    public function company_review(){
        return $this->belongsTo(CompanyReview::class,'company_type');
    }

    public function service_line(){
        return $this->hasMany(Serviceline::class);
    }

    // New
    public function serviceLines()
    {
        return $this->hasMany(ServiceLine::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
