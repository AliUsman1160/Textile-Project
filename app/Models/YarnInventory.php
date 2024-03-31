<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YarnInventory extends Model
{
    use HasFactory;
    protected $table = "yarninventory";
    protected $fillable = ['bag', 'cones', 'count', 'type', 'brand'];
}
