<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaserTransaction extends Model
{
    use HasFactory;
    protected $table = "purchasertransactions";
    protected $fillable = [
        'purchaser',
        'debt',
        'credit',
        'pending',
        'note',
        'addby',
    ];
}
