<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suitpurchase extends Model
{
    protected $fillable = [
        "variety",
        "meter",
        'price',
        'pay_price',
        'panding_price',
        'supplier',
        'payment_status',
    ];
}
