<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;

    protected $guarded;

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attribution(){
        return $this->hasOne(Attribution::class,'Attribution');
    }

    public function size(){
        return $this->hasOne(Size::class,'company_size');
    }

    public function category(){
        return $this->hasOne(Category::class,'company_type');
    }

    public function subcategory(){
        return $this->hasOne(Subcategory::class,'project_type');
    }

    public function budget(){
        return $this->hasOne(Budget::class,'cost_range');
    }
}
