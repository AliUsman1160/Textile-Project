<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricpurchase extends Model
{
    protected $fillable = [
        'quality',
        'meter',
        'weight',
        'price_per_meter',
        'supplier',
        'total_price',
        'pay_price',
        'panding_price',
        'paymentStatus',
        'addby',
    ];
}
