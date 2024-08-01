<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelReference extends Model
{
    use HasFactory;

    protected $fillable = ['model_name', 'foreign_key_id', 'foreign_key_name', 'company_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'foreign_key_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'foreign_key_id');
    }

    public function SubcatChild()
    {
        return $this->belongsTo(SubcatChild::class, 'foreign_key_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'foreign_key_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}