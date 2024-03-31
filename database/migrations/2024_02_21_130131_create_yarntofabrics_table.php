<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('yarntofabrics', function (Blueprint $table) {
            $table->id();
            $table->date('delivery_date');
            $table->string('contractee');
            $table->string('broker');
            $table->string('quality');
            $table->integer('order_meter');
            $table->float('rate_per_meter');
            $table->float('warp_yarn_count');
            $table->float('weft_yarn_count');
            $table->float('warp_rate');
            $table->float('weft_rate');
            $table->string('warpthread');
            $table->string('weftthread');
            $table->float('conv_pick');
            $table->float('conv_meter');
            $table->float('gst');
            $table->float('warp_weight_per_meter');
            $table->float('weft_weight_per_meter');
            $table->float('required_warp_bags');
            $table->float('required_weft_bags');
            $table->float('total_required_bags');
            $table->double('payment');
            $table->double('payment_include_gst');
            $table->integer('send_bags');
            $table->float('due_bags');
            $table->text('delivery_instruction')->nullable();
            $table->text('payment_instruction')->nullable();
            $table->text('quality_instruction')->nullable();
            $table->text('other_instruction')->nullable();
            $table->string('addby')->nullable();
            $table->integer('yarnbrand');
            $table->integer('yarncones');
            $table->integer('yarncount');
            $table->string('yarntype');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yarntofabrics');
    }
};
