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
        Schema::create('fabrictosuits', function (Blueprint $table) {
            $table->id();
            $table->string('quality');
            $table->integer('sendtodyeing');
            $table->decimal('cost', 10, 2);
            $table->integer('reject');
            $table->integer('pass');
            $table->string('varity');
            $table->string('addby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabrictosuits');
    }
};
