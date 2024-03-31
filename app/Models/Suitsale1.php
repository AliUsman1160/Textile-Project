<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suitsale extends Model
{
    protected $fillable = [
        'quantity',
        'type',
        'color',
        'price',
        'received_price',
        'panding_price',
        'purchaser',
        'payment_status',
    ];
}
