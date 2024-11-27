<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'weight_id',
        'count',
        'points',
        'weighted_points',
    ];

    // Relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relationship with the Weight model
    public function weight()
    {
        return $this->belongsTo(Weight::class);
    }
}
