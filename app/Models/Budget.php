<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $guarded;

    public function company_review(){
        return $this->belongsTo(CompanyReview::class,'cost_range');
    }

    public function company(){
        return $this->belongsTo(Company::class,'budget');
    }
}
