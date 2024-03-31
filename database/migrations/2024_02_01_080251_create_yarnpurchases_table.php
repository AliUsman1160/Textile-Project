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
        Schema::create('yarnpurchases', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->integer('bag');
            $table->integer('cones');
            $table->float('count');
            $table->string('type');
            $table->string('brand');
            $table->string('supplier');
            $table->integer('price_bag'); 
            $table->string('broker');
            $table->double('total_price');
            $table->double('pay_price')->default(0);
            $table->double('panding_price')->default(0);
            $table->string('payment_status');
            $table->string('addby');
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yarnpurchases');
    }
};
