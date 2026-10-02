<?php
// database/migrations/xxxx_xx_xx_create_about_stats_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_stats', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value'); // "5000+", "50+", etc.
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_stats');
    }
};