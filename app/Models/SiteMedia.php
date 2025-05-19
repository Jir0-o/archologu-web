<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMedia extends Model
{
    use HasFactory;

    protected $table = 'site_media';
    
    protected $fillable = ['site_id', 'file_path', 'file_type', 'status', 'user_name','file_name','title', 'phone_no','is_active'];

    public function site()
    {
        return $this->belongsTo(ArcheologicalSite::class);
    }
}
