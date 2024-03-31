<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yarntofabric extends Model
{
    use HasFactory;
    protected $table = "yarntofabrics";
    protected $fillable = [
        'delivery_date',
        'contractee',
        'broker',
        'quality',
        'order_meter',
        'rate_per_meter',
        'warp_yarn_count',
        'weft_yarn_count',
        'warp_rate',
        'weft_rate',
        'warpthread',
        'weftthread',
        'conv_pick',
        'conv_meter',
        'gst',
        'warp_weight_per_meter',
        'weft_weight_per_meter',
        'required_warp_bags',
        'required_weft_bags',
        'total_required_bags',
        'payment',
        'payment_include_gst',
        'send_bags',
        'due_bags',
        'delivery_instruction',
        'payment_instruction',
        'quality_instruction',
        'other_instruction',
        'addby',
        'yarnbrand',
        'yarncones',
        'yarncount',
        'yarntype',
    ];
}
