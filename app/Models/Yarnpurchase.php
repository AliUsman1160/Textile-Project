<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yarnpurchase extends Model
{
    protected $fillable = [
        'bag',
        'cones',
        'count',
        'type',
        'brand',
        'supplier',
        'price_bag',
        'broker',
        'total_price',
        'pay_price',
        'panding_price',
        'payment_status',
        'addby',
    ];
}
