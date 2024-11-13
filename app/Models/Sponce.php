<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Plans\Models\PlanModel;


class Sponce extends Model
{

    use HasFactory;

    protected $fillable = [
        'location_type_model',
        'location_id',
        'category_type_model',
        'category_id',
        'plan_subscription_id',
        'user_id',
        'company_id',
    ];


    public function location()
    {
        return $this->morphTo(__FUNCTION__, 'location_type_model', 'location_id');
    }

    // Polymorphic relationship for category
    public function category()
    {
        return $this->morphTo(__FUNCTION__, 'category_type_model', 'category_id');
    }

    // Relationship with the PlanSubscription model
    public function planSubscription()
    {
        return $this->belongsTo(PlanModel::class, 'plan_subscription_id');
    }

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function sponcer()
    {
        return $this->hasMany(Sponce::class, 'company_id');
    }
    public function getSponcesByType($locationTypeModel, $categoryTypeModel)
    {
        return $this->sponcer()->where('location_type_model', $locationTypeModel)
                               ->where('category_type_model', $categoryTypeModel)
                               ->with(['location', 'category','planSubscription'])
                               ->get();
    }
}
