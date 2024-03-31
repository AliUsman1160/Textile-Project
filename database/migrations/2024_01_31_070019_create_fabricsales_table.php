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
        Schema::create('fabricsales', function (Blueprint $table) {
            $table->id();
            $table->string('quality');
            $table->float('meter');
            $table->float('weight');
            $table->float('price_per_meter');
            $table->string('purchaser');
            $table->double('total_price');
            $table->double('received_price');
            $table->double('panding_price');

            $table->string('paymentStatus');
            $table->string('addby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabricsales');
    }
};
