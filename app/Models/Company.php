<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded;
    
    /**
     * Attributes to append to model's JSON form
     * This ensures logo_url is always included in API responses
     */
    protected $appends = ['logo_url'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function serviceLine()
    {
        return $this->hasMany(ServiceLine::class);
    }
    public function addIndustry()
    {
        return $this->hasMany(AddIndustry::class);
    }
    public function clientSize()
    {
        return $this->hasMany(ClientSize::class);
    }
    public function specialization()
    {
        return $this->hasMany(ClientSize::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function admin_info()
    {
        return $this->belongsTo(AdminInfo::class);
    }

    public function companyReview()
    {
        return $this->hasMany(CompanyReview::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class, 'rate');
    }
    public function size()
    {
        return $this->hasOne(Size::class, 'size');
    }
    public function budget()
    {
        return $this->hasOne(Budget::class, 'budget');
    }

    public function projects()
    {
        return $this->hasMany(CompanyHasProject::class, 'company_id');
    }

    public function CompanySubcatChild()
    {
        return $this->hasMany(CompanySubcatChild::class);
    }

    public function getLogoAttribute($value)
    {
        if (!empty($value)) {
            // Check if it's already a full URL (from C panel)
            if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false) {
                return $value;
            }
            // Otherwise, treat it as a storage path
            return asset('storage/' . $value);
        }
        return $value;
    }

    /**
     * Accessor for logo_url attribute
     * This will be automatically included in JSON responses
     */
    public function getLogoUrlAttribute()
    {
        return $this->getLogoUrl();
    }

    /**
     * Helper method to get logo for display
     * Handles both Azure Storage URLs and local storage paths
     */
    public function getLogoUrl()
    {
        if (empty($this->attributes['logo'])) {
            return asset('img/default-logo.png');
        }

        $logo = $this->attributes['logo'];

        // If it's already a full Azure URL, return it directly
        if (strpos($logo, 'https://') === 0 || strpos($logo, 'http://') === 0) {
            return $logo;
        }

        // If it's a blob storage path from Azure
        if (!empty($logo)) {
            $azureAccount = env('AZURE_STORAGE_ACCOUNT');
            $container = env('AZURE_STORAGE_CONTAINER');
            
            // Construct the full Azure Blob Storage URL
            // Format: https://accountname.blob.core.windows.net/container/path
            if ($azureAccount && $container) {
                return "https://{$azureAccount}.blob.core.windows.net/{$container}/{$logo}";
            }
        }

        // Fallback to default
        return asset('img/default-logo.png');
    }

    // New
    public function serviceLines()
    {
        return $this->hasMany(ServiceLine::class);
    }

    public function addFocus()
    {
        return $this->hasMany(AddFocus::class);
    }

    public function deepskill()
    {
        return $this->hasMany(CompanyHasSkill::class);
    }

    public function modelReferences()
    {
        return $this->hasMany(ModelReference::class);
    }

    public function sponces()
    {
        return $this->hasMany(Sponce::class, 'company_id');
    }
}
