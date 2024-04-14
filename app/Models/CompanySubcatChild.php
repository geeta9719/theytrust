<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CompanySubcatChild extends Model
{
    protected $table = 'company_subcat_child';

    protected $fillable = ['company_id', 'subcat_child_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function subcatChild()
    {
        return $this->belongsTo(SubcatChild::class);
    }

    // public function CompanySubcatChild(){
    //     return $this->hasMany(CompanySubcatChild::class);
    // }
}
