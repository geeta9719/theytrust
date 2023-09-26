<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSize extends Model
{
    use HasFactory;
    protected $guarded;

    public function add_client_size(){
        return $this->hasMany(AddClientSize::class);
    }
}
