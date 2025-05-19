<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'site_description',
        'current_condition',
        'immediate_problem',
        'urgent_problem',
        'threats',
        'integrity',
        'value',
        'priorities',
        'ownership',
        'map_url',
        'history',
        'physical_integrity',
        'structural_integrity',
        'physical_features',
        'historic_fabric',
        'authentic_design',
        'authentic_setting',
        'authentic_material',
        'demographic_growth',
    ];

    public function site()
    {
        return $this->belongsTo(ArcheologicalSite::class);
    }
}
