<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id', 
        'keep_watch', 
        'monitoring_reporting', 
        'planning_action', 
        'technical_assistance', 
        'budget',
        'long_plan',
        'medium_plan',
        'short_plan',
        'financial_plan', 
        'management_plan', 
        'maintenance_strategy', 
        'relevant_doc', 
        'publication',
        'archives',
        'documentory',
        'special_care', 
        'intervension',
        'interpretation', 
        'preventive_action', 
        'lack_maintenance', 
        'disaster_plan', 
        'initial_survey', 
        'execution_work',
        'annual_plan', 
        'edu_research', 
        'tourism', 
        'typology', 
        'condition', 
        'conservation_plan', 
        'master_plan',
        'degree_intervension', 
        'social_impact', 
        'over_utilization',
        'publication_text',
        'archive_text',
        'documentory_text',
    ];

    public function site()
    {
        return $this->belongsTo(ArcheologicalSite::class);
    }
}
