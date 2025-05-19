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
        Schema::create('site_maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->longText('keep_watch')->nullable();
            $table->string('monitoring_reporting')->nullable();
            $table->string('planning_action')->nullable();
            $table->string('technical_assistance')->nullable();
            $table->longText('budget')->nullable();
            $table->longText('long_plan')->nullable();
            $table->longText('medium_plan')->nullable();
            $table->longText('short_plan')->nullable();
            $table->longText('financial_plan')->nullable();
            $table->longText('management_plan')->nullable();
            $table->longText('maintenance_strategy')->nullable();
            $table->string('relevant_doc')->nullable();
            $table->longText('special_care')->nullable();
            $table->longText('intervension')->nullable();
            $table->longText('interpretation')->nullable();
            $table->longText('preventive_action')->nullable();
            $table->longText('lack_maintenance')->nullable();
            $table->longText('disaster_plan')->nullable();
            $table->string('initial_survey')->nullable();
            $table->string('execution_work')->nullable();
            $table->string('annual_plan')->nullable();
            $table->longText('edu_research')->nullable();
            $table->longText('tourism')->nullable();
            $table->longText('typology')->nullable();
            $table->longText('condition')->nullable();
            $table->longText('conservation_plan')->nullable();
            $table->longText('master_plan')->nullable();
            $table->longText('degree_intervension')->nullable();
            $table->longText('social_impact')->nullable();
            $table->longText('over_utilization')->nullable();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('archeological_sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_maintenances');
    }
};
