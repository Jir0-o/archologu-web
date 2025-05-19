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
        Schema::create('site_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->longText('site_description')->nullable();
            $table->integer('current_condition')->nullable();
            $table->longText('immediate_problem')->nullable();
            $table->longText('urgent_problem')->nullable();
            $table->longText('threats')->nullable();
            $table->longText('integrity')->nullable();
            $table->longText('value')->nullable();
            $table->longText('priorities')->nullable();
            $table->longText('ownership')->nullable();
            $table->text('map_url')->nullable();
            $table->longText('history')->nullable();
            $table->longText('physical_integrity')->nullable();
            $table->longText('structural_integrity')->nullable();
            $table->longText('physical_features')->nullable();
            $table->longText('historic_fabric')->nullable();
            $table->longText('authentic_design')->nullable();
            $table->longText('authentic_setting')->nullable();
            $table->longText('authentic_material')->nullable();
            $table->longText('demographic_growth')->nullable();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('archeological_sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_descriptions');
    }
};
