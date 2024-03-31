<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected $fillable = ['read', 'pick', 'warpcount', 'weftcount', 'width', 'nameofyarn', 'quality'];
}
