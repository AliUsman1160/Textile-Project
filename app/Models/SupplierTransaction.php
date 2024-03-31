<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTransaction extends Model
{
    use HasFactory;
    protected $table = "suppliertransactions";
    protected $fillable = [
        'supplier',
        'debt',
        'pay',
        'pending',
        'note',
        'addby',
    ];
}
