<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFocus extends Model
{
    use HasFactory;
    protected $guarded;

    public function subcat_child(){
        return $this->belongsTo(SubcatChild::class);
    }

    //New
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
