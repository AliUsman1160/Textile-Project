<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabrictosuit extends Model
{
    use HasFactory;
    protected $table = "fabrictosuits";
    protected $fillable = ['quality', 'sendtodyeing', 'cost', 'reject', 'pass', 'varity', 'addby'];
}
