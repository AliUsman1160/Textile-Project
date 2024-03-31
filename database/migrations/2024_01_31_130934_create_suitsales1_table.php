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
        Schema::create('suitsales', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string('type');
            $table->string('color');
            $table->double('price');
            $table->double('received_price');
            $table->double('panding_price');
            $table->string('purchaser');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suitsales');
    }
};
