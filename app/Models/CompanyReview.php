<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;

    protected $guarded;

    protected $fillable = [
        'company_id', 'user_id', 'project_type', 'project_title', 'company_type', 'cost_range',
        'project_start', 'project_end', 'company_position', 'for_what_project', 'how_select',
        'scope_of_work', 'team_composition', 'any_outcomes', 'how_effective', 'most_impressive',
        'area_of_improvements', 'quality', 'quality_review', 'timeliness', 'timeliness_review',
        'cost', 'cost_review', 'communication', 'communication_review', 'expertise',
        'expertise_review', 'ease_of_working', 'ease_of_working_review', 'refer_ability',
        'refer_ability_review', 'overall_rating', 'overall_rating_review', 'full_name',
        'attribution', 'position_title', 'company_name', 'company_size', 'city', 'state', 'country',
        'company_email', 'phone_number', 'linkedin_url', 'company_url', 'status', 'project_summary',
        'feedback_summary', 'published', 'verified', 'verified_by', 'verification_description',
        'comment', 'created_at', 'updated_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attribution()
    {
        return $this->hasOne(Attribution::class, 'Attribution');
    }

    public function size()
    {
        return $this->hasOne(Size::class, 'company_size');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'company_type');
    }

    public function subcategory()
    {
        return $this->hasOne(Subcategory::class, 'project_type');
    }

    public function budget()
    {
        return $this->hasOne(Budget::class, 'cost_range');
    }
}
