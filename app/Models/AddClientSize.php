<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddClientSize extends Model
{
    use HasFactory;
    protected $guarded;

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function client_size(){
        return $this->belongsTo(ClientSize::class);
    }
}
