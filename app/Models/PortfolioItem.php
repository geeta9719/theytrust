<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'media', 'project_title', 'client_name', 'country_location', 'services_provided', 'short_description', 'engagement_start_date', 'engagement_end_date'
    ];

    protected $casts = [
        'media' => 'array',
        'engagement_start_date' => 'date',
        'engagement_end_date' => 'date',
    ];
    public function getEngagementStartDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getEngagementEndDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
