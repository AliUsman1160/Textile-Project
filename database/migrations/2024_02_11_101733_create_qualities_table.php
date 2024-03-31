<?php
// database/migrations/xxxx_xx_xx_create_qualities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualitiesTable extends Migration
{
    public function up()
    {
        Schema::create('qualities', function (Blueprint $table) {
            $table->id();
            $table->decimal('read', 8, 2);
            $table->decimal('pick', 8, 2);
            $table->decimal('warpcount', 8, 2);
            $table->decimal('weftcount', 8, 2);
            $table->decimal('width', 8, 2);
            $table->string('nameofyarn');
            $table->string('quality');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualities');
    }
}
