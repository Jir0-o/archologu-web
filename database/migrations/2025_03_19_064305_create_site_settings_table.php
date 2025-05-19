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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_image2')->nullable();
            $table->string('hero_text1')->nullable();
            $table->string('hero_text2')->nullable();
            $table->string('hero_text3')->nullable();
            $table->string('youtube_video_link')->nullable();
            $table->string('youtube_text1')->nullable();
            $table->string('youtube_text2')->nullable();
            $table->string('youtube_text3')->nullable();
            $table->text('footer_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
