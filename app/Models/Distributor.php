<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    public function client(){
        return $this->hasMany(Client::class,'assigned_to','id');
    }
}
