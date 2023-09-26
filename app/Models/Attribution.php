<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;

    protected $guarded;

    public function companyReview(){
        return $this->belongsTo(CompanyReview::class,'Attribution');
    }
}
