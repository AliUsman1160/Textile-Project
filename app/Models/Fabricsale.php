<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricsale extends Model
{
    use HasFactory;
    // protected $table ="fabricsal";
    protected $fillable = [
       'quality',
       'meter',
        'weight',
        'price_per_meter',
        'purchaser',
        'total_price',
        'received_price',
        'panding_price',
        'paymentStatus',
        'addby',
    ];
}
