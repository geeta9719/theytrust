<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description', 'limit', 'type', 'plan_id'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
