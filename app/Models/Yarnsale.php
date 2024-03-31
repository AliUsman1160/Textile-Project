<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yarnsale extends Model
{
    use HasFactory;

    protected $table = 'yarnsales';

    protected $fillable = [
        'bag',
        'cones',
        'count',
        'type',
        'brand',
        'purchaser',
        'price_bag',
        'broker',
        'total_price',
        'received_price',
        'panding_price',
        'payment_status',
        'addby',
    ];
}
