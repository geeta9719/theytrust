<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyHasProject extends Model
{


  public  $table= 'campany_has_projects';
    protected $fillable = [
        'company_id',
        'title',
        'thumbnail_image',
        'services_id',
        'project_size',
        'description',
        'uploaded_image',
        'youtube_video'
    ];
}
