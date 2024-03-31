<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suitsale extends Model
{
    use HasFactory;
    protected $table = 'suitsale';
    protected $fillable = [
        'purchaser',
        'variety',
        'price',
        'meter',
        'totalPrice',
        'thaanMeter',
        'totalThaan',
        'billid',
        'addby',
    ];
}
