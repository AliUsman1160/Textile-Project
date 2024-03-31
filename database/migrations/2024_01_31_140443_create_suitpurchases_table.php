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
        Schema::create('suitpurchases', function (Blueprint $table) {
            $table->id();
            $table->string('variety');
            $table->integer('meter');
            $table->double('price');
            $table->double('pay_price');
            $table->double('panding_price');
            $table->string('supplier');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suitpurchases');
    }
};
