<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricInventory extends Model
{
    use HasFactory;
    protected $table = "fabricinventory";
    protected $fillable = [
        'quality',
        'meter',
    ];
}
