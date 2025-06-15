<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beauty_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('thumbnail_url');
            $table->longText('article_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beauty_articles');
    }
}; 