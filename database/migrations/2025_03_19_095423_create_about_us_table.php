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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image1')->nullable();
            $table->string('hero_image2')->nullable();
            $table->string('hero_title')->nullable();
            $table->longText('hero_text')->nullable();
            $table->longText('our_history')->nullable();
            $table->string('dg_image')->nullable();
            $table->string('dg_name')->nullable();
            $table->longText('mission_vision')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
