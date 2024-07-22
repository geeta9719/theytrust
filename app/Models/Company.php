<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyHasProject;
use App\Models\CompanySubcatChild;
use App\Models\CompanyHasSkill;





class Company extends Model
{
    use HasFactory;

    protected $guarded;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function serviceLine(){
        return $this->hasMany(ServiceLine::class);
    }
    public function addIndustry(){
        return $this->hasMany(AddIndustry::class);
    }
    public function clientSize(){
        return $this->hasMany(ClientSize::class);
    }
    public function specialization(){
        return $this->hasMany(ClientSize::class);
    }

    public function address(){
        return $this->hasMany(Address::class);
    }

    public function admin_info(){
        return $this->belongsTo(AdminInfo::class);
    }

    public function companyReview(){
        return $this->hasMany(CompanyReview::class);
    }

    public function rate(){
        return $this->hasOne(Rate::class,'rate');
    }
    public function size(){
        return $this->hasOne(Size::class,'size');
    }
    public function budget(){
        return $this->hasOne(Budget::class,'budget');
    }

    public function projects()
    {
        return $this->hasMany(CompanyHasProject::class, 'company_id');
    }

    public function CompanySubcatChild(){
        return $this->hasMany(CompanySubcatChild::class);
    }

    public function getLogoAttribute($value){
        if(!empty($value)){
            if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE){
                return $value;
            }
            return asset('storage/' .$value); 
        }else{
            return $value;
        }

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


}
