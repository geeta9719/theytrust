<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'parameter',
        'type',
        'range',
        'points',
        'weight_percentage',
        'slug',
        'identifier',
    ];

    // Generate slug when creating a record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateSlug();
        });
    }

    public function generateSlug()
    {
        // Combine parameter, type, and range to ensure uniqueness
        $baseSlug = strtolower(str_replace(' ', '-', $this->parameter . '-' . ($this->type ?? 'general')));
        if ($this->range) {
            $baseSlug .= '-' . strtolower(str_replace([' ', '.'], '_', $this->range));
        }
        return $baseSlug;
    }

    public function points()
    {
        return $this->hasMany(CompanyPoint::class);
    }
}
