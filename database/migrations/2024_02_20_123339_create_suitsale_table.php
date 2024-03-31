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
        Schema::create('suitsale', function (Blueprint $table) {
            $table->id();
            $table->string('purchaser');
            $table->string('variety');
            $table->integer('price');
            $table->integer('meter');
            $table->double('totalPrice');
            $table->integer('thaanMeter');
            $table->integer('totalThaan');
            $table->string('billid'); // Additional field
            $table->string('addby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suitsale');
    }
};
