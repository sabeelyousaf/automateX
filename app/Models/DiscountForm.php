<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountForm extends Model
{
    use HasFactory;

    protected $fillable=[
        'Tracking_id',
        'Serial_no',
        'security_no',
        'status',
        'face_value',
        'adjusted_value',
    ];
}
