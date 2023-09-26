<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $guarded;

    public function companyReview(){
        return $this->belongsTo(CompanyReview::class,'company_size');
    }
    public function company(){
        return $this->belongsTo(Company::class,'size');
    }
}
