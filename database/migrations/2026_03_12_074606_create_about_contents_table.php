<?php
// database/migrations/xxxx_xx_xx_create_about_contents_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section')->unique(); // 'vision', 'mission', 'hero'
            $table->string('title');
            $table->text('content')->nullable();
            $table->text('subtitle')->nullable(); // Pour le hero
            $table->string('icon')->nullable(); // Pour stocker le nom de l'icône
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_contents');
    }
};