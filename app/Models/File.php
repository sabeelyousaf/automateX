<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'hv_code',
        'form_no',
        'id_no',
        'security_no',
        'file_status',
        'type',
        'size',
        'unit',
        'total_amount',
        'file_location',
    ];

    public function dealer(){
        return $this->belongsTo(Distributor::class,'distributor_id','id');
    }
    public function ledger(){
        return $this->hasMany(Ledger::class,'file_id','id');
    }

}
