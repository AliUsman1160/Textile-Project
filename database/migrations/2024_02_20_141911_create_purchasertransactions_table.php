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
        Schema::create('purchasertransactions', function (Blueprint $table) {
            $table->id();
            $table->string('purchaser');
            $table->decimal('debt', 10, 2);
            $table->decimal('credit', 10, 2);
            $table->decimal('pending', 10, 2);
            $table->string('note')->nullable();
            $table->string('addby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasertransactions');
    }
};
