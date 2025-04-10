<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyHasSkill extends Model
{
    protected $table = 'companyhasskill';

    protected $fillable = [
        'company_id',
        'skill_id',
    ];

    // Define relationships if needed
    // For example:
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
