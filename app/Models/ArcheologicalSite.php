<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArcheologicalSite extends Model
{
    use HasFactory;

    protected $table = 'archeological_sites';

    protected $fillable = [
        'site_name_en',
        'site_name_bn',
        'district_id',
        'thumbnail',
        'banner',
        'thana_id',
        'active',
    ];

    // Relationships
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }
    
    public function media()
    {
        return $this->hasMany(SiteMedia::class, 'site_id');
    }

    public function siteDescription()
    {
        return $this->hasOne(SiteDescription::class, 'site_id', 'id');
    }

    public function siteMaintenance()
    {
        return $this->hasOne(SiteMaintenance::class, 'site_id', 'id');
    }
}
